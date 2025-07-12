@extends('layouts.app-admin')

@section('title', 'Peserta Kursus')

@section('admin')
    <div class="mt-3">
        <div class="flex justify-between items-center mb-8">
            <div>
                <div class="text-xl font-medium">Peserta Kursus: {{ $kursus->nama_kursus }}</div>
                <div class="text-sm text-gray-600 mt-1">
                    Instruktur: {{ $kursus->instruktur }} | 
                    Periode: {{ $kursus->tanggal_mulai->format('d M Y') }} - {{ $kursus->tanggal_selesai->format('d M Y') }}
                </div>
            </div>
            <a href="{{ route('admin.kursus-menjahit.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">
                <i class="fa-solid fa-arrow-left mr-2"></i>Kembali
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
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
        @endif

        <!-- Info Kursus -->
        <div class="bg-white shadow-md rounded-lg p-6 mb-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 text-center">
                <div class="bg-blue-50 p-4 rounded-lg">
                    <div class="text-2xl font-bold text-blue-600">{{ $kursus->pesertaKursus->count() }}</div>
                    <div class="text-sm text-gray-600">Total Peserta</div>
                </div>
                <div class="bg-green-50 p-4 rounded-lg">
                    <div class="text-2xl font-bold text-green-600">{{ $kursus->sisaSlot() }}</div>
                    <div class="text-sm text-gray-600">Sisa Slot</div>
                </div>
                <div class="bg-purple-50 p-4 rounded-lg">
                    <div class="text-2xl font-bold text-purple-600">{{ $kursus->pesertaKursus->where('status_pembayaran', 'SUDAH_BAYAR')->count() }}</div>
                    <div class="text-sm text-gray-600">Sudah Bayar</div>
                </div>
                <div class="bg-orange-50 p-4 rounded-lg">
                    <div class="text-2xl font-bold text-orange-600">{{ $kursus->pesertaKursus->where('status_pembayaran', 'BELUM_BAYAR')->count() }}</div>
                    <div class="text-sm text-gray-600">Belum Bayar</div>
                </div>
            </div>
        </div>

        <!-- Tabel Peserta -->
        <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-white uppercase bg-indigo-500">
                    <tr class="divide-x divide-y">
                        <th scope="col" class="py-3 px-6">Tanggal Daftar</th>
                        <th scope="col" class="py-3 px-6">Nama Peserta</th>
                        <th scope="col" class="py-3 px-6">Email</th>
                        <th scope="col" class="py-3 px-6">Status Pembayaran</th>
                        <th scope="col" class="py-3 px-6">Status Kehadiran</th>
                        <th scope="col" class="py-3 px-6">Catatan</th>
                        <th scope="col" class="py-3 px-6">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y">
                    @forelse ($kursus->pesertaKursus as $peserta)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="py-3 px-6">
                                {{ $peserta->tanggal_daftar->format('d M Y - H:i') }} WIB
                            </td>
                            <td class="py-3 px-6">
                                <div class="font-medium text-gray-900">{{ $peserta->user->name }}</div>
                            </td>
                            <td class="py-3 px-6">{{ $peserta->user->email }}</td>
                            <td class="py-3 px-6">
                                <span class="px-2 py-1 text-xs font-medium rounded-full
                                    @if($peserta->status_pembayaran == 'SUDAH_BAYAR') bg-green-100 text-green-800
                                    @else bg-red-100 text-red-800
                                    @endif">
                                    {{ $peserta->status_pembayaran_readable }}
                                </span>
                            </td>
                            <td class="py-3 px-6">
                                <span class="px-2 py-1 text-xs font-medium rounded-full
                                    @if($peserta->status_kehadiran == 'AKTIF') bg-blue-100 text-blue-800
                                    @elseif($peserta->status_kehadiran == 'SELESAI') bg-green-100 text-green-800
                                    @else bg-gray-100 text-gray-800
                                    @endif">
                                    {{ $peserta->status_kehadiran_readable }}
                                </span>
                            </td>
                            <td class="py-3 px-6">
                                {{ $peserta->catatan ?? '-' }}
                            </td>
                            <td class="py-3 px-6">
                                <div class="flex items-center space-x-2">
                                    @if($peserta->status_pembayaran == 'BELUM_BAYAR')
                                        <form method="POST" action="{{ route('admin.kursus-menjahit.konfirmasi-pembayaran', $peserta->id) }}" class="inline">
                                            @csrf
                                            <button type="submit" class="py-2 px-3 rounded-md text-white bg-green-500 hover:bg-green-600" title="Konfirmasi Pembayaran"
                                                onclick="return confirm('Konfirmasi pembayaran peserta ini?')">
                                                <i class="fa-solid fa-check"></i>
                                            </button>
                                        </form>
                                    @endif
                                    @if($peserta->bukti_pembayaran)
                                        <a href="{{ asset('storage/' . $peserta->bukti_pembayaran) }}" target="_blank" class="py-2 px-3 rounded-md text-white bg-blue-500 hover:bg-blue-600" title="Lihat Bukti Pembayaran">
                                            <i class="fa-solid fa-image"></i>
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-8 px-6 text-center">
                                <div class="text-gray-400">
                                    <i class="fa-solid fa-users text-4xl mb-4"></i>
                                    <div class="text-lg">Belum ada peserta yang mendaftar</div>
                                    <div class="text-sm">Peserta akan muncul di sini setelah mendaftar kursus</div>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($kursus->pesertaKursus->count() > 0)
            <!-- Summary -->
            <div class="mt-6 bg-white shadow-md rounded-lg p-6">
                <h3 class="text-lg font-medium mb-4">Ringkasan Kursus</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h4 class="font-medium text-gray-900 mb-2">Informasi Kursus</h4>
                        <ul class="space-y-1 text-sm text-gray-600">
                            <li><strong>Nama:</strong> {{ $kursus->nama_kursus }}</li>
                            <li><strong>Instruktur:</strong> {{ $kursus->instruktur }}</li>
                            <li><strong>Harga:</strong> {{ $kursus->formatted_harga }}</li>
                            <li><strong>Durasi:</strong> {{ $kursus->durasi_kursus }} hari</li>
                            <li><strong>Jadwal:</strong> {{ $kursus->jadwal_hari_string }}</li>
                            <li><strong>Jam:</strong> {{ $kursus->jam_mulai->format('H:i') }} - {{ $kursus->jam_selesai->format('H:i') }} WIB</li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="font-medium text-gray-900 mb-2">Materi Kursus</h4>
                        <ul class="space-y-1 text-sm text-gray-600">
                            @foreach($kursus->materi_kursus as $index => $materi)
                                <li>{{ $index + 1 }}. {{ $materi }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif
    </div
@endsection