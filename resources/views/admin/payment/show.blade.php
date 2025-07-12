@extends('layouts.app-admin')

@section('title', 'Detail Pembayaran')

@section('admin')
<div class="mt-5 max-w-4xl mx-auto">
    <div class="bg-white shadow-lg rounded-xl p-6">
        <h2 class="text-2xl font-bold mb-4 border-b pb-2">Detail Transaksi</h2>

        <div class="grid md:grid-cols-2 gap-4 text-sm text-gray-700 mb-6">
            <div>
                <p><span class="font-semibold">Nama Customer:</span> {{ $transaction->user->name }}</p>
                <p><span class="font-semibold">Tanggal Transaksi:</span> {{ $transaction->created_at->format('d-m-Y H:i') }}</p>
            </div>
            <div>
                <p><span class="font-semibold">Total Harga:</span> Rp{{ number_format($transaction->total ?? 0, 0, ',', '.') }}</p>
                <p><span class="font-semibold">Jumlah Item:</span> {{ $transaction->transactionDetails->count() }}</p>
            </div>
        </div>

        <h3 class="text-lg font-semibold mb-3">Bukti Pembayaran</h3>

        <div class="flex justify-center mb-4">
            @if($paymentData && $paymentData->image)
                <img src="{{ asset('storage/' . $paymentData->image) }}" alt="Bukti Pembayaran"
                     class="rounded-lg border border-gray-200 shadow-md max-w-md w-full object-cover">
            @else
                <p class="text-red-600">Belum ada bukti pembayaran yang diupload.</p>
            @endif
        </div>

        <div class="text-right">
            <a href="{{ url('admin/payment') }}"
               class="inline-block px-5 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded">
                ← Kembali ke Daftar Pembayaran
            </a>
        </div>
    </div>
</div>
@endsection
