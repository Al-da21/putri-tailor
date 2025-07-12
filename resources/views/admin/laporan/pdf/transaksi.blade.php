<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.4;
            margin: 0;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
            padding-bottom: 15px;
        }
        .header h1 {
            margin: 0;
            color: #333;
            font-size: 24px;
        }
        .header p {
            margin: 5px 0;
            color: #666;
        }
        .info-box {
            background: #f8f9fa;
            padding: 15px;
            margin: 20px 0;
            border-left: 4px solid #007bff;
        }
        .info-box h3 {
            margin: 0 0 10px 0;
            color: #333;
        }
        .stats {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            margin: 20px 0;
            gap: 10px;
        }
        .stat-item {
            flex: 1 1 22%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 16px;
            background: #f8f9fa;
            border: 1px solid #ddd;
            border-radius: 8px;
        }
        .stat-label {
            font-size: 13px;
            font-weight: 500;
            color: #333;
        }
        .stat-value {
            font-size: 16px;
            font-weight: bold;
            color: #007bff;
            white-space: nowrap;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #007bff;
            color: white;
            font-weight: bold;
        }
        .status-pending { 
            background: #ffc107; 
            padding: 2px 6px; 
            color: #000; 
            border-radius: 3px; 
            font-size: 10px;
        }
        .status-completed { 
            background: #28a745; 
            padding: 2px 6px; 
            color: white; 
            border-radius: 3px; 
            font-size: 10px;
        }
        .status-cancelled { 
            background: #dc3545; 
            padding: 2px 6px; 
            color: white; 
            border-radius: 3px; 
            font-size: 10px;
        }
        .footer {
            position: fixed;
            bottom: 20px;
            left: 20px;
            right: 20px;
            text-align: center;
            font-size: 10px;
            color: #666;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .page-break { page-break-after: always; }
        .no-break { page-break-inside: avoid; }
    </style>
</head>
<body>
    <div class="header">
        <h1>{{ $title }}</h1>
        <p>Toko Jahit - Sistem Penjualan & Kursus</p>
        <p>Digenerate pada: {{ $generated_at }}</p>
    </div>

    @if(!empty($filters))
    <div class="info-box">
        <h3>Filter yang Diterapkan:</h3>
        @if(isset($filters['start_date']) && $filters['start_date'])
            <p><strong>Tanggal Mulai:</strong> {{ \Carbon\Carbon::parse($filters['start_date'])->format('d/m/Y') }}</p>
        @endif
        @if(isset($filters['end_date']) && $filters['end_date'])
            <p><strong>Tanggal Selesai:</strong> {{ \Carbon\Carbon::parse($filters['end_date'])->format('d/m/Y') }}</p>
        @endif
        @if(isset($filters['status']) && $filters['status'])
            <p><strong>Status:</strong> {{ ucfirst($filters['status']) }}</p>
        @endif
    </div>
    @endif

    <div class="stats">
        <div class="stat-item">
            <span class="stat-label">Total Transaksi</span>
            <span class="stat-value">{{ $total_transaksi }}</span>
        </div>
        <div class="stat-item">
            <span class="stat-label">Total Pendapatan</span>
            <span class="stat-value">Rp {{ number_format($total_pendapatan, 0, ',', '.') }}</span>
        </div>
        <div class="stat-item">
            <span class="stat-label">Belum Bayar</span>
            <span class="stat-value">{{ $transactions->where('payment_status', 'UNPAID')->count() }}</span>
        </div>
        <div class="stat-item">
            <span class="stat-label">Sudah Bayar</span>
            <span class="stat-value">{{ $transactions->where('payment_status', 'PAID')->count() }}</span>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 5%">No</th>
                <th style="width: 15%">ID Transaksi</th>
                <th style="width: 15%">Tanggal</th>
                <th style="width: 20%">Customer</th>
                <th style="width: 15%">Total</th>
                <th style="width: 10%">Status</th>
                <th style="width: 20%">Produk</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transactions as $index => $transaction)
            <tr class="no-break">
                <td>{{ $index + 1 }}</td>
                <td style="font-family: monospace; font-size: 10px;">{{ Str::limit($transaction->id, 12) }}</td>
                <td>{{ $transaction->created_at->format('d/m/Y H:i') }}</td>
                <td>
                    <strong>{{ $transaction->user->name ?? 'Guest' }}</strong>
                    @if($transaction->user)
                    <br><small>{{ $transaction->user->email }}</small>
                    @endif
                </td>
                <td class="text-right"><strong>Rp {{ number_format($transaction->total, 0, ',', '.') }}</strong></td>
                <td class="text-center">
                    @switch($transaction->payment_status)
                        @case('UNPAID')
                            <span class="status-pending">Pending</span>
                            @break
                        @case('PAID')
                            <span class="status-completed">Completed</span>
                            @break
                        @case('CANCELLED')
                            <span class="status-cancelled">Cancelled</span>
                            @break
                        @default
                            <span>{{ ucfirst($transaction->payment_status) }}</span>
                    @endswitch
                </td>
                <td>
                    @foreach($transaction->transactionDetails as $detail)
                        <div style="font-size: 10px; margin-bottom: 2px;">
                            • {{ $detail->product->nama_produk ?? 'N/A' }} ({{ $detail->quantity }}x)
                        </div>
                    @endforeach
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center">Tidak ada data transaksi</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    @if($transactions->count() > 0)
    <div class="info-box" style="margin-top: 30px;">
        <h3>Ringkasan:</h3>
        <p><strong>Total Transaksi:</strong> {{ $transactions->count() }} transaksi</p>
        <p><strong>Total Pendapatan (PAID):</strong> Rp {{ number_format($transactions->where('payment_status', 'PAID')->sum('total'), 0, ',', '.') }}</p>
        <p><strong>Rata-rata Nilai Transaksi (PAID):</strong> Rp {{ number_format($transactions->where('payment_status', 'PAID')->avg('total'), 0, ',', '.') }}</p>
    </div>
    @endif

    <div class="footer">
        <p>Laporan ini digenerate secara otomatis oleh sistem pada {{ $generated_at }}</p>
    </div>
</body>
</html>
