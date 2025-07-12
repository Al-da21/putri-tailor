@extends('layouts.app-admin')

@section('title', isset($item) ? 'Edit Produk' : 'Tambah Produk')

@section('admin')
    <div class="lg:ml-5 mt-3">
        <div class="flex gap-3 items-center">
            <x-link to="{{ url('admin/product') }}" size="lg" icon="fa-chevron-left mr-1" text="Kembali" padding="py-2 px-4"
                color="blue" />
            <div class="text-lg font-medium">Form {{ isset($item) ? 'Edit Produk' : 'Tambah Produk' }}</div>
        </div>

        <div class="max-w-4xl mt-3 p-4 bg-white shadow-md rounded-md">
            <form class="space-y-2" action="{{ isset($item) ? url('/admin/product/' . $item->id) : url('/admin/product') }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                @if (isset($item))
                    @method('PUT')
                @endif

                <div class="grid md:grid-cols-2 md:gap-6">

                    <div class="space-y-2">
                        <div>
                            <label for="name" class="block mb-3 text-sm font-medium text-slate-900">Nama</label>
                            <input type="text" name="name" id="name"
                                class="bg-slate-100 border border-slate-400 text-slate-900 text-sm rounded-md block w-full p-2.5"
                                value="{{ old('name', isset($item) ? $item->name : '') }}">
                            @error('name')
                                <span class="text-xs text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="size" class="block mb-3 text-sm font-medium text-slate-900">Size</label>
                            <input type="text" name="size" id="size"
                                class="bg-slate-100 border border-slate-400 text-slate-900 text-sm rounded-md block w-full p-2.5"
                                value="{{ old('size', isset($item) ? $item->size : '') }}">
                            @error('size')
                                <span class="text-xs text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="space-y-2">
                        <div>
                            <label for="price" class="block mb-3 text-sm font-medium text-slate-900">Harga Jual</label>
                            <input type="number" name="price" id="price"
                                class="bg-slate-100 border border-slate-400 text-slate-900 text-sm rounded-md block w-full p-2.5"
                                value="{{ old('price', isset($item) ? $item->price : '') }}">
                            @error('price')
                                <span class="text-xs text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            @if (isset($item) && $item->image)
                                <img id="image-preview" src="{{ Storage::url($item->image) }}" class="mb-2 max-w-xs rounded" />
                            @else
                                <img id="image-preview" class="mb-2 max-w-xs rounded" />
                            @endif
                        </div>

                        <div>
                            <label class="block mb-2 text-sm font-medium text-slate-900" for="image">Upload Gambar</label>
                            <input type="file" name="image"
                                class="block w-full text-sm text-slate-900 border border-slate-400 rounded-md cursor-pointer bg-slate-100 focus:outline-none"
                                id="image" onchange="previewImage()">
                            @error('image')
                                <span class="text-xs text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                </div>

                <div>
                    <label for="description" class="block mb-3 text-sm font-medium text-slate-900">Deskripsi</label>
                    <textarea name="description" id="editor">{{ old('description', isset($item) ? $item->description : '') }}</textarea>
                    @error('description')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit"
                    class="w-full text-white font-medium rounded-lg text-sm px-5 py-3 text-center bg-blue-500 hover:opacity-80">
                    {{ isset($item) ? 'Edit' : 'Tambah' }}
                </button>

            </form>
        </div>
    </div>
@endsection

@push('addon-script')
    <script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('editor');

        function previewImage() {
            const image = document.querySelector('#image');
            const preview = document.querySelector('#image-preview');

            const file = image.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = e => {
                    preview.src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        }
    </script>
@endpush
