@extends('layouts.app')

@section('title', 'Kursus Menjahit')

@section('navbar')
    @include('include.customer.navbar')
    <div class="mt-8 md:mt-[66px] lg:mt-16"></div>
@endsection

@section('content')
<div class="bg-gray-50 min-h-screen">
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 text-white py-20 relative overflow-hidden">
        <div class="absolute inset-0 bg-black opacity-10"></div>
        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center">
                <div class="mb-6">
                    <i class="fa-solid fa-scissors text-6xl opacity-80"></i>
                </div>
                <h1 class="text-5xl font-bold mb-4 animate-fade-in">Kursus Menjahit Dengan Putri Tailor</h1>
                <p class="text-xl opacity-90 max-w-2xl mx-auto">Belajar menjahit dengan instruktur berpengalaman dan raih keahlian yang menguntungkan</p>
                <div class="mt-8 flex justify-center space-x-8 text-sm">
                    <div class="flex items-center">
                        <i class="fa-solid fa-star text-yellow-300 mr-2"></i>
                        <span>Instruktur Bersertifikat</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fa-solid fa-award text-yellow-300 mr-2"></i>
                        <span>Sertifikat Kelulusan</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fa-solid fa-tools text-yellow-300 mr-2"></i>
                        <span>Peralatan Lengkap</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 py-12">
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

        <!-- CTA untuk user yang belum login -->
        @guest
            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border-2 border-blue-200 rounded-2xl p-8 mb-12 text-center shadow-lg">
                <div class="text-blue-800">
                    <div class="bg-blue-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fa-solid fa-user-plus text-3xl text-blue-600"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-3">Bergabunglah dengan Komunitas Menjahit Kami!</h3>
                    <p class="text-blue-700 mb-6 text-lg max-w-2xl mx-auto">Mulai perjalanan kreatif Anda dan pelajari keterampilan menjahit yang bermanfaat. Daftar sekarang dan dapatkan akses ke semua kursus!</p>
                    <div class="space-x-4">
                        <a href="{{ route('login') }}" class="inline-flex items-center px-8 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                            <i class="fa-solid fa-sign-in-alt mr-2"></i>Masuk
                        </a>
                        <a href="{{ route('register') }}" class="inline-flex items-center px-8 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                            <i class="fa-solid fa-user-plus mr-2"></i>Daftar Gratis
                        </a>
                    </div>
                </div>
            </div>
        @endguest

        @auth
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-12 gap-4">
                <div>
                    <h2 class="text-3xl font-bold text-gray-800 mb-2">Kursus Tersedia</h2>
                    <p class="text-gray-600">Pilih kursus yang sesuai dengan level dan minat Anda</p>
                </div>
                <div class="flex space-x-3">
                    <a href="{{ route('customer.kursus-menjahit.kursus-ku') }}" class="inline-flex items-center px-6 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition duration-300 shadow-lg hover:shadow-xl">
                        <i class="fa-solid fa-user-graduate mr-2"></i>Kursus Saya
                    </a>
                    <div class="relative">
                        <button class="inline-flex items-center px-4 py-3 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition duration-300" onclick="toggleFilter()">
                            <i class="fa-solid fa-filter mr-2"></i>Filter
                        </button>
                    </div>
                </div>
            </div>
        @endauth

        @guest
            <div class="mb-12">
                <h2 class="text-3xl font-bold text-gray-800 mb-2 text-center">Kursus Populer</h2>
                <p class="text-gray-600 text-center">Lihat berbagai pilihan kursus menjahit yang tersedia</p>
            </div>
        @endguest

        <!-- Grid Kursus -->
        <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-8">
            @forelse ($kursus as $item)
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 group">
                    <!-- Image Section -->
                    <div class="relative h-48 bg-gradient-to-br from-indigo-400 via-purple-500 to-pink-500 overflow-hidden">
                        @if($item->gambar)
                            <img src="{{ Storage::url($item->gambar) }}" alt="{{ $item->nama_kursus }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        @else
                            <div class="w-full h-full flex items-center justify-center">
                                <i class="fa-solid fa-scissors text-6xl text-white opacity-80"></i>
                            </div>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                        
                        <!-- Badge Level/Status -->
                        <div class="absolute top-4 left-4">
                            <span class="bg-white/90 text-gray-800 px-3 py-1 rounded-full text-sm font-semibold backdrop-blur-sm">
                                {{ $item->level ?? 'Semua Level' }}
                            </span>
                        </div>
                        
                        <!-- Badge Harga -->
                        <div class="absolute top-4 right-4">
                            <span class="bg-green-500 text-white px-3 py-1 rounded-full text-sm font-bold">
                                {{ $item->formatted_harga }}
                            </span>
                        </div>

                        <!-- Status Slot -->
                        <div class="absolute bottom-4 left-4">
                            @if($item->sisaSlot() <= 3 && $item->sisaSlot() > 0)
                                <span class="bg-orange-500 text-white px-3 py-1 rounded-full text-xs font-semibold animate-pulse">
                                    <i class="fa-solid fa-fire mr-1"></i>Hampir Penuh!
                                </span>
                            @elseif($item->sisaSlot() <= 0)
                                <span class="bg-red-500 text-white px-3 py-1 rounded-full text-xs font-semibold">
                                    <i class="fa-solid fa-times mr-1"></i>Penuh
                                </span>
                            @else
                                <span class="bg-green-500 text-white px-3 py-1 rounded-full text-xs font-semibold">
                                    <i class="fa-solid fa-check mr-1"></i>Tersedia
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="p-6">
                        <!-- Title -->
                        <h3 class="text-xl font-bold text-gray-800 mb-3 group-hover:text-indigo-600 transition-colors duration-300">
                            {{ $item->nama_kursus }}
                        </h3>

                        <!-- Description -->
                        <p class="text-gray-600 mb-4 text-sm leading-relaxed">
                            {{ Str::limit($item->deskripsi, 120) }}
                        </p>
                        
                        <!-- Info Grid -->
                        <div class="grid grid-cols-2 gap-3 mb-6">
                            <div class="flex items-center text-sm text-gray-600">
                                <i class="fa-solid fa-user-tie w-4 mr-2 text-indigo-500"></i>
                                <span class="truncate">{{ $item->instruktur }}</span>
                            </div>
                            <div class="flex items-center text-sm text-gray-600">
                                <i class="fa-solid fa-users w-4 mr-2 text-green-500"></i>
                                <span>{{ $item->pesertaKursus->count() }}/{{ $item->max_peserta }}</span>
                            </div>
                            <div class="flex items-center text-sm text-gray-600">
                                <i class="fa-solid fa-calendar w-4 mr-2 text-blue-500"></i>
                                <span class="truncate">{{ $item->tanggal_mulai->format('d M') }}</span>
                            </div>
                            <div class="flex items-center text-sm text-gray-600">
                                <i class="fa-solid fa-clock w-4 mr-2 text-purple-500"></i>
                                <span class="truncate">{{ $item->jam_mulai ?? '09:00' }}</span>
                            </div>
                        </div>

                        <!-- Detailed Schedule -->
                        <div class="bg-gray-50 rounded-lg p-3 mb-4">
                            <div class="text-xs text-gray-500 mb-1">Jadwal Lengkap</div>
                            <div class="text-sm text-gray-700">
                                <div class="flex items-center mb-1">
                                    <i class="fa-solid fa-calendar-days w-4 mr-2 text-indigo-400"></i>
                                    <span>{{ $item->tanggal_mulai->format('d M Y') }} - {{ $item->tanggal_selesai->format('d M Y') }}</span>
                                </div>
                                <div class="flex items-center mb-1">
                                    <i class="fa-solid fa-clock w-4 mr-2 text-purple-400"></i>
                                    <span>{{ $item->jam_mulai ?? '09:00' }} - {{ $item->jam_selesai ?? '12:00' }}</span>
                                </div>
                                <div class="flex items-center">
                                    <i class="fa-solid fa-repeat w-4 mr-2 text-green-400"></i>
                                    <span>{{ $item->jadwal_hari_string }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Progress Bar -->
                        <div class="mb-6">
                            <div class="flex justify-between text-xs text-gray-500 mb-2">
                                <span>Kapasitas Terisi</span>
                                <span>{{ $item->sisaSlot() }} slot tersisa</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2 overflow-hidden">
                                <div class="bg-gradient-to-r from-indigo-500 to-purple-600 h-2 rounded-full transition-all duration-1000 ease-out" 
                                     style="width: {{ ($item->pesertaKursus->count() / $item->max_peserta) * 100 }}%"></div>
                            </div>
                        </div>

                        <!-- Action Button -->
                        <a href="{{ route('customer.kursus-menjahit.show', $item->id) }}" 
                           class="group/btn block w-full text-center px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-lg hover:from-indigo-700 hover:to-purple-700 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                            <span class="flex items-center justify-center">
                                <i class="fa-solid fa-eye mr-2 group-hover/btn:scale-110 transition-transform duration-300"></i>
                                Lihat Detail & Daftar
                            </span>
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-16">
                    <div class="text-gray-400">
                        <div class="bg-gray-100 w-24 h-24 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fa-solid fa-graduation-cap text-4xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold mb-3 text-gray-600">Belum Ada Kursus Tersedia</h3>
                        <p class="text-gray-500 max-w-md mx-auto mb-6">Kursus menjahit akan segera tersedia. Daftarkan email Anda untuk mendapatkan notifikasi!</p>
                        <button class="px-6 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition duration-300">
                            <i class="fa-solid fa-bell mr-2"></i>Beritahu Saya
                        </button>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Info Section -->
        <div class="mt-20 bg-white rounded-2xl shadow-xl p-8 lg:p-12">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Mengapa Memilih Kursus Kami?</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Dapatkan pengalaman belajar terbaik dengan fasilitas lengkap dan instruktur berpengalaman</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center group hover:transform hover:scale-105 transition-all duration-300">
                    <div class="bg-gradient-to-br from-indigo-100 to-indigo-200 w-20 h-20 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:shadow-lg transition-all duration-300">
                        <i class="fa-solid fa-graduation-cap text-3xl text-indigo-600"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-4 text-gray-800">Instruktur Berpengalaman</h3>
                    <p class="text-gray-600 leading-relaxed">Belajar langsung dari instruktur profesional dengan pengalaman lebih dari 10 tahun di industri fashion</p>
                </div>
                
                <div class="text-center group hover:transform hover:scale-105 transition-all duration-300">
                    <div class="bg-gradient-to-br from-green-100 to-green-200 w-20 h-20 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:shadow-lg transition-all duration-300">
                        <i class="fa-solid fa-certificate text-3xl text-green-600"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-4 text-gray-800">Sertifikat Resmi</h3>
                    <p class="text-gray-600 leading-relaxed">Dapatkan sertifikat yang diakui industri setelah menyelesaikan kursus dan lulus ujian praktik</p>
                </div>
                
                <div class="text-center group hover:transform hover:scale-105 transition-all duration-300">
                    <div class="bg-gradient-to-br from-purple-100 to-purple-200 w-20 h-20 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:shadow-lg transition-all duration-300">
                        <i class="fa-solid fa-users text-3xl text-purple-600"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-4 text-gray-800">Kelas Kecil</h3>
                    <p class="text-gray-600 leading-relaxed">Maksimal 12 peserta per kelas untuk memastikan setiap siswa mendapat perhatian personal</p>
                </div>
            </div>
        </div>

        <!-- Testimonial Section -->
        <div class="mt-16 text-center">
            <h2 class="text-3xl font-bold text-gray-800 mb-12">Apa Kata Alumni Kami?</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="bg-white p-6 rounded-xl shadow-lg">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-indigo-100 rounded-full flex items-center justify-center mr-3">
                            <i class="fa-solid fa-user text-indigo-600"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold">Sarah M.</h4>
                            <div class="flex text-yellow-400 text-sm">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </div>
                        </div>
                    </div>
                    <p class="text-gray-600 text-sm">"Kursus yang sangat membantu! Sekarang saya bisa membuka usaha jahit sendiri di rumah."</p>
                </div>
                
                <div class="bg-white p-6 rounded-xl shadow-lg">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mr-3">
                            <i class="fa-solid fa-user text-green-600"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold">Rina K.</h4>
                            <div class="flex text-yellow-400 text-sm">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </div>
                        </div>
                    </div>
                    <p class="text-gray-600 text-sm">"Instrukturnya sabar dan metode mengajarnya mudah dipahami. Recommended banget!"</p>
                </div>
                
                <div class="bg-white p-6 rounded-xl shadow-lg">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center mr-3">
                            <i class="fa-solid fa-user text-purple-600"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold">Maya L.</h4>
                            <div class="flex text-yellow-400 text-sm">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </div>
                        </div>
                    </div>
                    <p class="text-gray-600 text-sm">"Fasilitas lengkap dan suasana belajar yang nyaman. Worth it untuk investasi skill!"</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function toggleFilter() {
    // Add filter functionality here
    alert('Filter functionality will be implemented');
}

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

// Smooth scroll animation
document.addEventListener('DOMContentLoaded', function() {
    const cards = document.querySelectorAll('.grid > div');
    cards.forEach((card, index) => {
        card.style.animationDelay = `${index * 0.1}s`;
        card.classList.add('animate-fade-in-up');
    });
});
</script>

<style>
@keyframes fade-in {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

@keyframes slide-in {
    from { opacity: 0; transform: translateX(-20px); }
    to { opacity: 1; transform: translateX(0); }
}

@keyframes fade-in-up {
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
}

.animate-fade-in {
    animation: fade-in 0.6s ease-out;
}

.animate-slide-in {
    animation: slide-in 0.5s ease-out;
}

.animate-fade-in-up {
    animation: fade-in-up 0.6s ease-out forwards;
    opacity: 0;
}
</style>
@endsection