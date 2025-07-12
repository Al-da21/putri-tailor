@extends('layouts.app-admin')

@section('title', 'Laporan')

@section('admin')
<div class="container-fluid px-4">
    <h1 class="mt-4 text-slate-800">Laporan</h1>
    <ol class="breadcrumb mb-4">
    </ol>

    <!-- Statistik Ringkas -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="text-white-75 small">Total Transaksi</div>
                            <div class="text-lg font-weight-bold">{{ \App\Models\Transaction::count() }}</div>
                        </div>
                        <i class="fas fa-shopping-cart fa-2x text-white-25"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="text-white-75 small">Total Pendapatan</div>
                            <div class="text-lg font-weight-bold">    Rp {{ number_format(\App\Models\Transaction::where('order_status', 'SELESAI')->sum('total'), 0, ',', '.') }}</div>
                        </div>
                        <i class="fas fa-money-bill-wave fa-2x text-white-25"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-warning text-white mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="text-white-75 small">Total Produk</div>
                            <div class="text-lg font-weight-bold">{{ \App\Models\Product::count() }}</div>
                        </div>
                        <i class="fas fa-boxes fa-2x text-white-25"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-info text-white mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="text-white-75 small">Total Kursus</div>
                            <div class="text-lg font-weight-bold">{{ \App\Models\KursusMenjahit::count() }}</div>
                        </div>
                        <i class="fas fa-graduation-cap fa-2x text-white-25"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Menu Laporan -->
    <div class="row">
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-shopping-cart me-2"></i>
                        Laporan Transaksi
                    </h5>
                </div>
                <div class="card-body">
                    <p class="card-text">Laporan lengkap tentang semua transaksi penjualan, termasuk status pembayaran dan detail pesanan.</p>
                    <ul class="list-unstyled small text-muted">
                        <li><i class="fas fa-check text-success"></i> Filter berdasarkan tanggal</li>
                        <li><i class="fas fa-check text-success"></i> Filter berdasarkan status</li>
                        <li><i class="fas fa-check text-success"></i> Detail produk yang dibeli</li>
                        <li><i class="fas fa-check text-success"></i> Export ke PDF</li>
                    </ul>
                </div>
                <div class="card-footer">
                    <a href="{{ route('laporan.transaksi') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-eye me-1"></i> Lihat Laporan
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
.card-header {
    border-bottom: 1px solid rgba(0,0,0,.125);
}

.text-white-75 {
    color: rgba(255,255,255,.75)!important;
}

.text-white-25 {
    color: rgba(255,255,255,.25)!important;
}

.card:hover {
    transform: translateY(-2px);
    transition: all 0.3s ease;
}
</style>
@endpush
@endsection