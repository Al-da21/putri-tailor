@extends('layouts.app')

@section('title', 'Cara Pesan')

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
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Cara Pesan</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        <!-- Hero Section -->
        <section class="py-12 md:py-16">
            <div class="bg-gradient-to-r from-indigo-50 to-purple-50 rounded-2xl p-8 md:p-12 shadow-sm">
                <div class="max-w-3xl mx-auto text-center">
                    <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-800 mb-4">Cara <span class="text-indigo-600">Memesan</span></h1>
                    <p class="text-lg text-gray-600 mb-6">Langkah mudah untuk memesan layanan jahit dan mendaftar kursus menjahit</p>
                    <div class="w-20 h-1.5 bg-indigo-500 rounded-full mx-auto"></div>
                </div>
            </div>
        </section>

        <!-- Main Content -->
        <section class="pb-16">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <!-- Left Column - Jasa Jahit -->
                <div class="space-y-8">
                    <div class="bg-white p-6 md:p-8 rounded-xl shadow-sm border border-gray-100">
                        <div class="flex items-center mb-6">
                            <div class="w-12 h-12 rounded-full bg-indigo-100 flex items-center justify-center mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4V2a1 1 0 011-1h4a1 1 0 011 1v2m-6 0h8m-8 0a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V6a2 2 0 00-2-2m-3 8l-3-3m0 0l3-3m-3 3h12" />
                                </svg>
                            </div>
                            <h2 class="text-2xl font-bold text-gray-800">Cara Pesan Jasa Jahit</h2>
                        </div>
                        
                        <!-- Steps -->
                        <div class="space-y-6">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 w-8 h-8 bg-indigo-500 text-white rounded-full flex items-center justify-center font-semibold text-sm mr-4">
                                    1
                                </div>
                                <div>
                                    <h3 class="font-semibold text-gray-800 mb-2">Konsultasi & Desain</h3>
                                    <p class="text-gray-600 text-sm">Hubungi kami untuk konsultasi desain, pilihan bahan, dan diskusi kebutuhan Anda</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start">
                                <div class="flex-shrink-0 w-8 h-8 bg-indigo-500 text-white rounded-full flex items-center justify-center font-semibold text-sm mr-4">
                                    2
                                </div>
                                <div>
                                    <h3 class="font-semibold text-gray-800 mb-2">Pengukuran</h3>
                                    <p class="text-gray-600 text-sm">Datang ke toko untuk pengukuran detail atau kami bisa datang ke lokasi Anda</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start">
                                <div class="flex-shrink-0 w-8 h-8 bg-indigo-500 text-white rounded-full flex items-center justify-center font-semibold text-sm mr-4">
                                    3
                                </div>
                                <div>
                                    <h3 class="font-semibold text-gray-800 mb-2">Konfirmasi & DP</h3>
                                    <p class="text-gray-600 text-sm">Konfirmasi pesanan dan bayar DP sebesar 50% dari total biaya</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start">
                                <div class="flex-shrink-0 w-8 h-8 bg-indigo-500 text-white rounded-full flex items-center justify-center font-semibold text-sm mr-4">
                                    4
                                </div>
                                <div>
                                    <h3 class="font-semibold text-gray-800 mb-2">Proses Jahit</h3>
                                    <p class="text-gray-600 text-sm">Tim ahli kami akan mengerjakan pesanan Anda dengan teliti (7-14 hari kerja)</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start">
                                <div class="flex-shrink-0 w-8 h-8 bg-indigo-500 text-white rounded-full flex items-center justify-center font-semibold text-sm mr-4">
                                    5
                                </div>
                                <div>
                                    <h3 class="font-semibold text-gray-800 mb-2">Fitting & Selesai</h3>
                                    <p class="text-gray-600 text-sm">Fitting terakhir, pelunasan pembayaran, dan pesanan siap diambil</p>
                                </div>
                            </div>
                        </div>

                        <!-- Contact Info -->
                        <div class="mt-8 p-4 bg-indigo-50 rounded-lg">
                            <h4 class="font-semibold text-indigo-700 mb-2">Kontak Pemesanan:</h4>
                            <div class="space-y-1 text-sm text-gray-600">
                                <p><i class="fa-brands fa-whatsapp mr-2 text-green-500"></i> WhatsApp: 0812-3456-7890</p>
                                <p><i class="fa-solid fa-phone mr-2 text-indigo-500"></i> Telepon: (021) 1234-5678</p>
                                <p><i class="fa-solid fa-envelope mr-2 text-purple-500"></i> Email: info@putritailor.com</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Kursus Menjahit -->
                <div class="space-y-8">
                    <div class="bg-white p-6 md:p-8 rounded-xl shadow-sm border border-gray-100">
                        <div class="flex items-center mb-6">
                            <div class="w-12 h-12 rounded-full bg-amber-100 flex items-center justify-center mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                            </div>
                            <h2 class="text-2xl font-bold text-gray-800">Cara Daftar Kursus</h2>
                        </div>
                        
                        <!-- Steps -->
                        <div class="space-y-6">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 w-8 h-8 bg-amber-500 text-white rounded-full flex items-center justify-center font-semibold text-sm mr-4">
                                    1
                                </div>
                                <div>
                                    <h3 class="font-semibold text-gray-800 mb-2">Pilih Program</h3>
                                    <p class="text-gray-600 text-sm">Lihat program kursus yang tersedia dan pilih sesuai level kemampuan Anda</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start">
                                <div class="flex-shrink-0 w-8 h-8 bg-amber-500 text-white rounded-full flex items-center justify-center font-semibold text-sm mr-4">
                                    2
                                </div>
                                <div>
                                    <h3 class="font-semibold text-gray-800 mb-2">Konsultasi Jadwal</h3>
                                    <p class="text-gray-600 text-sm">Hubungi kami untuk menentukan jadwal kelas yang sesuai dengan waktu Anda</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start">
                                <div class="flex-shrink-0 w-8 h-8 bg-amber-500 text-white rounded-full flex items-center justify-center font-semibold text-sm mr-4">
                                    3
                                </div>
                                <div>
                                    <h3 class="font-semibold text-gray-800 mb-2">Daftar & Bayar</h3>
                                    <p class="text-gray-600 text-sm">Isi formulir pendaftaran dan lakukan pembayaran sesuai program yang dipilih</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start">
                                <div class="flex-shrink-0 w-8 h-8 bg-amber-500 text-white rounded-full flex items-center justify-center font-semibold text-sm mr-4">
                                    4
                                </div>
                                <div>
                                    <h3 class="font-semibold text-gray-800 mb-2">Mulai Belajar</h3>
                                    <p class="text-gray-600 text-sm">Datang sesuai jadwal dan mulai belajar dengan instruktur berpengalaman</p>
                                </div>
                            </div>
                        </div>

                        <!-- Course Packages -->
                        <div class="mt-8 space-y-4">
                            <h4 class="font-semibold text-gray-800">Paket Kursus:</h4>
                            <div class="grid grid-cols-1 gap-3">
                                <div class="p-3 bg-amber-50 rounded-lg border border-amber-100">
                                    <div class="flex justify-between items-center">
                                        <h5 class="font-medium text-amber-700">Pemula (8 pertemuan)</h5>
                                        <span class="text-sm font-semibold text-gray-600">Rp 800.000</span>
                                    </div>
                                </div>
                                <div class="p-3 bg-amber-50 rounded-lg border border-amber-100">
                                    <div class="flex justify-between items-center">
                                        <h5 class="font-medium text-amber-700">Menengah (12 pertemuan)</h5>
                                        <span class="text-sm font-semibold text-gray-600">Rp 1.200.000</span>
                                    </div>
                                </div>
                                <div class="p-3 bg-amber-50 rounded-lg border border-amber-100">
                                    <div class="flex justify-between items-center">
                                        <h5 class="font-medium text-amber-700">Profesional (16 pertemuan)</h5>
                                        <span class="text-sm font-semibold text-gray-600">Rp 1.600.000</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Additional Info -->
                    <div class="bg-white p-6 md:p-8 rounded-xl shadow-sm border border-gray-100">
                        <div class="flex items-center mb-4">
                            <div class="w-10 h-10 rounded-full bg-emerald-100 flex items-center justify-center mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-800">Informasi Penting</h3>
                        </div>
                        <div class="space-y-3 text-sm text-gray-600">
                            <p>• Kelas tersedia dari Senin - Sabtu</p>
                            <p>• Maksimal 5 peserta per kelas</p>
                            <p>• Peralatan menjahit disediakan</p>
                            <p>• Bahan latihan sudah termasuk</p>
                            <p>• Sertifikat kelulusan tersedia</p>
                            <p>• Bisa reschedule 1x tanpa biaya tambahan</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('backTop')
    <!-- Back to Top -->
    <a id="back-to-top" onclick="toTop()" class="fixed z-[9999] bottom-6 right-6 cursor-pointer hidden items-center justify-center w-14 h-14 bg-indigo-500 text-white text-xl rounded-full p-4 shadow-lg hover:bg-indigo-600 transition-colors">
        <i class="fa-solid fa-chevron-up"></i>
    </a>
@endsection