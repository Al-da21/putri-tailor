@extends('layouts.app')

@section('title', 'Custom Produk')

@section('content')
<div class="max-w-xl mx-auto py-10 px-4">
    <h2 class="text-2xl font-bold mb-4 text-center">Custom Desain - {{ $product->name }}</h2>
    <form action="{{ url('/custom-order') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="product_id" value="{{ $product->id }}">

        <div class="mb-4">
            <label class="block mb-2 font-medium">Pilih Bahan</label>
            <select name="material" class="w-full border p-2 rounded" required>
                <option value="">-- Pilih Bahan --</option>
                <option value="katun">Katun</option>
                <option value="linen">Linen</option>
                <option value="sutra">Sutra</option>
                <option value="wol">Wol</option>
            </select>
        </div>

        <div class="mb-4">
            <label class="block mb-2 font-medium">Upload Referensi Model</label>
            <input type="file" name="reference_image" accept="image/*" class="w-full border p-2 rounded" required>
        </div>

        <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-2 rounded">
            Tambahkan ke Keranjang
        </button>
    </form>
</div>
@endsection
