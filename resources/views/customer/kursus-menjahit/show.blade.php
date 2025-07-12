@extends('layouts.app')

@section('title', $kursus->nama_kursus . ' - Detail Kursus')

@section('navbar')
    @include('include.customer.navbar')
    <div class="mt-8 md:mt-[66px] lg:mt-16"></div>
@endsection

@section('content')
<div class="bg-gray-50 min-h-screen">
    <!-- Breadcrumb -->
    <div class="bg-white shadow-sm">
        <div class="container mx-auto px-4 py-4">
            <nav class="flex text-sm text-gray-600">
                <a href="{{ route('customer.kursus-menjahit.index') }}" class="hover:text-indigo-600 transition-colors duration-200">
                    <i class="fa-solid fa-home mr-1"></i>Kursus Menjahit
                </a>
                <span class="mx-2">/</span>
                <span class="text-gray-800 font-medium">{{ $kursus->nama_kursus }}</span>
            </nav>
        </div>
    </div>

    <div class="container mx-auto px-4 py-8">
        @if ($message = Session::get('success'))
            <div id="alert-success" class="flex p-4 mb-6 bg-green-100 border border-green-200 rounded-lg animate-slide-in" role="alert">
                <svg aria-hidden="true" class="flex-shrink-0 w-5 h-5 text-green-700" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                <div class="ml-3 text-base text-green-700 font-medium">{{ $message }}</div>
                <button type="button" class="ml-auto bg-green-100 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex h-8 w-8" data-dismiss-target="#alert-success" aria-label="Close">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
        @endif

        @if ($message = Session::get('error'))
            <div id="alert-error" class="flex p-4 mb-6 bg-red-100 border border-red-200 rounded-lg animate-slide-in" role="alert">
                <svg aria-hidden="true" class="flex-shrink-0 w-5 h-5 text-red-700" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                </svg>
                <div class="ml-3 text-base text-red-700 font-medium">{{ $message }}</div>
                <button type="button" class="ml-auto bg-red-100 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex h-8 w-8" data-dismiss-target="#alert-error" aria-label="Close">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2">
                <!-- Course Header -->
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden mb-8">
                    <!-- Course Image -->
                    <div class="relative h-64 bg-gradient-to-br from-indigo-400 via-purple-500 to-pink-500">
                        @if($kursus->gambar)
                            <img src="{{ Storage::url($kursus->gambar) }}" alt="{{ $kursus->nama_kursus }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center">
                                <i class="fa-solid fa-scissors text-8xl text-white opacity-80"></i>
                            </div>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                        
                        <!-- Status Badge -->
                        <div class="absolute top-6 left-6">
                            @if($kursus->sisaSlot() <= 0)
                                <span class="bg-red-500 text-white px-4 py-2 rounded-full text-sm font-semibold">
                                    <i class="fa-solid fa-times mr-1"></i>Kelas Penuh
                                </span>
                            @elseif($kursus->sisaSlot() <= 3)
                                <span class="bg-orange-500 text-white px-4 py-2 rounded-full text-sm font-semibold animate-pulse">
                                    <i class="fa-solid fa-fire mr-1"></i>Hampir Penuh
                                </span>
                            @else
                                <span class="bg-green-500 text-white px-4 py-2 rounded-full text-sm font-semibold">
                                    <i class="fa-solid fa-check mr-1"></i>Tersedia
                                </span>
                            @endif
                        </div>

                        <!-- Price Badge -->
                        <div class="absolute top-6 right-6">
                            <span class="bg-white text-gray-800 px-4 py-2 rounded-full text-lg font-bold shadow-lg">
                                {{ $kursus->formatted_harga }}
                            </span>
                        </div>
                    </div>

                    <!-- Course Info -->
                    <div class="p-8">
                        <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $kursus->nama_kursus }}</h1>
                        
                        <!-- Quick Info -->
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                            <div class="text-center p-3 bg-indigo-50 rounded-lg">
                                <i class="fa-solid fa-user-tie text-indigo-600 text-2xl mb-2"></i>
                                <div class="text-sm text-gray-600">Instruktur</div>
                                <div class="font-semibold text-gray-800">{{ $kursus->instruktur }}</div>
                            </div>
                            <div class="text-center p-3 bg-green-50 rounded-lg">
                                <i class="fa-solid fa-users text-green-600 text-2xl mb-2"></i>
                                <div class="text-sm text-gray-600">Peserta</div>
                                <div class="font-semibold text-gray-800">{{ $kursus->pesertaKursus->count() }}/{{ $kursus->max_peserta }}</div>
                            </div>
                            <div class="text-center p-3 bg-blue-50 rounded-lg">
                                <i class="fa-solid fa-calendar text-blue-600 text-2xl mb-2"></i>
                                <div class="text-sm text-gray-600">Durasi</div>
                                <div class="font-semibold text-gray-800">{{ $kursus->tanggal_mulai->diffInDays($kursus->tanggal_selesai) + 1 }} hari</div>
                            </div>
                            <div class="text-center p-3 bg-purple-50 rounded-lg">
                                <i class="fa-solid fa-clock text-purple-600 text-2xl mb-2"></i>
                                <div class="text-sm text-gray-600">Waktu</div>
                                <div class="font-semibold text-gray-800">{{ $kursus->jam_mulai ?? '09:00' }}</div>
                            </div>
                        </div>

                        <!-- Progress Bar -->
                        <div class="mb-6">
                            <div class="flex justify-between text-sm text-gray-600 mb-2">
                                <span>Kapasitas Kelas</span>
                                <span>{{ $kursus->sisaSlot() }} dari {{ $kursus->max_peserta }} slot tersisa</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-3">
                                <div class="bg-gradient-to-r from-indigo-500 to-purple-600 h-3 rounded-full transition-all duration-1000" 
                                     style="width: {{ ($kursus->pesertaKursus->count() / $kursus->max_peserta) * 100 }}%"></div>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="mb-8">
                            <h3 class="text-xl font-semibold text-gray-800 mb-4">Deskripsi Kursus</h3>
                            <div class="prose max-w-none text-gray-600 leading-relaxed">
                                {!! nl2br(e($kursus->deskripsi)) !!}
                            </div>
                        </div>

                        <!-- Schedule Details -->
                        <div class="bg-gray-50 rounded-xl p-6 mb-8">
                            <h3 class="text-xl font-semibold text-gray-800 mb-4">
                                <i class="fa-solid fa-calendar-alt mr-2 text-indigo-600"></i>Jadwal Kursus
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="space-y-3">
                                    <div class="flex items-center">
                                        <i class="fa-solid fa-play text-green-600 w-5 mr-3"></i>
                                        <div>
                                            <div class="text-sm text-gray-600">Tanggal Mulai</div>
                                            <div class="font-semibold">{{ $kursus->tanggal_mulai->format('d F Y') }}</div>
                                        </div>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="fa-solid fa-flag-checkered text-red-600 w-5 mr-3"></i>
                                        <div>
                                            <div class="text-sm text-gray-600">Tanggal Selesai</div>
                                            <div class="font-semibold">{{ $kursus->tanggal_selesai->format('d F Y') }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="space-y-3">
                                    <div class="flex items-center">
                                        <i class="fa-solid fa-clock text-blue-600 w-5 mr-3"></i>
                                        <div>
                                            <div class="text-sm text-gray-600">Jam Kursus</div>
                                            <div class="font-semibold">{{ $kursus->jam_mulai ?? '09:00' }} - {{ $kursus->jam_selesai ?? '12:00' }}</div>
                                        </div>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="fa-solid fa-repeat text-purple-600 w-5 mr-3"></i>
                                        <div>
                                            <div class="text-sm text-gray-600">Hari</div>
                                            <div class="font-semibold">{{ $kursus->jadwal_hari_string }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- What You'll Learn -->
                        <div class="mb-8">
                            <h3 class="text-xl font-semibold text-gray-800 mb-4">
                                <i class="fa-solid fa-graduation-cap mr-2 text-indigo-600"></i>Yang Akan Anda Pelajari
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                <div class="flex items-center p-3 bg-green-50 rounded-lg">
                                    <i class="fa-solid fa-check-circle text-green-600 mr-3"></i>
                                    <span class="text-gray-700">Teknik dasar menjahit</span>
                                </div>
                                <div class="flex items-center p-3 bg-green-50 rounded-lg">
                                    <i class="fa-solid fa-check-circle text-green-600 mr-3"></i>
                                    <span class="text-gray-700">Penggunaan mesin jahit</span>
                                </div>
                                <div class="flex items-center p-3 bg-green-50 rounded-lg">
                                    <i class="fa-solid fa-check-circle text-green-600 mr-3"></i>
                                    <span class="text-gray-700">Pembuatan pola dasar</span>
                                </div>
                                <div class="flex items-center p-3 bg-green-50 rounded-lg">
                                    <i class="fa-solid fa-check-circle text-green-600 mr-3"></i>
                                    <span class="text-gray-700">Finishing dan penyelesaian</span>
                                </div>
                            </div>
                        </div>

                        <!-- Requirements -->
                        <div class="mb-8">
                            <h3 class="text-xl font-semibold text-gray-800 mb-4">
                                <i class="fa-solid fa-list-check mr-2 text-indigo-600"></i>Persyaratan
                            </h3>
                            <div class="bg-blue-50 p-4 rounded-lg">
                                <ul class="text-gray-700 space-y-2">
                                    <li class="flex items-center">
                                        <i class="fa-solid fa-circle text-blue-600 text-xs mr-3"></i>
                                        Tidak ada pengalaman khusus yang diperlukan
                                    </li>
                                    <li class="flex items-center">
                                        <i class="fa-solid fa-circle text-blue-600 text-xs mr-3"></i>
                                        Membawa buku catatan dan alat tulis
                                    </li>
                                    <li class="flex items-center">
                                        <i class="fa-solid fa-circle text-blue-600 text-xs mr-3"></i>
                                        Semangat belajar dan komitmen mengikuti kelas
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <!-- Registration Card -->
                <div class="bg-white rounded-2xl shadow-xl p-6 mb-6 sticky top-6">
                    @guest
                        <div class="text-center">
                            <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fa-solid fa-user-plus text-2xl text-blue-600"></i>
                            </div>
                            <h3 class="text-lg font-semibold mb-3">Ingin Bergabung?</h3>
                            <p class="text-gray-600 mb-6 text-sm">Login terlebih dahulu untuk mendaftar kursus ini</p>
                            <div class="space-y-3">
                                <a href="{{ route('login') }}" class="block w-full px-4 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition duration-300 font-medium">
                                    <i class="fa-solid fa-sign-in-alt mr-2"></i>Login
                                </a>
                                <a href="{{ route('register') }}" class="block w-full px-4 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition duration-300 font-medium">
                                    <i class="fa-solid fa-user-plus mr-2"></i>Daftar Gratis
                                </a>
                            </div>
                        </div>
                    @endguest

                    @auth
                        @if($sudahDaftar)
                            <div class="text-center">
                                <div class="bg-green-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <i class="fa-solid fa-check text-2xl text-green-600"></i>
                                </div>
                                <h3 class="text-lg font-semibold mb-3 text-green-800">Anda Sudah Terdaftar!</h3>
                                
                                @if($pesertaSaya->status_pembayaran == 'BELUM_BAYAR')
                                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-4">
                                        <p class="text-yellow-800 text-sm mb-3">
                                            <i class="fa-solid fa-exclamation-triangle mr-2"></i>
                                            Silakan upload bukti pembayaran
                                        </p>
                                        <form action="{{ route('customer.kursus-menjahit.upload-bukti', $pesertaSaya->id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="mb-3">
                                                <input type="file" name="bukti_pembayaran" accept="image/*" required 
                                                       class="w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                                            </div>
                                            <button type="submit" class="w-full px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition duration-300 text-sm">
                                                <i class="fa-solid fa-upload mr-2"></i>Upload Bukti
                                            </button>
                                        </form>
                                    </div>
                                @elseif($pesertaSaya->status_pembayaran == 'SUDAH_BAYAR')
                                    <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-4">
                                        <p class="text-green-800 text-sm">
                                            <i class="fa-solid fa-check-circle mr-2"></i>
                                            Pembayaran telah dikonfirmasi
                                        </p>
                                    </div>
                                @endif

                                <div class="flex space-x-2">
                                    <a href="{{ route('customer.kursus-menjahit.kursus-ku') }}" class="flex-1 px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition duration-300 text-sm text-center">
                                        <i class="fa-solid fa-user-graduate mr-2"></i>Kursus Saya
                                    </a>
                                    @if($pesertaSaya->status_pembayaran == 'BELUM_BAYAR')
                                        <form action="{{ route('customer.kursus-menjahit.batal-daftar', $pesertaSaya->id) }}" method="POST" class="flex-1">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="w-full px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition duration-300 text-sm" 
                                                    onclick="return confirm('Yakin ingin membatalkan pendaftaran?')">
                                                <i class="fa-solid fa-times mr-2"></i>Batal
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        @else
                            <div class="text-center">
                                <div class="text-3xl font-bold text-indigo-600 mb-2">{{ $kursus->formatted_harga }}</div>
                                <p class="text-gray-600 mb-6 text-sm">Termasuk sertifikat dan materi</p>
                                
                                @if($kursus->sisaSlot() > 0)
    <form action="{{ route('customer.kursus-menjahit.daftar', $kursus->id) }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="catatan" class="block text-sm font-medium text-gray-700 mb-2 text-left">Catatan (Opsional)</label>
            <textarea name="catatan" id="catatan" rows="3" 
                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm"
                      placeholder="Ceritakan tentang pengalaman atau ekspektasi Anda..."></textarea>
        </div>

        <button type="submit" class="w-full px-6 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 font-medium">
            <i class="fa-solid fa-sign-in-alt mr-2"></i>Daftar Sekarang
        </button>
    </form>
@else
    <button disabled class="w-full px-6 py-3 bg-gray-400 text-white rounded-lg cursor-not-allowed font-medium">
        <i class="fa-solid fa-times mr-2"></i>Kelas Sudah Penuh
    </button>
@endif
                            </div>
                        @endif
                    @endauth
                </div>

                <!-- Course Features -->
                <div class="bg-white rounded-2xl shadow-xl p-6 mb-6">
                    <h3 class="text-lg font-semibold mb-4">
                        <i class="fa-solid fa-star mr-2 text-yellow-500"></i>Keunggulan Kursus
                    </h3>
                    <div class="space-y-3">
                        <div class="flex items-center">
                            <i class="fa-solid fa-tools text-indigo-600 w-5 mr-3"></i>
                            <span class="text-sm text-gray-700">Peralatan lengkap disediakan</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fa-solid fa-certificate text-green-600 w-5 mr-3"></i>
                            <span class="text-sm text-gray-700">Sertifikat resmi</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fa-solid fa-users text-purple-600 w-5 mr-3"></i>
                            <span class="text-sm text-gray-700">Kelas kecil & personal</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fa-solid fa-book text-blue-600 w-5 mr-3"></i>
                            <span class="text-sm text-gray-700">Modul pembelajaran</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fa-solid fa-headset text-orange-600 w-5 mr-3"></i>
                            <span class="text-sm text-gray-700">Konsultasi setelah kursus</span>
                        </div>
                    </div>
                </div>

                <!-- Contact Info -->
                <div class="bg-gradient-to-br from-indigo-50 to-purple-50 rounded-2xl p-6">
                    <h3 class="text-lg font-semibold mb-4">
                        <i class="fa-solid fa-question-circle mr-2 text-indigo-600"></i>Butuh Bantuan?
                    </h3>
                    <div class="space-y-3">
                        <a href="https://wa.me/628128068617" class="flex items-center p-3 bg-green-500 text-white rounded-lg hover:bg-green-600 transition duration-300">
                            <i class="fa-brands fa-whatsapp text-xl mr-3"></i>
                            <span class="text-sm font-medium">Chat WhatsApp</span>
                        </a>
                        <a href="tel:081234567890" class="flex items-center p-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition duration-300">
                            <i class="fa-solid fa-phone text-xl mr-3"></i>
                            <span class="text-sm font-medium">Telepon Kami</span>
                        </a>
                        <a href="mailto:info@kursusmenjahit.com" class="flex items-center p-3 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition duration-300">
                            <i class="fa-solid fa-envelope text-xl mr-3"></i>
                            <span class="text-sm font-medium">Email</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Auto-dismiss alerts
setTimeout(function() {
    const alerts = document.querySelectorAll('[id^="alert-"]');
    alerts.forEach(alert => {
        if (alert) {
            alert.style.transition = 'opacity 0.5s ease-out';
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 500);
        }
    });
}, 5000);

// Smooth animations
document.addEventListener('DOMContentLoaded', function() {
    const elements = document.querySelectorAll('.animate-slide-in');
    elements.forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateX(-20px)';
        setTimeout(() => {
            el.style.transition = 'all 0.5s ease-out';
            el.style.opacity = '1';
            el.style.transform = 'translateX(0)';
        }, 100);
    });
});
</script>
@endsection