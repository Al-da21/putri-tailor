<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\Product;
use App\Models\KursusMenjahit;
use App\Models\TransactionDetail;
use App\Models\PesertaKursus;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function index()
    {
        return view('admin.laporan.index');
    }

    // Laporan Transaksi
    public function laporanTransaksi(Request $request)
    {
        $query = Transaction::with(['user', 'transactionDetails.product']);
        
        // Filter berdasarkan tanggal
        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }
        
        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }
        
        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        $transactions = $query->orderBy('created_at', 'desc')->get();
        
        // Hitung statistik
        $totalTransaksi = $transactions->count();
        $totalPendapatan = $transactions->where('order_status', 'SELESAI')->sum('total');
        $transaksiPending = $transactions->where('order_status', 'PESANAN_BARU')->count();
        $transaksiCompleted = $transactions->where('order_status', 'SELESAI')->count();
        
        if ($request->get('download') == 'pdf') {
            return $this->downloadTransaksiPDF($transactions, $request->all());
        }
        
        return view('admin.laporan.transaksi', compact(
            'transactions', 
            'totalTransaksi', 
            'totalPendapatan', 
            'transaksiPending', 
            'transaksiCompleted'
        ));
    }

    // Laporan Produk
   public function laporanProduk(Request $request)
{
    $query = Product::withTrashed();
    
    // Filter berdasarkan kategori jika ada
    if ($request->filled('kategori')) {
        $query->where('kategori', $request->kategori);
    }
    
    // Filter berdasarkan stok
    if ($request->filled('stok_filter')) {
        switch ($request->stok_filter) {
            case 'habis':
                $query->where('stok', 0);
                break;
            case 'menipis':
                $query->where('stok', '>', 0)->where('stok', '<=', 10);
                break;
            case 'aman':
                $query->where('stok', '>', 10);
                break;
        }
    }
    
    $products = $query->get();
    
    // Hitung statistik
    $totalProduk = $products->count();
    $stokHabis = $products->where('stok', 0)->count();
    $stokMenipis = $products->where('stok', '>', 0)->where('stok', '<=', 10)->count();
    $produkAktif = $products->where('deleted_at', null)->count();
    
    // Ambil data penjualan produk
    $penjualanProduk = DB::table('transaction_details')
        ->join('products', 'transaction_details.products_id', '=', 'products.id')
        ->join('transactions', 'transaction_details.transactions_id', '=', 'transactions.id')
        ->where('transactions.payment_status', 'PAID') // Ubah dari 'completed' ke 'PAID'
        ->where('transactions.order_status', 'SELESAI') // Tambahan filter untuk order status
        ->select(
            'products.name as nama_produk', // Ubah dari 'products.nama_produk' ke 'products.name'
            DB::raw('SUM(transaction_details.qty) as total_terjual'), // Ubah dari 'quantity' ke 'qty'
            DB::raw('SUM(transaction_details.sub_total) as total_pendapatan') // Ubah dari 'subtotal' ke 'sub_total'
        )
        ->groupBy('products.id', 'products.name') // Sesuaikan dengan field yang ada
        ->orderBy('total_terjual', 'desc') // Perbaiki dari 'total' ke 'total_terjual'
        ->get();
    
    if ($request->get('download') == 'pdf') {
        return $this->downloadProdukPDF($products, $penjualanProduk, $request->all());
    }
    
    return view('admin.laporan.product', compact(
        'products', 
        'totalProduk', 
        'stokHabis', 
        'stokMenipis', 
        'produkAktif',
        'penjualanProduk'
    ));
}

    public function laporanKursus(Request $request)
    {
        $query = KursusMenjahit::with(['pesertaKursus.user']);
        
        // Filter berdasarkan tanggal
        if ($request->filled('start_date')) {
            $query->whereDate('tanggal_mulai', '>=', $request->start_date);
        }
        
        if ($request->filled('end_date')) {
            $query->whereDate('tanggal_selesai', '<=', $request->end_date);
        }
        
        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        $kursus = $query->orderBy('tanggal_mulai', 'desc')->get();
        
        // Hitung statistik
        $totalKursus = $kursus->count();
        $totalPeserta = $kursus->sum(function($k) { return $k->pesertaKursus->count(); });
        $totalPendapatan = $kursus->sum(function($k) { 
            return $k->pesertaKursus->count() * $k->harga; 
        });
        $kursusBuka = $kursus->where('status', 'BUKA')->count();
        $kursusSelesai = $kursus->where('status', 'SELESAI')->count();
        
        if ($request->get('download') == 'pdf') {
            return $this->downloadKursusPDF($kursus, $request->all());
        }
        
        return view('admin.laporan.kursus', compact(
            'kursus', 
            'totalKursus', 
            'totalPeserta', 
            'totalPendapatan', 
            'kursusBuka', 
            'kursusSelesai'
        ));
    }

    // Download PDF Transaksi
    private function downloadTransaksiPDF($transactions, $filters)
    {
        $data = [
            'title' => 'Laporan Transaksi',
            'transactions' => $transactions,
            'filters' => $filters,
            'generated_at' => Carbon::now()->format('d/m/Y H:i:s'),
            'total_transaksi' => $transactions->count(),
            'total_pendapatan' => $transactions->where('status', 'completed')->sum('total_amount')
        ];
        
        $pdf = PDF::loadView('admin.laporan.pdf.transaksi', $data);
        return $pdf->download('laporan-transaksi-' . Carbon::now()->format('Y-m-d') . '.pdf');
    }

    // Download PDF Produk
    private function downloadProdukPDF($products, $penjualanProduk, $filters)
    {
        $data = [
            'title' => 'Laporan Produk',
            'products' => $products,
            'penjualan_produk' => $penjualanProduk,
            'filters' => $filters,
            'generated_at' => Carbon::now()->format('d/m/Y H:i:s'),
            'total_produk' => $products->count(),
            'stok_habis' => $products->where('stok', 0)->count()
        ];
        
        $pdf = Pdf::loadView('admin.laporan.pdf.produk', $data);
        return $pdf->download('laporan-produk-' . Carbon::now()->format('Y-m-d') . '.pdf');
    }

    // Download PDF Kursus
    private function downloadKursusPDF($kursus, $filters)
    {
        $data = [
            'title' => 'Laporan Kursus Menjahit',
            'kursus' => $kursus,
            'filters' => $filters,
            'generated_at' => Carbon::now()->format('d/m/Y H:i:s'),
            'total_kursus' => $kursus->count(),
            'total_peserta' => $kursus->sum(function($k) { return $k->pesertaKursus->count(); })
        ];
        
        $pdf = Pdf::loadView('admin.laporan.pdf.kursus', $data);
        return $pdf->download('laporan-kursus-' . Carbon::now()->format('Y-m-d') . '.pdf');
    }

    // Laporan Dashboard/Ringkasan
    public function dashboard(Request $request)
    {
        $bulanIni = Carbon::now()->startOfMonth();
        $bulanLalu = Carbon::now()->subMonth()->startOfMonth();
        
        // Data bulan ini
        $transaksisBulanIni = Transaction::where('created_at', '>=', $bulanIni)->count();
        $pendapatanBulanIni = Transaction::where('created_at', '>=', $bulanIni)
            ->where('status', 'completed')
            ->sum('total_amount');
        
        // Data bulan lalu
        $transaksisBulanLalu = Transaction::whereBetween('created_at', [$bulanLalu, $bulanIni])->count();
        $pendapatanBulanLalu = Transaction::whereBetween('created_at', [$bulanLalu, $bulanIni])
            ->where('status', 'completed')
            ->sum('total_amount');
        
        // Data kursus
        $totalKursusAktif = KursusMenjahit::where('status', 'BUKA')->count();
        $totalPesertaKursus = DB::table('peserta_kursus')->count();
        
        // Produk terlaris
        $produkTerlaris = DB::table('transaction_details')
            ->join('products', 'transaction_details.products_id', '=', 'products.id')
            ->join('transactions', 'transaction_details.transactions_id', '=', 'transactions.id')
            ->where('transactions.status', 'completed')
            ->select(
                'products.nama_produk',
                DB::raw('SUM(transaction_details.quantity) as total_terjual')
            )
            ->groupBy('products.id', 'products.nama_produk')
            ->orderBy('total_terjual', 'desc')
            ->limit(5)
            ->get();
        
        return view('admin.laporan.dashboard', compact(
            'transaksisBulanIni', 'pendapatanBulanIni',
            'transaksisBulanLalu', 'pendapatanBulanLalu',
            'totalKursusAktif', 'totalPesertaKursus',
            'produkTerlaris'
        ));
    }
}