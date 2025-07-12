@extends('layouts.app')

@section('title', 'Lokasi Kami')

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
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Lokasi</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        <!-- Hero Section -->
        <section class="py-12 md:py-16">
            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-2xl p-8 md:p-12 shadow-sm">
                <div class="max-w-3xl mx-auto text-center">
                    <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-800 mb-4">
                        <span class="text-indigo-600">Lokasi</span> Putri Tailor
                    </h1>
                    <p class="text-lg text-gray-600 mb-6">Temukan lokasi toko kami</p>
                    <div class="w-20 h-1.5 bg-indigo-500 rounded-full mx-auto"></div>
                </div>
            </div>
        </section>

        <!-- Main Content -->
        <section class="pb-16">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Left Column - Map -->
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-800">Peta Lokasi</h2>
                    </div>
                    
                    <!-- Map Container -->
                    <div class="relative h-80 rounded-lg overflow-hidden border-2 border-gray-200">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15928.097041574505!2d101.4364885!3d0.5070675!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d5aea12d23ad05%3A0x3039d80b220cc90!2sPekanbaru%2C%20Pekanbaru%20City%2C%20Riau!5e0!3m2!1sen!2sid!4v1718270923456" 
                            width="100%" 
                            height="100%" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                    
                    <div class="mt-4 text-center">
                        <a href="https://maps.google.com/?q=Putri+Tailor+Pekanbaru" 
                           target="_blank" 
                           class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                            </svg>
                            Buka di Google Maps
                        </a>
                    </div>
                </div>

                <!-- Right Column - Address -->
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 rounded-full bg-indigo-100 flex items-center justify-center mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-800">Alamat Kami</h2>
                    </div>
                    
                    <div class="space-y-6">
                        <!-- Address -->
                        <div class="flex items-start">
                            <div class="flex-shrink-0 mt-1">
                                <div class="flex items-center justify-center h-8 w-8 rounded-full bg-red-100 text-red-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-3">
                                <h3 class="font-medium text-gray-800 text-lg">Alamat Lengkap</h3>
                                <p class="text-gray-600 mt-2 text-base leading-relaxed">
                                    jalan2
                                </p>
                            </div>
                        </div>
                        
                        <!-- Contact Info -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h4 class="font-medium text-gray-800 mb-3">Informasi Kontak</h4>
                            <div class="space-y-2 text-sm text-gray-600">
                                <p>
                                    <strong>Telepon:</strong> 
                                    <a href="tel:+6221234567890" class="hover:text-indigo-600 transition-colors">(021) 2345-6789</a>
                                </p>
                                <p>
                                    <strong>WhatsApp:</strong> 
                                    <a href="https://wa.me/628123456789" class="hover:text-indigo-600 transition-colors">+62 812-3456-789</a>
                                </p>
                                <p>
                                    <strong>Email:</strong> 
                                    <a href="mailto:info@putritailor.com" class="hover:text-indigo-600 transition-colors">info@putritailor.com</a>
                                </p>
                            </div>
                        </div>
                        
                        <!-- Operating Hours -->
                        <div class="bg-indigo-50 p-4 rounded-lg">
                            <h4 class="font-medium text-gray-800 mb-3">Jam Operasional</h4>
                            <div class="space-y-1 text-sm text-gray-600">
                                <p><strong>Senin - Jumat:</strong> 09:00 - 18:00 WIB</p>
                                <p><strong>Sabtu:</strong> 09:00 - 16:00 WIB</p>
                                <p><strong>Minggu:</strong> Tutup</p>
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