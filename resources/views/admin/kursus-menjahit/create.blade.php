@extends('layouts.app-admin')

@section('title', 'Tambah Kursus Menjahit')

@section('admin')
    <div class="mt-3">
        <div class="flex justify-between items-center mb-8">
            <div class="text-xl font-medium">Tambah Kursus Menjahit</div>
            <a href="{{ url('admin/kursus-menjahit') }}" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">
                <i class="fa-solid fa-arrow-left mr-2"></i>Kembali
            </a>
        </div>

        <div class="bg-white shadow-md rounded-lg p-6">
            <form method="POST" action="{{ url('admin/kursus-menjahit') }}">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nama Kursus -->
                    <div class="md:col-span-2">
                        <label for="nama_kursus" class="block text-sm font-medium text-gray-700 mb-2">Nama Kursus</label>
                        <input type="text" name="nama_kursus" id="nama_kursus" value="{{ old('nama_kursus') }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('nama_kursus') border-red-500 @enderror" 
                               placeholder="Masukkan nama kursus" required>
                        @error('nama_kursus')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Deskripsi -->
                    <div class="md:col-span-2">
                        <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" rows="4" 
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('deskripsi') border-red-500 @enderror" 
                                  placeholder="Masukkan deskripsi kursus" required>{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Instruktur -->
                    <div>
                        <label for="instruktur" class="block text-sm font-medium text-gray-700 mb-2">Instruktur</label>
                        <input type="text" name="instruktur" id="instruktur" value="{{ old('instruktur') }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('instruktur') border-red-500 @enderror" 
                               placeholder="Nama instruktur" required>
                        @error('instruktur')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Harga -->
                    <div>
                        <label for="harga" class="block text-sm font-medium text-gray-700 mb-2">Harga (Rp)</label>
                        <input type="number" name="harga" id="harga" value="{{ old('harga') }}" min="0" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('harga') border-red-500 @enderror" 
                               placeholder="0" required>
                        @error('harga')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Durasi Kursus -->
                    <div>
                        <label for="durasi_kursus" class="block text-sm font-medium text-gray-700 mb-2">Durasi Kursus (Hari)</label>
                        <input type="number" name="durasi_kursus" id="durasi_kursus" value="{{ old('durasi_kursus') }}" min="1" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('durasi_kursus') border-red-500 @enderror" 
                               placeholder="30" required>
                        @error('durasi_kursus')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Max Peserta -->
                    <div>
                        <label for="max_peserta" class="block text-sm font-medium text-gray-700 mb-2">Maksimal Peserta</label>
                        <input type="number" name="max_peserta" id="max_peserta" value="{{ old('max_peserta') }}" min="1" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('max_peserta') border-red-500 @enderror" 
                               placeholder="10" required>
                        @error('max_peserta')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tanggal Mulai -->
                    <div>
                        <label for="tanggal_mulai" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Mulai</label>
                        <input type="date" name="tanggal_mulai" id="tanggal_mulai" value="{{ old('tanggal_mulai') }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('tanggal_mulai') border-red-500 @enderror" 
                               required>
                        @error('tanggal_mulai')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tanggal Selesai -->
                    <div>
                        <label for="tanggal_selesai" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Selesai</label>
                        <input type="date" name="tanggal_selesai" id="tanggal_selesai" value="{{ old('tanggal_selesai') }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('tanggal_selesai') border-red-500 @enderror" 
                               required>
                        @error('tanggal_selesai')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Jam Mulai -->
                    <div>
                        <label for="jam_mulai" class="block text-sm font-medium text-gray-700 mb-2">Jam Mulai</label>
                        <input type="time" name="jam_mulai" id="jam_mulai" value="{{ old('jam_mulai') }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('jam_mulai') border-red-500 @enderror" 
                               required>
                        @error('jam_mulai')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Jam Selesai -->
                    <div>
                        <label for="jam_selesai" class="block text-sm font-medium text-gray-700 mb-2">Jam Selesai</label>
                        <input type="time" name="jam_selesai" id="jam_selesai" value="{{ old('jam_selesai') }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('jam_selesai') border-red-500 @enderror" 
                               required>
                        @error('jam_selesai')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Jadwal Hari -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Jadwal Hari</label>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-2">
                            @foreach($hariOptions as $hari)
                                <label class="flex items-center">
                                    <input type="checkbox" name="jadwal_hari[]" value="{{ $hari }}" 
                                           class="mr-2 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded"
                                           {{ in_array($hari, old('jadwal_hari', [])) ? 'checked' : '' }}>
                                    <span class="text-sm">{{ $hari }}</span>
                                </label>
                            @endforeach
                        </div>
                        @error('jadwal_hari')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Materi Kursus -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Materi Kursus</label>
                        <div id="materi-container">
                            @if(old('materi_kursus'))
                                @foreach(old('materi_kursus') as $index => $materi)
                                    <div class="flex items-center mb-2 materi-item">
                                        <input type="text" name="materi_kursus[]" value="{{ $materi }}" 
                                               class="flex-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" 
                                               placeholder="Masukkan materi kursus">
                                        <button type="button" class="ml-2 px-3 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 remove-materi">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </div>
                                @endforeach
                            @else
                                <div class="flex items-center mb-2 materi-item">
                                    <input type="text" name="materi_kursus[]" 
                                           class="flex-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" 
                                           placeholder="Masukkan materi kursus">
                                    <button type="button" class="ml-2 px-3 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 remove-materi">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </div>
                            @endif
                        </div>
                        <button type="button" id="add-materi" class="mt-2 px-3 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                            <i class="fa-solid fa-plus mr-1"></i>Tambah Materi
                        </button>
                        @error('materi_kursus')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex justify-end space-x-4 mt-8">
                    <a href="{{ url('admin/kursus-menjahit') }}" class="px-6 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">
                        Batal
                    </a>
                    <button type="submit" class="px-6 py-2 bg-indigo-500 text-white rounded-md hover:bg-indigo-600">
                        Simpan Kursus
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Script untuk menambah dan menghapus materi
        document.getElementById('add-materi').addEventListener('click', function() {
            const container = document.getElementById('materi-container');
            const div = document.createElement('div');
            div.className = 'flex items-center mb-2 materi-item';
            div.innerHTML = `
                <input type="text" name="materi_kursus[]" 
                       class="flex-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" 
                       placeholder="Masukkan materi kursus">
                <button type="button" class="ml-2 px-3 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 remove-materi">
                    <i class="fa-solid fa-trash"></i>
                </button>
            `;
            container.appendChild(div);
        });

        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-materi') || e.target.closest('.remove-materi')) {
                const materiItem = e.target.closest('.materi-item');
                const container = document.getElementById('materi-container');
                if (container.children.length > 1) {
                    materiItem.remove();
                }
            }
        });
    </script>
@endsection