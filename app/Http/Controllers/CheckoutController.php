<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\UserDetail;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\JadwalPengukuran;
use App\Models\CheckoutJadwalPengukuran;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        $data = $request->session()->get('checkout_data');
        
        // Validasi apakah checkout_data ada dan tidak kosong
        if (!$data || !isset($data['checkout_data']) || empty($data['checkout_data'])) {
            return redirect('/cart')->with('error', 'Tidak ada item untuk checkout. Silakan tambahkan produk ke keranjang terlebih dahulu.');
        }
        
        // Ambil jadwal pengukuran yang sudah dipilih dari session (jika ada)
        $jadwalTerpilih = $request->session()->get('jadwal_pengukuran');
        $userDetailData = UserDetail::where('users_id', auth()->user()->id)->first();

        return view('customer.cart.checkout', compact('data', 'userDetailData','jadwalTerpilih'));
    }

    public function pilihJadwal(Request $request)
    {
        try {
            $request->validate([
                'tanggal_pengukuran' => 'required|date|after:today',
                'waktu_pengukuran' => 'required|date_format:H:i',
                'catatan' => 'nullable|string|max:255'
            ]);

            // Validasi jam operasional (8:00 - 17:00)
            $waktu = $request->waktu_pengukuran;
            if ($waktu < '08:00' || $waktu > '17:00') {
                return response()->json([
                    'success' => false,
                    'message' => 'Waktu pengukuran harus antara jam 08:00 - 17:00 WIB'
                ]);
            }

            // Cek apakah sudah ada jadwal di tanggal dan waktu yang sama
            $jadwalExist = JadwalPengukuran::where('tanggal_pengukuran', $request->tanggal_pengukuran)
                ->where('waktu_pengukuran', $request->waktu_pengukuran)
                ->exists();
            
            if ($jadwalExist) {
                return response()->json([
                    'success' => false,
                    'message' => 'Waktu pengukuran pada tanggal dan jam tersebut sudah terisi. Silakan pilih waktu lain.'
                ]);
            }

            // Simpan jadwal ke session
            $jadwalData = [
                'tanggal_pengukuran' => $request->tanggal_pengukuran,
                'waktu_pengukuran' => $request->waktu_pengukuran,
                'catatan' => $request->catatan,
                'tanggal_format' => Carbon::parse($request->tanggal_pengukuran)->format('d/m/Y'),
                'hari' => Carbon::parse($request->tanggal_pengukuran)->translatedFormat('l')
            ];

            $request->session()->put('jadwal_pengukuran', $jadwalData);

            return response()->json([
                'success' => true,
                'message' => 'Jadwal pengukuran berhasil dipilih',
                'jadwal' => $jadwalData
            ]);
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak valid: ' . implode(', ', $e->validator->errors()->all())
            ], 422);
        } catch (\Exception $e) {
            Log::error('Error pilih jadwal: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan server: ' . $e->getMessage()
            ], 500);
        }
    }

    public function cekWaktuTersedia(Request $request)
    {
        $tanggal = $request->tanggal;
        $waktu = $request->waktu;
        
        $jadwalExist = JadwalPengukuran::where('tanggal_pengukuran', $tanggal)
            ->where('waktu_pengukuran', $waktu)
            ->exists();
        
        return response()->json([
            'available' => !$jadwalExist,
            'message' => $jadwalExist ? 'Waktu sudah terisi' : 'Waktu tersedia'
        ]);
    }

    public function hapusJadwal(Request $request)
    {
        $request->session()->forget('jadwal_pengukuran');
        
        return response()->json([
            'success' => true,
            'message' => 'Jadwal pengukuran berhasil dihapus'
        ]);
    }

    public function payNow(Request $request)
    {
        // Validasi jadwal pengukuran harus dipilih
        $jadwalPengukuran = $request->session()->get('jadwal_pengukuran');
        if (!$jadwalPengukuran) {
            return redirect()->back()->with('error', 'Silakan pilih jadwal pengukuran terlebih dahulu');
        }

        $data = $request->session()->get('checkout_data');
        
        // Validasi apakah checkout_data ada dan tidak kosong
        if (!$data || !isset($data['checkout_data']) || empty($data['checkout_data'])) {
            return redirect('/cart')->with('error', 'Data checkout tidak ditemukan. Silakan coba lagi.');
        }
        
        $total = 0;

        foreach ($data['checkout_data'] as $productID => $productData) {
            $total += $productData['sub_total'] ?? 0;
        }

        // Validasi total tidak boleh 0
        if ($total <= 0) {
            return redirect()->back()->with('error', 'Total pembayaran tidak valid');
        }

        $unique_code = rand(100, 999);
        $transaction = Transaction::create([
            'users_id' => auth()->id(),
            'total' => $total,
            'unique_payment_code' => $unique_code,
            'payment_status' => 'UNPAID',
            'order_status' => null
        ]);

        foreach ($data['checkout_data'] as $productID => $productData) {
        $transactionDetail = [
            'transactions_id' => $transaction->id,
            'products_id' => $productID,
            'product_name' => $productData['product_name'] ?? '',
            'product_price' => $productData['product_price'] ?? 0,
            'qty' => $productData['qty'] ?? 0,
            'profit' => $productData['total_profit'] ?? 0,
            'sub_total' => $productData['sub_total'] ?? 0,
            'product_image' => $productData['product_image'] ?? null,
            'custom_material' => $productData['custom_material'] ?? null,
            // 'custom_size' => $productData['custom_size'] ?? null,
            'custom_image' => $productData['custom_image'] ?? null,
        ];

        TransactionDetail::create($transactionDetail);
    }


        // Simpan jadwal pengukuran ke database
        $jadwalBaru = JadwalPengukuran::create([
            'user_id' => auth()->id(),
            'tanggal_pengukuran' => $jadwalPengukuran['tanggal_pengukuran'],
            'waktu_pengukuran' => $jadwalPengukuran['waktu_pengukuran'],
            'catatan' => $jadwalPengukuran['catatan'] ?? null
        ]);

        // Update transaction dengan jadwal pengukuran ID
        $transaction->update(['jadwal_pengukuran_id' => $jadwalBaru->id]);

        // Bersihkan cart dan session checkout
        Cart::where('users_id', auth()->id())->delete();
        $request->session()->forget('checkout_data');
        $request->session()->forget('jadwal_pengukuran');

        return redirect('/success-order/' . $transaction->id);
    }

    public function successOrder($id)
    {
        $data = Transaction::where('id', $id)->firstOrFail();
        $adminData = UserDetail::whereHas('user', function ($query) {
            $query->where('roles', 'Admin');
        })->first();

        return view('customer.cart.success-order', compact('data', 'adminData'));
    }
}