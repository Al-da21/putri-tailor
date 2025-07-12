@extends('layouts.app-admin')

@section('title', 'Transaksi')

@section('admin')
    <div class="mt-3">
        <div class="text-xl font-medium mb-8">List Pesanan</div>

        {{-- Filter & Sort Form --}}
        <form method="GET" action="{{ url('admin/transaction') }}" class="mb-6 flex flex-wrap items-end gap-4">
    <div class="flex flex-col">
        <label for="status" class="text-sm font-medium">Status Pesanan</label>
        <select name="status" id="status" class="mt-1 px-3 py-2 border rounded w-48">
            <option value="">Semua</option>
            <option value="PESANAN_BARU" {{ request('status') == 'PESANAN_BARU' ? 'selected' : '' }}>Pesanan Baru</option>
            <option value="SEDANG_DIKERJAKAN" {{ request('status') == 'SEDANG_DIKERJAKAN' ? 'selected' : '' }}>Sedang Dikerjakan</option>
            <option value="SELESAI" {{ request('status') == 'SELESAI' ? 'selected' : '' }}>Selesai</option>
            <option value="CANCELLED" {{ request('status') == 'CANCELLED' ? 'selected' : '' }}>Dibatalkan</option>
        </select>
    </div>

    <div class="flex flex-col">
        <label for="sort" class="text-sm font-medium">Urutkan Tanggal</label>
        <select name="sort" id="sort" class="mt-1 px-3 py-2 border rounded w-48">
            <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>Terbaru</option>
            <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>Terlama</option>
        </select>
    </div>

    <div>
        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
            Terapkan
        </button>
    </div>
</form>


        {{-- Alert dan Table --}}
        @if ($message = Session::get('success'))
            <div id="alert-success" class="flex p-4 mb-4 bg-green-100 rounded-lg" role="alert">
                <!-- icon + pesan -->
                <div class="ml-3 text-base text-green-700">
                    {{ $message }}
                </div>
            </div>
        @endif

        <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-white uppercase bg-indigo-500">
                    <tr class="divide-x divide-y">
                        <th scope="col" class="py-3 px-6">Tanggal Transaksi</th>
                        <th scope="col" class="py-3 px-6">Nama</th>
                        <th scope="col" class="py-3 px-6">Produk</th>
                        <th scope="col" class="py-3 px-6">Jadwal Pengukuran</th>
                        <th scope="col" class="py-3 px-6">Status Pesanan</th>
                        <th scope="col" class="py-3 px-6">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y">
                    @forelse ($transactions as $transaction)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="py-3 px-6">
                                {{ $transaction->created_at->format('d M Y - H:i') }} WIB
                            </td>
                            <td class="py-3 px-6">{{ $transaction->user->name }}</td>
                            <td class="py-3 px-6">
                                @if($transaction->transactionDetails && $transaction->transactionDetails->count() > 0)
                                    <div class="space-y-1">
                                        @foreach($transaction->transactionDetails as $detail)
                                            <div class="text-sm">
                                                <span class="font-medium">{{ $detail->product->name ?? 'Produk tidak ditemukan' }}</span>
                                                <span class="text-gray-500">({{ $detail->quantity ?? 1 }} pcs)</span>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <span class="text-gray-400 italic">Tidak ada produk</span>
                                @endif
                            </td>
                            <td class="py-3 px-6">
                                @if($transaction->jadwalPengukuran)
                                    {{ $transaction->jadwalPengukuran->tanggal_pengukuran->format('d M Y') }} -
                                    {{ $transaction->jadwalPengukuran->waktu_pengukuran->format('H:i') }} WIB
                                @else
                                    -
                                @endif
                            </td>
                            <td class="py-3 px-6">{{ $transaction->order_status }}</td>
                            <td class="py-3 px-6">
                                {{-- Aksi tombol seperti sebelumnya --}}
                                <div class="flex items-center space-x-2">
                                    @if($transaction->order_status == null || $transaction->order_status == 'PESANAN_BARU')
            {{-- Tombol untuk konfirmasi pembayaran atau mulai dikerjakan --}}
            <a href="{{ route('admin.transaction.update-status', $transaction->id) }}"
               class="py-2 px-3 rounded-md text-white bg-green-500 hover:bg-green-600"
               onclick="return confirm('Konfirmasi pembayaran & ubah status menjadi PESANAN_BARU?')">
                <i class="fa-solid fa-box"></i>
            </a>
            <a href="{{ route('admin.transaction.cancel', $transaction->id) }}"
               class="py-2 px-3 rounded-md text-white bg-red-500 hover:bg-red-600"
               onclick="return confirm('Yakin ingin membatalkan pesanan ini?')">
                <i class="fa-solid fa-xmark"></i>
            </a>
        @elseif($transaction->order_status == 'SEDANG_DIKERJAKAN')
            {{-- Tombol untuk menyelesaikan pesanan --}}
            <a href="{{ route('admin.transaction.update-status', $transaction->id) }}"
               class="py-2 px-3 rounded-md text-white bg-green-500 hover:bg-green-600"
               onclick="return confirm('Pengukuran sudah selesai? Ubah status menjadi SELESAI?')">
                <i class="fa-solid fa-circle-check"></i>
            </a>
        @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-4 px-6 text-center">Tidak ada transaksi ditemukan</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
