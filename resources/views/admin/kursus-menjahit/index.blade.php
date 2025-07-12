@extends('layouts.app-admin')

@section('title', 'Kursus Menjahit')

@section('admin')
    <div class="mt-3">
        <div class="flex justify-between items-center mb-8">
            <div class="text-xl font-medium">Kursus Menjahit</div>
            <a href="{{ route('admin.kursus-menjahit.create') }}" class="px-4 py-2 bg-indigo-500 text-white rounded-md hover:bg-indigo-600">
                <i class="fa-solid fa-plus mr-2"></i>Tambah Kursus
            </a>
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
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l-4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
        @endif

        @if ($message = Session::get('error'))
            <div id="alert-error" class="flex p-4 mb-4 bg-red-100 rounded-lg" role="alert">
                <svg aria-hidden="true" class="flex-shrink-0 w-5 h-5 text-red-700" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                </svg>
                <div class="ml-3 text-base text-red-700">
                    {{ $message }}
                </div>
                <button type="button" class="ml-auto bg-red-100 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex h-8 w-8" data-dismiss-target="#alert-error" aria-label="Close">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
        @endif

        <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-white uppercase bg-indigo-500">
                    <tr class="divide-x divide-y">
                        <th scope="col" class="py-3 px-6">Nama Kursus</th>
                        <th scope="col" class="py-3 px-6">Instruktur</th>
                        <th scope="col" class="py-3 px-6">Periode</th>
                        <th scope="col" class="py-3 px-6">Jadwal</th>
                        <th scope="col" class="py-3 px-6">Harga</th>
                        <th scope="col" class="py-3 px-6">Peserta</th>
                        <th scope="col" class="py-3 px-6">Status</th>
                        <th scope="col" class="py-3 px-6">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y">
                    @forelse ($kursus as $item)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="py-3 px-6">
                                <div class="font-medium text-gray-900">{{ $item->nama_kursus }}</div>
                                <div class="text-sm text-gray-500">{{ Str::limit($item->deskripsi, 50) }}</div>
                            </td>
                            <td class="py-3 px-6">{{ $item->instruktur }}</td>
                            <td class="py-3 px-6">
                                <div class="text-sm">
                                    <div>{{ $item->tanggal_mulai->format('d M Y') }}</div>
                                    <div class="text-gray-500">s/d {{ $item->tanggal_selesai->format('d M Y') }}</div>
                                    <div class="text-xs text-gray-400">({{ $item->durasi_kursus }} hari)</div>
                                </div>
                            </td>
                            <td class="py-3 px-6">
                                <div class="text-sm">
                                    <div>{{ $item->jadwal_hari_string }}</div>
                                    <div class="text-gray-500">{{ $item->jam_mulai->format('H:i') }} - {{ $item->jam_selesai->format('H:i') }} WIB</div>
                                </div>
                            </td>
                            <td class="py-3 px-6">{{ $item->formatted_harga }}</td>
                            <td class="py-3 px-6">
                                <div class="text-sm">
                                    <div class="font-medium">{{ $item->pesertaKursus->count() }}/{{ $item->max_peserta }}</div>
                                    <div class="text-gray-500">{{ $item->sisaSlot() }} slot tersisa</div>
                                </div>
                            </td>
                            <td class="py-3 px-6">
                                <span class="px-2 py-1 text-xs font-medium rounded-full
                                    @if($item->status == 'BUKA') bg-green-100 text-green-800
                                    @elseif($item->status == 'TUTUP') bg-yellow-100 text-yellow-800
                                    @else bg-gray-100 text-gray-800
                                    @endif">
                                    {{ $item->status_readable }}
                                </span>
                            </td>
                            <td class="py-3 px-6">
                                <div class="flex items-center space-x-2">
                                    <a href="{{ route('admin.kursus-menjahit.show', $item->id) }}" class="py-2 px-3 rounded-md text-white bg-blue-500 hover:bg-blue-600" title="Detail Kursus">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.kursus-menjahit.peserta', $item->id) }}" class="py-2 px-3 rounded-md text-white bg-purple-500 hover:bg-purple-600" title="Lihat Peserta">
                                        <i class="fa-solid fa-users"></i>
                                    </a>
                                    <a href="{{ route('admin.kursus-menjahit.edit', $item->id) }}" class="py-2 px-3 rounded-md text-white bg-yellow-500 hover:bg-yellow-600" title="Edit Kursus">
                                        <i class="fa-solid fa-edit"></i>
                                    </a>
                                    @if($item->status != 'SELESAI')
                                        <form method="POST" action="{{ route('admin.kursus-menjahit.update-status', $item->id) }}" class="inline">
                                            @csrf
                                            <button type="submit" class="py-2 px-3 rounded-md text-white bg-green-500 hover:bg-green-600" title="Ubah Status" 
                                                onclick="return confirm('Yakin ingin mengubah status kursus ini?')">
                                                <i class="fa-solid fa-sync"></i>
                                            </button>
                                        </form>
                                    @endif
                                    @if($item->pesertaKursus->count() == 0)
                                        <form method="POST" action="{{ route('admin.kursus-menjahit.destroy', $item->id) }}" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="py-2 px-3 rounded-md text-white bg-red-500 hover:bg-red-600" title="Hapus Kursus"
                                                onclick="return confirm('Yakin ingin menghapus kursus ini?')">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="py-4 px-6 text-center">Tidak ada kursus ditemukan</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
