<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\KursusMenjahit;
use App\Models\PesertaKursus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class KursusMenjahitController extends Controller
{
    public function index()
    {
        $kursus = KursusMenjahit::with(['user', 'pesertaKursus'])
                    ->where('status', 'BUKA') // Hanya tampilkan kursus yang masih buka
                    ->orderBy('tanggal_mulai', 'asc')
                    ->get();

        return view('customer.kursus-menjahit.index', compact('kursus'));
    }

    public function show($id)
    {
        $kursus = KursusMenjahit::with(['pesertaKursus.user'])->findOrFail($id);
        
        // Cek apakah user sudah mendaftar di kursus ini
        $sudahDaftar = false;
        $pesertaSaya = null;
        
        if (Auth::check()) {
            $pesertaSaya = PesertaKursus::where('kursus_id', $id)
                                       ->where('user_id', Auth::id())
                                       ->first();
            $sudahDaftar = $pesertaSaya ? true : false;
        }

        return view('customer.kursus-menjahit.show', compact('kursus', 'sudahDaftar', 'pesertaSaya'));
    }

    public function daftar(Request $request, $id)
    {
        // Pastikan user sudah login
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu untuk mendaftar kursus.');
        }

        $kursus = KursusMenjahit::findOrFail($id);

        // Validasi apakah kursus masih bisa didaftar
        if (!$kursus->canRegister()) {
            return redirect()->back()->with('error', 'Kursus ini sudah tutup atau penuh!');
        }

        // Cek apakah user sudah mendaftar
        $existingPeserta = PesertaKursus::where('kursus_id', $id)
                                       ->where('user_id', Auth::id())
                                       ->first();

        if ($existingPeserta) {
            return redirect()->back()->with('error', 'Anda sudah terdaftar di kursus ini!');
        }

        $request->validate([
            'catatan' => 'nullable|string|max:500',
        ]);

        // Daftarkan user ke kursus
        PesertaKursus::create([
            'kursus_id' => $id,
            'user_id' => Auth::id(),
            'tanggal_daftar' => now(),
            'status_pembayaran' => 'BELUM_BAYAR',
            'status_kehadiran' => 'TERDAFTAR',
            'catatan' => $request->catatan,
        ]);

        // Cek apakah kursus perlu ditutup otomatis setelah ada peserta baru
        $this->checkAndCloseIfFull($id);

        return redirect()->route('customer.kursus-menjahit.show', $id)
                         ->with('success', 'Berhasil mendaftar kursus! Silakan lakukan pembayaran untuk mengkonfirmasi pendaftaran.');
    }

    public function uploadBuktiPembayaran(Request $request, $pesertaId)
    {
        $peserta = PesertaKursus::where('id', $pesertaId)
                               ->where('user_id', Auth::id())
                               ->firstOrFail();

        $request->validate([
            'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Hapus bukti pembayaran lama jika ada
        if ($peserta->bukti_pembayaran) {
            Storage::disk('public')->delete($peserta->bukti_pembayaran);
        }

        // Upload bukti pembayaran baru
        $file = $request->file('bukti_pembayaran');
        $filename = 'bukti_pembayaran_' . $peserta->id . '_' . time() . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('bukti_pembayaran', $filename, 'public');

        $peserta->update([
            'bukti_pembayaran' => $path,
        ]);

        return redirect()->back()
                         ->with('success', 'Bukti pembayaran berhasil diupload! Tunggu konfirmasi dari admin.');
    }

    public function kursusKu()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $pesertaKursus = PesertaKursus::with(['kursus'])
                                     ->where('user_id', Auth::id())
                                     ->orderBy('tanggal_daftar', 'desc')
                                     ->get();

        return view('customer.kursus-menjahit.kursus-ku', compact('pesertaKursus'));
    }

    public function batalDaftar($pesertaId)
    {
        $peserta = PesertaKursus::where('id', $pesertaId)
                               ->where('user_id', Auth::id())
                               ->firstOrFail();

        // Hanya bisa batal jika belum bayar
        if ($peserta->status_pembayaran == 'SUDAH_BAYAR') {
            return redirect()->back()->with('error', 'Tidak dapat membatalkan pendaftaran yang sudah dikonfirmasi pembayarannya!');
        }

        // Hapus bukti pembayaran jika ada
        if ($peserta->bukti_pembayaran) {
            Storage::disk('public')->delete($peserta->bukti_pembayaran);
        }

        $peserta->delete();

        return redirect()->back()
                         ->with('success', 'Pendaftaran kursus berhasil dibatalkan!');
    }

    /**
     * Method untuk mengecek dan menutup kursus otomatis jika sudah mencapai 10 peserta
     * Method ini akan dipanggil setelah ada pendaftaran baru
     */
    private function checkAndCloseIfFull($kursusId)
    {
        $kursus = KursusMenjahit::findOrFail($kursusId);
        
        // Hanya cek jika kursus masih buka
        if ($kursus->status == 'BUKA') {
            // Hitung total peserta yang sudah terdaftar (termasuk yang belum bayar)
            $totalPeserta = $kursus->pesertaKursus()->count();
            
            // Jika sudah mencapai 10 peserta, tutup kursus
            if ($totalPeserta >= 10) {
                $kursus->update(['status' => 'TUTUP']);
                
                // Optional: Bisa menambahkan log atau notifikasi
                // Log::info("Kursus {$kursus->nama_kursus} ditutup otomatis karena mencapai 10 peserta");
                
                return true; // Kursus ditutup
            }
        }
        
        return false; // Kursus tidak ditutup
    }

    /**
     * Alternative method: Cek berdasarkan peserta yang sudah bayar
     * Gunakan ini jika Anda ingin menutup kursus hanya berdasarkan peserta yang sudah bayar
     */
    private function checkAndCloseIfFullPaid($kursusId)
    {
        $kursus = KursusMenjahit::findOrFail($kursusId);
        
        // Hanya cek jika kursus masih buka
        if ($kursus->status == 'BUKA') {
            // Hitung peserta yang sudah bayar
            $jumlahPesertaSudahBayar = $kursus->pesertaKursus()
                                              ->where('status_pembayaran', 'SUDAH_BAYAR')
                                              ->count();
            
            // Jika sudah mencapai 10 peserta yang sudah bayar, tutup kursus
            if ($jumlahPesertaSudahBayar >= 10) {
                $kursus->update(['status' => 'TUTUP']);
                return true; // Kursus ditutup
            }
        }
        
        return false; // Kursus tidak ditutup
    }

    // Model KursusMenjahit.php
    public function sisaSlot()
    {
        return max(0, $this->max_peserta - $this->pesertaKursus()->count());
    }

}