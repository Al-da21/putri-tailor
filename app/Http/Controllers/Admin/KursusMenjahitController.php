<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KursusMenjahit;
use App\Models\PesertaKursus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KursusMenjahitController extends Controller
{
    public function index()
    {
        $kursus = KursusMenjahit::with(['user', 'pesertaKursus.user'])
                    ->orderBy('created_at', 'desc')
                    ->get();

        return view('admin.kursus-menjahit.index', compact('kursus'));
    }

    public function create()
    {
        $hariOptions = [
            'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'
        ];

        return view('admin.kursus-menjahit.create', compact('hariOptions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kursus' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'harga' => 'required|numeric|min:0',
            'durasi_kursus' => 'required|integer|min:1',
            'tanggal_mulai' => 'required|date|after:today',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
            'jadwal_hari' => 'required|array|min:1',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'max_peserta' => 'required|integer|min:1',
            'instruktur' => 'required|string|max:255',
            'materi_kursus' => 'required|array|min:1',
        ]);

        KursusMenjahit::create([
            'user_id' => Auth::id(),
            'nama_kursus' => $request->nama_kursus,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'durasi_kursus' => $request->durasi_kursus,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'jadwal_hari' => $request->jadwal_hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'max_peserta' => $request->max_peserta,
            'status' => 'BUKA',
            'instruktur' => $request->instruktur,
            'materi_kursus' => array_filter($request->materi_kursus),
        ]);

        return redirect('admin/kursus-menjahit')->with('success', 'Kursus menjahit berhasil ditambahkan!');
    }

    public function show($id)
    {
        $kursus = KursusMenjahit::with(['pesertaKursus.user'])->findOrFail($id);
        
        return view('admin.kursus-menjahit.show', compact('kursus'));
    }

    public function edit($id)
    {
        $kursus = KursusMenjahit::findOrFail($id);
        $hariOptions = [
            'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'
        ];

        return view('admin.kursus-menjahit.edit', compact('kursus', 'hariOptions'));
    }

    public function update(Request $request, $id)
    {
        $kursus = KursusMenjahit::findOrFail($id);

        $request->validate([
            'nama_kursus' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'harga' => 'required|numeric|min:0',
            'durasi_kursus' => 'required|integer|min:1',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
            'jadwal_hari' => 'required|array|min:1',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'max_peserta' => 'required|integer|min:1',
            'instruktur' => 'required|string|max:255',
            'materi_kursus' => 'required|array|min:1',
            'status' => 'required|in:BUKA,TUTUP,SELESAI',
        ]);

        $kursus->update([
            'nama_kursus' => $request->nama_kursus,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'durasi_kursus' => $request->durasi_kursus,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'jadwal_hari' => $request->jadwal_hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'max_peserta' => $request->max_peserta,
            'status' => $request->status,
            'instruktur' => $request->instruktur,
            'materi_kursus' => array_filter($request->materi_kursus),
        ]);

        return redirect()->route('admin.kursus-menjahit.index')
                         ->with('success', 'Kursus menjahit berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $kursus = KursusMenjahit::findOrFail($id);
        
        // Cek apakah ada peserta yang sudah mendaftar
        if ($kursus->pesertaKursus()->count() > 0) {
            return redirect()->route('admin.kursus-menjahit.index')
                             ->with('error', 'Tidak dapat menghapus kursus yang sudah memiliki peserta!');
        }

        $kursus->delete();

        return redirect()->route('admin.kursus-menjahit.index')
                         ->with('success', 'Kursus menjahit berhasil dihapus!');
    }

    public function updateStatus($id)
    {
        $kursus = KursusMenjahit::findOrFail($id);
        
        // Logic untuk update status berdasarkan status saat ini
        if ($kursus->status == 'BUKA') {
            $kursus->update(['status' => 'TUTUP']);
            $message = 'Status kursus berhasil diubah menjadi "Pendaftaran Tutup"';
        } elseif ($kursus->status == 'TUTUP') {
            $kursus->update(['status' => 'SELESAI']);
            $message = 'Status kursus berhasil diubah menjadi "Kursus Selesai"';
        } else {
            return redirect()->route('admin.kursus-menjahit.index')
                             ->with('error', 'Status kursus tidak dapat diubah lagi!');
        }

        return redirect()->route('admin.kursus-menjahit.index')
                         ->with('success', $message);
    }

    public function peserta($id)
    {
        $kursus = KursusMenjahit::with(['pesertaKursus.user'])->findOrFail($id);
        
        return view('admin.kursus-menjahit.peserta', compact('kursus'));
    }

    public function konfirmasiPembayaran($pesertaId)
    {
        $peserta = PesertaKursus::findOrFail($pesertaId);
        
        $peserta->update([
            'status_pembayaran' => 'SUDAH_BAYAR'
        ]);

        // Ambil kursus terkait
        $kursus = $peserta->kursus;
        
        // Cek apakah kursus masih buka dan hitung jumlah peserta yang sudah bayar
        if ($kursus->status == 'BUKA') {
            $jumlahPesertaSudahBayar = $kursus->pesertaKursus()
                                              ->where('status_pembayaran', 'SUDAH_BAYAR')
                                              ->count();
            
            // Jika sudah mencapai 10 peserta, tutup kursus otomatis
            if ($jumlahPesertaSudahBayar >= 10) {
                $kursus->update(['status' => 'TUTUP']);
                
                return redirect()->back()
                                ->with('success', 'Pembayaran peserta berhasil dikonfirmasi! Kursus otomatis ditutup karena telah mencapai 10 peserta.');
            }
        }

        return redirect()->back()
                         ->with('success', 'Pembayaran peserta berhasil dikonfirmasi!');
    }

    /**
     * Method untuk mengecek dan menutup kursus otomatis jika sudah mencapai 10 peserta
     * Method ini bisa dipanggil dari controller lain (misalnya saat pendaftaran peserta baru)
     */
    public function checkAndCloseIfFull($kursusId)
    {
        $kursus = KursusMenjahit::findOrFail($kursusId);
        
        // Hanya cek jika kursus masih buka
        if ($kursus->status == 'BUKA') {
            $jumlahPesertaSudahBayar = $kursus->pesertaKursus()
                                              ->where('status_pembayaran', 'SUDAH_BAYAR')
                                              ->count();
            
            // Jika sudah mencapai 10 peserta, tutup kursus
            if ($jumlahPesertaSudahBayar >= 10) {
                $kursus->update(['status' => 'TUTUP']);
                return true; // Kursus ditutup
            }
        }
        
        return false; // Kursus tidak ditutup
    }
}