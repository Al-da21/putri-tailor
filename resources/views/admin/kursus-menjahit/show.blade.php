@extends('layouts.app-admin')

@section('title', 'Detail Kursus Menjahit')

@section('admin')
    <div class="mt-3">
        <div class="flex justify-between items-center mb-8">
            <div class="text-xl font-medium">Detail Kursus Menjahit</div>
            <div class="flex space-x-2">
                <a href="{{ route('admin.kursus-menjahit.peserta', $kursus->id) }}" class="px-4 py-2 bg-purple-500 text-white rounded-md hover:bg-purple-600">
                    <i class="fa-solid fa-users mr-2"></i>Lihat Peserta
                </a>
                <a href="{{ route('admin.kursus-menjahit.edit', $kursus->id) }}" class="px-4 py-2 bg-yellow-500 text-white rounded-md hover:bg-yellow-600">
                    <i class="fa-solid fa-edit mr-2"></i>Edit Kursus
                </a>
                <a href="{{ route('admin.kursus-menjahit.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">
                    <i class="fa-solid fa-arrow-left mr-2"></i>Kembali
                </a>
            </div>
        </div>

        @if ($message = Session::get('success'))
            <div id="alert-success" class="flex p-4 mb-4 bg-green-100 rounded-lg" role="alert">
                <svg aria-hidden="true" class="flex-shrink-0 w-5 h-5 text-green-700" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                </svg>
                <div class="ml-3 text-base text-green-700">
                    {{ $message }}
                </div>
                <button type="button" class="ml-auto bg-green-100 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex h-8 w-8" data-dismiss-target="#alert-success" aria-label="Close">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
        @endif

        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <!-- Header Kursus -->
            <div class="bg-indigo-500 text-white p-6">
                <div class="flex justify-between items-start">
                    <div>
                        <h1 class="text-2xl font-bold mb-2">{{ $kursus->nama_kursus }}</h1>
                        <p class="text-indigo-100">Instruktur: {{ $kursus->instruktur }}</p>
                    </div>
                    <div class="text-right">
                        <span class="px-3 py-1 text-sm font-medium rounded-full
                            @if($kursus->status == 'BUKA') bg-green-500 text-white
                            @elseif($kursus->status == 'TUTUP') bg-yellow-500 text-white
                            @else bg-gray-500 text-white
                            @endif">
                            {{ $kursus->status_readable }}
                        </span>
                        <div class="mt-2 text-right">
                            <div class="text-2xl font-bold">{{ $kursus->formatted_harga }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="p-6">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Informasi Kursus -->
                    <div class="space-y-6">
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="text-lg font-semibold mb-3 text-gray-800">
                                <i class="fa-solid fa-info-circle mr-2 text-indigo-500"></i>Informasi Kursus
                            </h3>
                            <div class="space-y-3">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Nama Kursus:</span>
                                    <span class="font-medium">{{ $kursus->nama_kursus }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Instruktur:</span>
                                    <span class="font-medium">{{ $kursus->instruktur }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Harga:</span>
                                    <span class="font-medium text-green-600">{{ $kursus->formatted_harga }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Status:</span>
                                    <span class="px-2 py-1 text-xs font-medium rounded-full
                                        @if($kursus->status == 'BUKA') bg-green-100 text-green-800
                                        @elseif($kursus->status == 'TUTUP') bg-yellow-100 text-yellow-800
                                        @else bg-gray-100 text-gray-800
                                        @endif">
                                        {{ $kursus->status_readable }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Deskripsi -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="text-lg font-semibold mb-3 text-gray-800">
                                <i class="fa-solid fa-file-text mr-2 text-indigo-500"></i>Deskripsi
                            </h3>
                            <p class="text-gray-700 leading-relaxed">{{ $kursus->deskripsi ?? 'Tidak ada deskripsi tersedia.' }}</p>
                        </div>
                    </div>

                    <!-- Jadwal & Peserta -->
                    <div class="space-y-6">
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="text-lg font-semibold mb-3 text-gray-800">
                                <i class="fa-solid fa-calendar mr-2 text-indigo-500"></i>Jadwal & Periode
                            </h3>
                            <div class="space-y-3">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Tanggal Mulai:</span>
                                    <span class="font-medium">{{ $kursus->tanggal_mulai->format('d M Y') }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Tanggal Selesai:</span>
                                    <span class="font-medium">{{ $kursus->tanggal_selesai->format('d M Y') }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Durasi:</span>
                                    <span class="font-medium">{{ $kursus->durasi_kursus }} hari</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Hari:</span>
                                    <span class="font-medium">{{ $kursus->jadwal_hari_string }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Jam:</span>
                                    <span class="font-medium">{{ $kursus->jam_mulai->format('H:i') }} - {{ $kursus->jam_selesai->format('H:i') }} WIB</span>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="text-lg font-semibold mb-3 text-gray-800">
                                <i class="fa-solid fa-users mr-2 text-indigo-500"></i>Informasi Peserta
                            </h3>
                            <div class="space-y-3">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Maksimal Peserta:</span>
                                    <span class="font-medium">{{ $kursus->max_peserta }} orang</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Peserta Terdaftar:</span>
                                    <span class="font-medium text-blue-600">{{ $kursus->pesertaKursus->count() }} orang</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Sisa Slot:</span>
                                    <span class="font-medium {{ $kursus->sisaSlot() > 0 ? 'text-green-600' : 'text-red-600' }}">
                                        {{ $kursus->sisaSlot() }} slot
                                    </span>
                                </div>
                            </div>
                            
                            <!-- Progress Bar -->
                            <div class="mt-4">
                                <div class="flex justify-between text-sm text-gray-600 mb-1">
                                    <span>Kapasitas Terisi</span>
                                    <span>{{ round(($kursus->pesertaKursus->count() / $kursus->max_peserta) * 100) }}%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-indigo-500 h-2 rounded-full" style="width: {{ ($kursus->pesertaKursus->count() / $kursus->max_peserta) * 100 }}%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="mt-8 pt-6 border-t border-gray-200">
                    <div class="flex flex-wrap gap-3">
                        <a href="{{ route('admin.kursus-menjahit.peserta', $kursus->id) }}" class="px-4 py-2 bg-purple-500 text-white rounded-md hover:bg-purple-600 transition-colors">
                            <i class="fa-solid fa-users mr-2"></i>Kelola Peserta
                        </a>
                        <a href="{{ route('admin.kursus-menjahit.edit', $kursus->id) }}" class="px-4 py-2 bg-yellow-500 text-white rounded-md hover:bg-yellow-600 transition-colors">
                            <i class="fa-solid fa-edit mr-2"></i>Edit Kursus
                        </a>
                        @if($kursus->status != 'SELESAI')
                            <form method="POST" action="{{ route('admin.kursus-menjahit.update-status', $kursus->id) }}" class="inline">
                                @csrf
                                <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600 transition-colors" 
                                    onclick="return confirm('Yakin ingin mengubah status kursus ini?')">
                                    <i class="fa-solid fa-sync mr-2"></i>Ubah Status
                                </button>
                            </form>
                        @endif
                        @if($kursus->pesertaKursus->count() == 0)
                            <form method="POST" action="{{ route('admin.kursus-menjahit.destroy', $kursus->id) }}" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 transition-colors"
                                    onclick="return confirm('Yakin ingin menghapus kursus ini? Tindakan ini tidak dapat dibatalkan.')">
                                    <i class="fa-solid fa-trash mr-2"></i>Hapus Kursus
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection