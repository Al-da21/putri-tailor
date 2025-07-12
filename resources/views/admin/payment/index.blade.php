@extends('layouts.app-admin')

@section('title', 'Pembayaran')

@section('admin')
<div class="mt-3">
    <div class="text-xl font-medium mb-8">List Pembayaran</div>

    @if ($message = Session::get('success'))
        <div id="alert-success" class="flex p-4 mb-4 bg-green-100 rounded-lg" role="alert">
            <svg aria-hidden="true" class="flex-shrink-0 w-5 h-5 text-green-700" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
            </svg>
            <div class="ml-3 text-base text-green-700">{{ $message }}</div>
            <button type="button" class="ml-auto bg-green-100 text-green-500 rounded-lg p-1.5 hover:bg-green-200 inline-flex h-8 w-8" data-dismiss-target="#alert-success" aria-label="Close">
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
            </button>
        </div>
    @endif

    <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-700">
            <thead class="text-xs text-white uppercase bg-indigo-500">
                <tr>
                    <th class="py-3 px-6">Tanggal Transaksi</th>
                    <th class="py-3 px-6">Nama Customer</th>
                    <th class="py-3 px-6">Produk</th>
                    <th class="py-3 px-6">Total Harga</th>
                    <th class="py-3 px-6">Status Pembayaran</th>
                    <th class="py-3 px-6">Status Pesanan</th>
                    <th class="py-3 px-6">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y">
                @forelse ($transactions as $transaction)
                    @php
                        $payment = App\Models\Payment::where('transactions_id', $transaction->id)->first();
                        $modalId = 'modalBukti_' . $transaction->id;
                    @endphp
                    <tr class="hover:bg-gray-50">
                        <td class="py-3 px-6">{{ $transaction->created_at->format('d M Y - H:i') }} WIB</td>
                        <td class="py-3 px-6">{{ $transaction->user->name }}</td>
                        <td class="py-3 px-6">
                            @if($transaction->transactionDetails && $transaction->transactionDetails->count() > 0)
                                <div class="space-y-1">
                                    @foreach($transaction->transactionDetails as $detail)
                                        <div class="text-sm">
                                            {{ $detail->product->name ?? 'Produk tidak ditemukan' }} ({{ $detail->quantity ?? 1 }} pcs)
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <span class="italic text-gray-500">Tidak ada produk</span>
                            @endif
                        </td>
                        <td class="py-3 px-6">
                            @if($transaction->total_price)
                                Rp {{ number_format($transaction->total_price, 0, ',', '.') }}
                            @else
                                <span class="text-gray-400">-</span>
                            @endif
                        </td>
                        <td class="py-3 px-6">
                            @if(!$payment)
                                <span class="text-xs px-2 py-1 rounded bg-gray-300 text-gray-700">Belum Upload</span>
                            @elseif($transaction->payment_status === 'UNPAID')
                                <span class="text-xs px-2 py-1 rounded bg-yellow-200 text-yellow-800">Belum Dikonfirmasi</span>
                            @elseif($transaction->payment_status === 'PAID')
                                <span class="text-xs px-2 py-1 rounded bg-green-200 text-green-800">Terkonfirmasi</span>
                            @else
                                <span class="text-xs px-2 py-1 rounded bg-gray-200 text-gray-700">{{ $transaction->payment_status }}</span>
                            @endif
                        </td>
                        <td class="py-3 px-6">{{ $transaction->order_status_readable ?? '-' }}</td>
                        <td class="py-3 px-6">
                            <div class="flex flex-col space-y-2 items-start">
                                @if($payment && $payment->bukti_pembayaran)
                                    <div class="cursor-pointer" data-modal-target="{{ $modalId }}" data-modal-toggle="{{ $modalId }}">
                                        <img src="{{ asset('storage/' . $payment->bukti_pembayaran) }}" class="w-28 h-20 object-cover rounded border hover:brightness-75 duration-300" alt="Bukti Pembayaran">
                                    </div>

                                    {{-- Modal --}}
                                    <div id="{{ $modalId }}" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                        <div class="relative w-full max-w-2xl max-h-full mx-auto">
                                            <div class="relative bg-white rounded-lg shadow">
                                                <div class="flex items-start justify-between p-4 border-b rounded-t">
                                                    <h3 class="text-xl font-semibold text-gray-900">Bukti Pembayaran</h3>
                                                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-hide="{{ $modalId }}">
                                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                                        </svg>
                                                    </button>
                                                </div>
                                                <div class="p-6 flex justify-center">
                                                    <img src="{{ asset('storage/' . $payment->bukti_pembayaran) }}" alt="Bukti Pembayaran" class="max-h-[70vh] rounded shadow-md">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                {{-- Tombol Lihat Detail --}}
                                @if($payment)
                                    <a href="{{ route('admin.transaction.payment', $transaction->id) }}" class="py-1.5 px-3 rounded-md text-white bg-blue-500 hover:bg-blue-600 text-sm">
                                        <i class="fa-solid fa-eye mr-1"></i> Lihat Detail
                                    </a>
                                @endif

                                {{-- Aksi Konfirmasi / Tolak --}}
                                @if($transaction->payment_status === 'UNPAID' && $transaction->order_status !== 'CANCELLED' && $payment)
                                    <div class="flex space-x-2">
                                        <a href="{{ route('admin.transaction.update-status', $transaction->id) }}" class="py-2 px-3 rounded-md text-white bg-green-500 hover:bg-green-600" onclick="return confirm('Konfirmasi pembayaran ini?')">
                                            <i class="fa-solid fa-check"></i>
                                        </a>
                                        <a href="{{ route('admin.transaction.cancel', $transaction->id) }}" class="py-2 px-3 rounded-md text-white bg-red-500 hover:bg-red-600" onclick="return confirm('Tolak pembayaran ini?')">
                                            <i class="fa-solid fa-times"></i>
                                        </a>
                                    </div>
                                @elseif($transaction->payment_status === 'PAID')
                                    <span class="text-sm text-green-700"><i class="fa-solid fa-check mr-1"></i> Terkonfirmasi</span>
                                @else
                                    <span class="text-gray-500 text-sm">-</span>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="py-4 px-6 text-center">Tidak ada data pembayaran ditemukan</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
