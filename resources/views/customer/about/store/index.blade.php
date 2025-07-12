@extends('layouts.app')

@section('title', 'Tentang Kami')

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
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Tentang Kami</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        <!-- Hero Section -->
        <section class="py-12 md:py-16">
            <div class="bg-gradient-to-r from-indigo-50 to-purple-50 rounded-2xl p-8 md:p-12 shadow-sm">
                <div class="max-w-3xl mx-auto text-center">
                    <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-800 mb-4">Tentang <span class="text-indigo-600">Toko Jahit Kami</span></h1>
                    <p class="text-lg text-gray-600 mb-6">Kombinasi sempurna antara layanan jahit berkualitas dan kursus menjahit profesional</p>
                    <div class="w-20 h-1.5 bg-indigo-500 rounded-full mx-auto"></div>
                </div>
            </div>
        </section>

        <!-- Main Content -->
        <section class="pb-16">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <!-- Left Column -->
                <div class="space-y-10">
                    <!-- About Section -->
                    <div class="bg-white p-6 md:p-8 rounded-xl shadow-sm border border-gray-100">
                        <div class="flex items-center mb-6">
                            <div class="w-12 h-12 rounded-full bg-indigo-100 flex items-center justify-center mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <h2 class="text-2xl font-bold text-gray-800">Tentang Putri Tailor</h2>
                        </div>
                        <div class="text-gray-600 space-y-4">
                            <p>Kami adalah usaha jahit profesional yang telah berpengalaman lebih dari 10 tahun dalam industri fashion dan tailoring. Tidak hanya menyediakan layanan jahit berkualitas, kami juga berkomitmen untuk membagikan ilmu melalui berbagai program kursus menjahit.</p>
                            <p>Dengan tim yang terdiri dari penjahit berpengalaman dan pengajar bersertifikat, kami siap membantu mewujudkan kreasi fashion Anda sekaligus membimbing Anda menguasai keterampilan menjahit.</p>
                        </div>
                    </div>

                    <!-- Services Section -->
                    <div class="bg-white p-6 md:p-8 rounded-xl shadow-sm border border-gray-100">
                        <div class="flex items-center mb-6">
                            <div class="w-12 h-12 rounded-full bg-purple-100 flex items-center justify-center mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                            </div>
                            <h2 class="text-2xl font-bold text-gray-800">Layanan Jahit Kami</h2>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="bg-indigo-50 p-4 rounded-lg">
                                <h3 class="font-semibold text-indigo-700 mb-2 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Jahit Custom
                                </h3>
                                <p class="text-sm text-gray-600">Pakaian dibuat sesuai ukuran dan desain Anda</p>
                            </div>
                            <div class="bg-purple-50 p-4 rounded-lg">
                                <h3 class="font-semibold text-purple-700 mb-2 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Alterasi
                                </h3>
                                <p class="text-sm text-gray-600">Modifikasi pakaian agar pas di badan</p>
                            </div>
                            <div class="bg-indigo-50 p-4 rounded-lg">
                                <h3 class="font-semibold text-indigo-700 mb-2 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Busana Formal
                                </h3>
                                <p class="text-sm text-gray-600">Jas, gaun pesta, dan busana resmi</p>
                            </div>
                            <div class="bg-purple-50 p-4 rounded-lg">
                                <h3 class="font-semibold text-purple-700 mb-2 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Produk Rumah
                                </h3>
                                <p class="text-sm text-gray-600">Tirai, sarung bantal, dan lain-lain</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="space-y-10">
                    <!-- Courses Section -->
                    <div class="bg-white p-6 md:p-8 rounded-xl shadow-sm border border-gray-100">
                        <div class="flex items-center mb-6">
                            <div class="w-12 h-12 rounded-full bg-amber-100 flex items-center justify-center mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                            </div>
                            <h2 class="text-2xl font-bold text-gray-800">Kursus Menjahit</h2>
                        </div>
                        <div class="space-y-4">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 mt-1">
                                    <div class="flex items-center justify-center h-6 w-6 rounded-full bg-amber-100 text-amber-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-3">
                                    <h3 class="font-medium text-gray-800">Kelas Pemula</h3>
                                    <p class="text-sm text-gray-600 mt-1">Dasar-dasar menjahit dengan mesin dan tangan</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <div class="flex-shrink-0 mt-1">
                                    <div class="flex items-center justify-center h-6 w-6 rounded-full bg-amber-100 text-amber-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-3">
                                    <h3 class="font-medium text-gray-800">Kelas Menengah</h3>
                                    <p class="text-sm text-gray-600 mt-1">Teknik pola, pemilihan bahan, dan finishing</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <div class="flex-shrink-0 mt-1">
                                    <div class="flex items-center justify-center h-6 w-6 rounded-full bg-amber-100 text-amber-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-3">
                                    <h3 class="font-medium text-gray-800">Kelas Profesional</h3>
                                    <p class="text-sm text-gray-600 mt-1">Untuk yang ingin berkarir di industri fashion</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <div class="flex-shrink-0 mt-1">
                                    <div class="flex items-center justify-center h-6 w-6 rounded-full bg-amber-100 text-amber-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-3">
                                    <h3 class="font-medium text-gray-800">Workshop Khusus</h3>
                                    <p class="text-sm text-gray-600 mt-1">Quilting, sulam, dan teknik spesialis lainnya</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Values Section -->
                    <div class="bg-white p-6 md:p-8 rounded-xl shadow-sm border border-gray-100">
                        <div class="flex items-center mb-6">
                            <div class="w-12 h-12 rounded-full bg-emerald-100 flex items-center justify-center mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                </svg>
                            </div>
                            <h2 class="text-2xl font-bold text-gray-800">Nilai Kami</h2>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="bg-gradient-to-br from-indigo-50 to-white p-4 rounded-lg border border-indigo-100">
                                <h3 class="font-semibold text-indigo-700 mb-2">Kualitas Terbaik</h3>
                                <p class="text-sm text-gray-600">Bahan premium dan teknik jahit presisi untuk hasil sempurna</p>
                            </div>
                            <div class="bg-gradient-to-br from-purple-50 to-white p-4 rounded-lg border border-purple-100">
                                <h3 class="font-semibold text-purple-700 mb-2">Pengajar Berpengalaman</h3>
                                <p class="text-sm text-gray-600">Instruktur bersertifikat dengan pengalaman praktis</p>
                            </div>
                            <div class="bg-gradient-to-br from-amber-50 to-white p-4 rounded-lg border border-amber-100">
                                <h3 class="font-semibold text-amber-700 mb-2">Fleksibilitas</h3>
                                <p class="text-sm text-gray-600">Jadwal kursus yang disesuaikan dengan kebutuhan Anda</p>
                            </div>
                            <div class="bg-gradient-to-br from-emerald-50 to-white p-4 rounded-lg border border-emerald-100">
                                <h3 class="font-semibold text-emerald-700 mb-2">Kreativitas</h3>
                                <p class="text-sm text-gray-600">Mendorong ekspresi kreatif dalam setiap karya</p>
                            </div>
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