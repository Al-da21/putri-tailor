@extends('layouts.app-admin')

@section('title', 'Laporan Transaksi')

@section('admin')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="mt-4 text-slate-800">Laporan Transaksi</h1>
        </div>
        <div>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#filterModal">
                <i class="fas fa-filter me-2"></i>Filter & Export
            </button>
        </div>
    </div>

    <!-- Statistik -->
    <div class="row mb-4">
        <div class="col-lg-3 col-md-6">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <div class="text-white-75 small">Total Transaksi</div>
                            <div class="text-2xl fw-bold">{{ $totalTransaksi }}</div>
                        </div>
                        <i class="fas fa-shopping-cart fa-2x text-white-25"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <div class="text-white-75 small">Total Pendapatan</div>
                            <div class="text-lg fw-bold">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</div>
                        </div>
                        <i class="fas fa-money-bill-wave fa-2x text-white-25"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <div class="text-white-75 small">Pesanan Baru</div>
                            <div class="text-2xl fw-bold">{{ $transaksiPending }}</div>
                        </div>
                        <i class="fas fa-clock fa-2x text-white-25"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <div class="text-white-75 small">Pesanan Selesai</div>
                            <div class="text-2xl fw-bold">{{ $transaksiCompleted }}</div>
                        </div>
                        <i class="fas fa-check-circle fa-2x text-white-25"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Transaksi -->
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">
                <i class="fas fa-list me-2"></i>
                Data Transaksi
            </h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover" id="dataTable">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>ID Transaksi</th>
                            <th>Tanggal</th>
                            <th>Customer</th>
                            <th>Total</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transactions as $index => $transaction)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td><code>{{ Str::limit($transaction->id, 8) }}</code></td>
                            <td>{{ $transaction->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <strong>{{ $transaction->user->name ?? 'Guest' }}</strong>
                                @if($transaction->user)
                                <br><small class="text-muted">{{ $transaction->user->email }}</small>
                                @endif
                            </td>
                            <td><strong>Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</strong></td>
                            <td>
                                @switch($transaction->order_status)
                                    @case('PESANAN_BARU')
                                        <span class="badge bg-warning">Pesanan Baru</span>
                                        @break
                                    @case('SELESAI')
                                        <span class="badge bg-success">Selesai</span>
                                        @break
                                    @case('CANCELLED')
                                        <span class="badge bg-danger">Cancelled</span>
                                        @break
                                    @default
                                        <span class="badge bg-secondary">{{ ucfirst($transaction->order_status) }}</span>
                                @endswitch
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">
                                <div class="text-muted">
                                    <i class="fas fa-inbox fa-3x mb-3"></i>
                                    <p>Tidak ada data transaksi</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Filter -->
<div class="modal fade" id="filterModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('laporan.transaksi') }}" method="GET">
                <div class="modal-header">
                    <h5 class="modal-title">Filter Laporan Transaksi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Tanggal Mulai</label>
                        <input type="date" class="form-control" name="start_date" value="{{ request('start_date') }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tanggal Selesai</label>
                        <input type="date" class="form-control" name="end_date" value="{{ request('end_date') }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select class="form-select" name="status">
                            <option value="">Semua Status</option>
                            <option value="PESANAN_BARU" {{ request('status') == 'PESANAN_BARU' ? 'selected' : '' }}>Pesanan Baru</option>
                            <option value="SELESAI" {{ request('status') == 'SELESAI' ? 'selected' : '' }}>Selesai</option>
                            <option value="CANCELLED" {{ request('status') == 'CANCELLED' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="d-flex justify-content-between w-100">
                        <button type="submit" name="download" value="pdf" class="btn btn-danger">
                            <i class="fas fa-file-pdf me-2"></i>Download PDF
                        </button>
                        <div>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-filter me-2"></i>Filter
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@push('styles')
<link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet">
<style>
.text-white-75 { color: rgba(255,255,255,.75)!important; }
.text-white-25 { color: rgba(255,255,255,.25)!important; }
</style>
@endpush

@push('scripts')
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script>
$(document).ready(function() {
    $('#dataTable').DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/id.json',
        },
        order: [[2, 'desc']],
        pageLength: 25
    });
});
</script>
@endpush
@endsection
