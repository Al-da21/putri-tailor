@extends('layouts.app')
@section('title', 'Kursus Saya')

@section('navbar')
    @include('include.customer.navbar')
    <div class="mt-8 md:mt-[66px] lg:mt-16"></div>
@endsection

@section('content')
<div class="bg-gray-50 min-h-screen">
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 text-white py-16">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-4xl font-bold mb-2">Kursus Saya</h1>
                    <p class="text-xl opacity-90">Kelola dan pantau progress kursus Anda</p>
                </div>
                <div class="hidden md:block">
                    <div class="bg-white/20 backdrop-blur-sm rounded-2xl p-6 text-center">
                        <div class="text-3xl font-bold">{{ $pesertaKursus->count() }}</div>
                        <div class="text-sm opacity-90">Total Kursus</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Breadcrumb -->
    <div class="bg-white shadow-sm">
        <div class="container mx-auto px-4 py-4">
            <nav class="flex text-sm text-gray-600">
                <a href="{{ route('customer.kursus-menjahit.index') }}" class="hover:text-indigo-600 transition-colors duration-200">
                    <i class="fa-solid fa-home mr-1"></i>Kursus Menjahit
                </a>
                <span class="mx-2">/</span>
                <span class="text-gray-800 font-medium">Kursus Saya</span>
            </nav>
        </div>
    </div>

    <div class="container mx-auto px-4 py-8">
        <!-- Success Alert -->
        @if ($message = Session::get('success'))
            <div id="alert-success" class="flex p-4 mb-6 bg-green-100 border border-green-200 rounded-lg animate-slide-in" role="alert">
                <svg aria-hidden="true" class="flex-shrink-0 w-5 h-5 text-green-700" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                <div class="ml-3 text-sm font-medium text-green-800">
                    {{ $message }}
                </div>
                <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-green-100 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex h-8 w-8" onclick="document.getElementById('alert-success').remove()">
                    <span class="sr-only">Close</span>
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
        @endif

        <!-- Error Alert -->
        @if ($message = Session::get('error'))
            <div id="alert-error" class="flex p-4 mb-6 bg-red-100 border border-red-200 rounded-lg animate-slide-in" role="alert">
                <svg aria-hidden="true" class="flex-shrink-0 w-5 h-5 text-red-700" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                </svg>
                <div class="ml-3 text-sm font-medium text-red-800">
                    {{ $message }}
                </div>
                <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-red-100 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex h-8 w-8" onclick="document.getElementById('alert-error').remove()">
                    <span class="sr-only">Close</span>
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
        @endif

        <!-- Course List -->
        @if($pesertaKursus->count() > 0)
            <div class="grid gap-6">
                @foreach($pesertaKursus as $peserta)
                    <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden">
                        <div class="md:flex">
                            <!-- Course Image -->
                            {{-- <div class="md:w-1/3">
                                @if($peserta->kursus->gambar)
                                    <img src="{{ asset('storage/' . $peserta->kursus->gambar) }}" 
                                         alt="{{ $peserta->kursus->nama_kursus }}" 
                                         class="w-full h-48 md:h-full object-cover">
                                @else
                                    <div class="w-full h-48 md:h-full bg-gradient-to-br from-indigo-100 to-purple-100 flex items-center justify-center">
                                        <i class="fa-solid fa-scissors text-4xl text-indigo-400"></i>
                                    </div>
                                @endif
                            </div> --}}

                            <!-- Course Details -->
                            <div class="md:w-2/3 p-6">
                                <div class="flex justify-between items-start mb-4">
                                    <h3 class="text-2xl font-bold text-gray-800 mb-2">{{ $peserta->kursus->nama_kursus }}</h3>
                                    <!-- Status Badge -->
                                    <div class="flex flex-col gap-2">
                                        @if($peserta->status_pembayaran == 'SUDAH_BAYAR')
                                            <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                                <i class="fa-solid fa-check-circle mr-1"></i>
                                                Sudah Bayar
                                            </span>
                                        @else
                                            <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                <i class="fa-solid fa-clock mr-1"></i>
                                                Belum Bayar
                                            </span>
                                        @endif

                                        @if($peserta->status_kehadiran == 'HADIR')
                                            <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                                <i class="fa-solid fa-user-check mr-1"></i>
                                                Hadir
                                            </span>
                                        @elseif($peserta->status_kehadiran == 'TIDAK_HADIR')
                                            <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                                <i class="fa-solid fa-user-times mr-1"></i>
                                                Tidak Hadir
                                            </span>
                                        @else
                                            <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">
                                                <i class="fa-solid fa-user-clock mr-1"></i>
                                                Terdaftar
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <!-- Course Info -->
                                <div class="grid md:grid-cols-2 gap-4 mb-4 text-sm text-gray-600">
                                    <div class="flex items-center">
                                        <i class="fa-solid fa-calendar-alt w-5 text-indigo-500 mr-2"></i>
                                        <span>{{ \Carbon\Carbon::parse($peserta->kursus->tanggal_mulai)->format('d M Y') }}</span>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="fa-solid fa-clock w-5 text-indigo-500 mr-2"></i>
                                        <span>{{ \Carbon\Carbon::parse($peserta->kursus->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($peserta->kursus->jam_selesai)->format('H:i') }}</span>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="fa-solid fa-users w-5 text-indigo-500 mr-2"></i>
                                        <span>{{ $peserta->kursus->pesertaKursus->count() }}/{{ $peserta->kursus->max_peserta }} peserta</span>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="fa-solid fa-money-bill w-5 text-indigo-500 mr-2"></i>
                                        <span class="font-semibold text-green-600">Rp {{ number_format($peserta->kursus->harga, 0, ',', '.') }}</span>
                                    </div>
                                </div>

                                <!-- Registration Info -->
                                <div class="bg-gray-50 rounded-lg p-4 mb-4">
                                    <div class="flex items-center justify-between text-sm">
                                        <span class="text-gray-600">Tanggal Daftar:</span>
                                        <span class="font-medium">{{ \Carbon\Carbon::parse($peserta->tanggal_daftar)->format('d M Y H:i') }}</span>
                                    </div>
                                    @if($peserta->catatan)
                                        <div class="mt-2 pt-2 border-t border-gray-200">
                                            <span class="text-gray-600 text-sm">Catatan:</span>
                                            <p class="text-sm text-gray-700 mt-1">{{ $peserta->catatan }}</p>
                                        </div>
                                    @endif
                                </div>

                                <!-- Action Buttons -->
                                <div class="flex flex-wrap gap-3">
                                    <!-- View Details Button -->
                                    <a href="{{ route('customer.kursus-menjahit.show', $peserta->kursus->id) }}" 
                                       class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors duration-200">
                                        <i class="fa-solid fa-eye mr-2"></i>
                                        Detail Kursus
                                    </a>

                                    <!-- Upload Payment Proof Button (if not paid yet) -->
                                    @if($peserta->status_pembayaran == 'BELUM_BAYAR')
                                        <button type="button" 
                                                onclick="openUploadModal({{ $peserta->id }})"
                                                class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors duration-200">
                                            <i class="fa-solid fa-upload mr-2"></i>
                                            Upload Bukti Bayar
                                        </button>

                                        <!-- Cancel Registration Button -->
                                        <button type="button" 
                                                onclick="confirmCancel({{ $peserta->id }})"
                                                class="inline-flex items-center px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors duration-200">
                                            <i class="fa-solid fa-times mr-2"></i>
                                            Batal Daftar
                                        </button>
                                    @endif

                                    <!-- View Payment Proof (if uploaded) -->
                                    @if($peserta->bukti_pembayaran)
                                        <a href="{{ asset('storage/' . $peserta->bukti_pembayaran) }}" 
                                           target="_blank"
                                           class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">
                                            <i class="fa-solid fa-image mr-2"></i>
                                            Lihat Bukti Bayar
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-16">
                <div class="bg-white rounded-2xl shadow-lg p-12 max-w-md mx-auto">
                    <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fa-solid fa-scissors text-3xl text-gray-400"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Belum Ada Kursus</h3>
                    <p class="text-gray-600 mb-8">Anda belum mendaftar kursus apapun. Mulai belajar menjahit dengan instruktur terbaik!</p>
                    <a href="{{ route('customer.kursus-menjahit.index') }}" 
                       class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-lg hover:from-indigo-700 hover:to-purple-700 transition-all duration-200 transform hover:scale-105">
                        <i class="fa-solid fa-plus mr-2"></i>
                        Daftar Kursus Sekarang
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>

<!-- Upload Payment Proof Modal -->
<div id="uploadModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full transform transition-all">
            <div class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-bold text-gray-800">Upload Bukti Pembayaran</h3>
                    <button type="button" 
                            onclick="closeUploadModal()"
                            class="text-gray-400 hover:text-gray-600 transition-colors">
                        <i class="fa-solid fa-times text-xl"></i>
                    </button>
                </div>
                
                <form id="uploadForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            File Bukti Pembayaran
                        </label>
                        <input type="file" 
                               name="bukti_pembayaran" 
                               id="fileInput"
                               accept="image/jpeg,image/png,image/jpg"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                               required>
                        <p class="text-xs text-gray-500 mt-1">
                            Format: JPEG, PNG, JPG. Maksimal 2MB.
                        </p>
                    </div>
                    
                    <div class="flex gap-3">
                        <button type="button" 
                                onclick="closeUploadModal()"
                                class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                            Batal
                        </button>
                        <button type="submit" 
                                class="flex-1 px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                            Upload
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Cancel Confirmation Modal -->
<div id="cancelModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full transform transition-all">
            <div class="p-6">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center mr-4">
                        <i class="fa-solid fa-exclamation-triangle text-red-600 text-xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800">Konfirmasi Pembatalan</h3>
                </div>
                
                <p class="text-gray-600 mb-6">
                    Apakah Anda yakin ingin membatalkan pendaftaran kursus ini? 
                    Tindakan ini tidak dapat dibatalkan.
                </p>
                
                <div class="flex gap-3">
                    <button type="button" 
                            onclick="closeCancelModal()"
                            class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                        Tidak
                    </button>
                    <form id="cancelForm" method="POST" class="flex-1">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="w-full px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                            Ya, Batalkan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function openUploadModal(pesertaId) {
        document.getElementById('uploadModal').classList.remove('hidden');
        document.getElementById('uploadForm').action = `/kursus-menjahit/upload-bukti-pembayaran/${pesertaId}`;
    }

    function closeUploadModal() {
        document.getElementById('uploadModal').classList.add('hidden');
        document.getElementById('fileInput').value = '';
    }

    function confirmCancel(pesertaId) {
        document.getElementById('cancelModal').classList.remove('hidden');
        document.getElementById('cancelForm').action = `/kursus-menjahit/batal-daftar/${pesertaId}`;
    }

    function closeCancelModal() {
        document.getElementById('cancelModal').classList.add('hidden');
    }

    // Close modals when clicking outside
    window.onclick = function(event) {
        const uploadModal = document.getElementById('uploadModal');
        const cancelModal = document.getElementById('cancelModal');
        
        if (event.target === uploadModal) {
            closeUploadModal();
        }
        if (event.target === cancelModal) {
            closeCancelModal();
        }
    }

    // Auto-hide alerts after 5 seconds
    setTimeout(function() {
        const successAlert = document.getElementById('alert-success');
        const errorAlert = document.getElementById('alert-error');
        
        if (successAlert) {
            successAlert.style.transition = 'opacity 0.5s ease-out';
            successAlert.style.opacity = '0';
            setTimeout(() => successAlert.remove(), 500);
        }
        
        if (errorAlert) {
            errorAlert.style.transition = 'opacity 0.5s ease-out';
            errorAlert.style.opacity = '0';
            setTimeout(() => errorAlert.remove(), 500);
        }
    }, 5000);
</script>

<style>
    .animate-slide-in {
        animation: slideIn 0.3s ease-out;
    }

    @keyframes slideIn {
        from {
            transform: translateY(-20px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }
</style>
@endsection