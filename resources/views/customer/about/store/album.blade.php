@extends('layouts.app')

@section('title', 'Album')

@section('navbar')
    @include('include.customer.navbar')
    <div class="mt-14 md:mt-[66px] lg:mt-16"></div>
@endsection

@section('content')
    <div class="px-4 lg:px-10 mx-auto w-full max-w-screen-xl">

        <!-- Breadcrumb -->
        <div class="pt-10">
            <nav class="flex px-5 py-3 text-gray-700 border border-gray-200 rounded-lg bg-white shadow-sm"
                aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ url('/') }}"
                            class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-indigo-600 transition-colors">
                            <svg aria-hidden="true" class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z">
                                </path>
                            </svg>
                            Beranda
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg aria-hidden="true" class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Album</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        <!-- Hero Section -->
        <section class="py-12 md:py-16">
            <div class="bg-gradient-to-r from-indigo-50 to-purple-50 rounded-2xl p-8 md:p-12 shadow-sm">
                <div class="max-w-3xl mx-auto text-center">
                    <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-800 mb-4">Galeri <span class="text-indigo-600">Karya Kami</span></h1>
                    <p class="text-lg text-gray-600 mb-6">Koleksi hasil jahitan dan kreasi para peserta kursus menjahit</p>
                    <div class="w-20 h-1.5 bg-indigo-500 rounded-full mx-auto"></div>
                </div>
            </div>
        </section>

        <!-- Gallery Grid -->
        <section class="pb-16">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                
                @php
                    // Mengambil semua file gambar dari storage/app/public/album
                    $albumPath = public_path('storage/album');
                    $images = [];
                    
                    if (is_dir($albumPath)) {
                        $files = scandir($albumPath);
                        foreach ($files as $file) {
                            if ($file !== '.' && $file !== '..' && in_array(strtolower(pathinfo($file, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
                                $images[] = $file;
                            }
                        }
                    }
                @endphp

                @if(count($images) > 0)
                    @foreach($images as $image)
                        <div class="gallery-item bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-lg transition-shadow">
                            <div class="w-full overflow-hidden bg-white flex items-center justify-center aspect-[4/3] md:aspect-[4/3]">
                                <img src="{{ asset('storage/album/' . $image) }}" 
                                    alt="Album Image" 
                                    class="max-h-72 w-auto object-contain hover:scale-105 transition-transform duration-300 cursor-pointer"
                                    onclick="openModal('{{ asset('storage/album/' . $image) }}')">
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-span-full text-center py-12">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <p class="text-gray-500">Belum ada gambar dalam album</p>
                    </div>
                @endif

            </div>
        </section>

    </div>

    <!-- Modal untuk menampilkan gambar fullscreen -->
    <div id="imageModal" class="fixed inset-0 bg-black bg-opacity-75 z-50 hidden items-center justify-center p-4">
        <div class="relative max-w-4xl max-h-full">
            <button onclick="closeModal()" class="absolute top-4 right-4 text-white text-2xl hover:text-gray-300 z-10">
                <i class="fa-solid fa-times"></i>
            </button>
            <img id="modalImage" src="" alt="Full Image" class="max-w-full max-h-full object-contain">
        </div>
    </div>

    <!-- JavaScript untuk Modal -->
    <script>
        function openModal(imageSrc) {
            document.getElementById('modalImage').src = imageSrc;
            document.getElementById('imageModal').classList.remove('hidden');
            document.getElementById('imageModal').classList.add('flex');
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            document.getElementById('imageModal').classList.add('hidden');
            document.getElementById('imageModal').classList.remove('flex');
            document.body.style.overflow = 'auto';
        }

        // Tutup modal jika klik di luar gambar
        document.getElementById('imageModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });

        // Tutup modal dengan tombol Escape
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeModal();
            }
        });
    </script>
@endsection

@section('backTop')
    <!-- Back to Top -->
    <a id="back-to-top" onclick="toTop()" class="fixed z-[9999] bottom-6 right-6 cursor-pointer hidden items-center justify-center w-14 h-14 bg-indigo-500 text-white text-xl rounded-full p-4 shadow-lg hover:bg-indigo-600 transition-colors">
        <i class="fa-solid fa-chevron-up"></i>
    </a>
@endsection