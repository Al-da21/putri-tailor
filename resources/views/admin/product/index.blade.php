@extends('layouts.app-admin')

@section('title', 'Produk')

@section('admin')
<div class="mt-6 px-4">
    <div class="text-2xl font-semibold mb-6 text-gray-800">Daftar Produk</div>

    <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
        <form method="GET" class="flex space-x-2 w-full md:w-auto">
            <input type="text" name="search" placeholder="Cari berdasarkan nama..."
                   class="border border-gray-300 rounded-lg px-4 py-2 w-full md:w-64 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400" />
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow">
                Cari
            </button>
        </form>
        <a href="{{ url('admin/product/create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded">
                + Tambah Barang
        </a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @forelse ($products as $product)
            <div class="border rounded-xl shadow-md p-4 flex flex-col items-center bg-white hover:shadow-lg transition-shadow duration-300">
                <img src="{{ $product->image ? Storage::url($product->image) : asset('assets/img/no-image.jpg') }}"
                     alt="{{ $product->name }}"
                     class="w-40 h-40 object-cover rounded-md mb-4 border" />

                <div class="font-semibold text-center text-lg text-gray-800">{{ $product->name }}</div>
                <div class="text-red-600 mt-1 mb-1 font-bold text-sm">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                <div class="text-sm text-gray-500 mb-3">Ukuran: {{ $product->size ?? '-' }}</div>

                <div class="flex space-x-4">
                    <a href="{{ url('admin/product/' . $product->id . '/edit') }}"
                       class="text-yellow-500 hover:text-yellow-600 text-xl" title="Edit Produk">
                        <i class="fas fa-edit"></i>
                    </a>

                    <form action="{{ url('admin/product/' . $product->id) }}" method="POST"
                          onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-700 text-xl" title="Hapus Produk">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center text-gray-500 text-lg">Tidak ada produk ditemukan.</div>
        @endforelse
    </div>
</div>
@endsection
