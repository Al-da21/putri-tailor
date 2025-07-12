@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<div class="px-4 md:px-8 lg:px-10 py-10 mx-auto w-full max-w-screen-xl">
    <h1 class="text-2xl font-bold mb-6">Checkout</h1>

    <div class="flex flex-col lg:flex-row gap-6">
        {{-- KONTEN KIRI --}}
        <div class="w-full lg:w-3/4 space-y-6">
            {{-- Jadwal Pengukuran --}}
            <div class="p-6 border rounded-md bg-white shadow-sm">
                <h2 class="font-semibold text-lg mb-4">Jadwal Pengukuran</h2>
                @if(isset($jadwalTerpilih) && !empty($jadwalTerpilih))
                    <div class="bg-green-50 border border-green-200 rounded-md p-4 flex justify-between items-start">
                        <div>
                            <p class="font-medium text-green-700">Jadwal Dipilih:</p>
                            <p>{{ $jadwalTerpilih['hari'] ?? '' }}, {{ $jadwalTerpilih['tanggal_format'] ?? '' }} - {{ $jadwalTerpilih['waktu_pengukuran'] ?? '' }} WIB</p>
                            @if(!empty($jadwalTerpilih['catatan']))
                                <p class="text-sm text-green-600 mt-1">Catatan: {{ $jadwalTerpilih['catatan'] }}</p>
                            @endif
                        </div>
                        <button onclick="hapusJadwal()" class="text-red-500 hover:text-red-700">
                            <i class="fa-solid fa-times"></i>
                        </button>
                    </div>
                @else
                    <div class="bg-yellow-50 border border-yellow-200 rounded-md p-4">
                        <p class="text-yellow-800 font-medium mb-2">Silakan pilih jadwal pengukuran:</p>
                        <form id="form-pilih-jadwal" class="space-y-4">
                            <div class="grid md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium mb-1">Pilih Tanggal</label>
                                    <input type="date" id="tanggal-pengukuran" name="tanggal_pengukuran" 
                                        class="w-full border-gray-300 rounded-md" 
                                        min="{{ \Carbon\Carbon::tomorrow()->format('Y-m-d') }}"
                                        max="{{ \Carbon\Carbon::tomorrow()->addDays(14)->format('Y-m-d') }}"
                                        required>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium mb-1">Pilih Jam</label>
                                    <input type="time" id="jam-pengukuran" name="waktu_pengukuran"
                                           class="w-full border-gray-300 rounded-md"
                                           min="08:00"
                                           max="17:00"
                                           required>
                                    <small class="text-xs text-gray-500 mt-1">Jam operasional: 08:00 - 17:00 WIB</small>
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium mb-1">Catatan (Opsional)</label>
                                <textarea name="catatan" rows="3" class="w-full border-gray-300 rounded-md" placeholder="Contoh: Saya lebih nyaman pagi hari..."></textarea>
                            </div>

                            <button type="submit" class="bg-indigo-500 hover:bg-indigo-600 text-white px-6 py-2 rounded-md">
                                <i class="fa-solid fa-calendar-check mr-2"></i>Pilih Jadwal
                            </button>
                        </form>
                    </div>
                @endif
            </div>

            {{-- Rincian Pesanan --}}
<div class="p-6 border rounded-md bg-white shadow-sm">
    <h2 class="font-semibold text-lg mb-4">Rincian Pesanan</h2>
    @if(isset($data['checkout_data']) && !empty($data['checkout_data']))
        <div class="space-y-4">
            @php $subtotal = 0; @endphp
            @foreach ($data['checkout_data'] as $item)
                <div class="flex items-center gap-4 border-b pb-4">
                    @if($item['is_custom'] && $item['custom_image'])
                        <img src="{{ Storage::url($item['custom_image']) }}" 
                             class="w-20 h-20 object-cover rounded-md"
                             alt="Gambar Custom">
                    @else
                        <img src="{{ Storage::url($item['product_image'] ?? '') }}" 
                             class="w-20 h-20 object-cover rounded-md"
                             alt="{{ $item['product_name'] ?? 'Product Image' }}">
                    @endif
                    
                    <div class="flex-1 space-y-1">
                        <div class="font-medium">
                            {{ $item['product_name'] ?? 'Nama Produk Tidak Tersedia' }}
                            @if($item['is_custom'])
                                <span class="text-xs bg-indigo-100 text-indigo-800 px-2 py-1 rounded ml-2">CUSTOM</span>
                            @endif
                        </div>

                        @if($item['is_custom'])
                            {{-- Hanya tampilkan data custom jika produk adalah custom --}}
                            @if($item['custom_material'])
                                <div class="text-sm text-slate-500">Bahan: {{ $item['custom_material'] }}</div>
                            @endif
                            
                            @if($item['custom_size'])
                                <div class="text-sm text-slate-500">Ukuran: {{ $item['custom_size'] }}</div>
                            @endif
                        @else
                            {{-- Tampilkan info produk standar jika bukan custom --}}
                            <div class="text-sm text-slate-500">Produk Standar</div>
                        @endif
                        <div class="text-sm text-slate-500">{{ $item['qty'] ?? 0 }} pcs</div>
                    </div>
                    <div class="text-right">
                        <div class="font-medium text-sm">Rp {{ number_format($item['product_price'] ?? 0, 0, ',', '.') }}</div>
                        <div class="text-sm text-slate-500">Subtotal: Rp {{ number_format($item['sub_total'] ?? 0, 0, ',', '.') }}</div>
                    </div>
                </div>
                @php $subtotal += $item['sub_total'] ?? 0; @endphp
            @endforeach
        </div>
    @else
        <div class="text-center py-8">
            <p class="text-gray-500">Tidak ada item untuk checkout</p>
            <a href="{{ url('/cart') }}" class="inline-block mt-4 bg-indigo-500 text-white px-4 py-2 rounded-md hover:bg-indigo-600">
                Kembali ke Keranjang
            </a>
        </div>
    @endif
</div>
        </div>

        {{-- SIDEBAR KANAN --}}
        <div class="w-full lg:w-1/4">
            <div class="p-6 border rounded-md bg-white shadow-md lg:sticky lg:top-24">
                <h2 class="font-semibold text-lg mb-4">Ringkasan Pembayaran</h2>
                @if(isset($data['checkout_data']) && !empty($data['checkout_data']))
                    @php 
                        $subtotal = 0;
                        foreach($data['checkout_data'] as $item) {
                            $subtotal += $item['sub_total'] ?? 0;
                        }
                    @endphp
                    <div class="flex justify-between mb-2">
                        <span>Subtotal</span>
                        <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                    </div>
                    <hr class="my-2 border-t">
                    <div class="flex justify-between font-bold text-indigo-700 text-lg">
                        <span>Total</span>
                        <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                    </div>

                    <form action="{{ url('/checkout') }}" method="POST" class="mt-6">
                        @csrf
                        <button type="submit"
                                class="w-full py-3 bg-indigo-500 text-white font-semibold rounded-md hover:bg-indigo-600 transition duration-300 {{ (!isset($jadwalTerpilih) || empty($jadwalTerpilih)) ? 'opacity-50 cursor-not-allowed' : '' }}"
                                {{ (!isset($jadwalTerpilih) || empty($jadwalTerpilih)) ? 'disabled' : '' }}>
                            Bayar Sekarang
                        </button>
                        @if(!isset($jadwalTerpilih) || empty($jadwalTerpilih))
                            <p class="text-xs text-center text-red-500 mt-2">Pilih jadwal pengukuran terlebih dahulu</p>
                        @endif
                    </form>
                @else
                    <div class="text-center text-gray-500">
                        <p>Tidak ada item untuk dibayar</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const formJadwal = document.getElementById('form-pilih-jadwal');

    if (formJadwal) {
        formJadwal.addEventListener('submit', function (e) {
            e.preventDefault();
            
            const tanggal = document.getElementById('tanggal-pengukuran').value;
            const waktu = document.getElementById('jam-pengukuran').value;
            
            if (!tanggal || !waktu) {
                alert('Harap lengkapi tanggal dan jam pengukuran');
                return;
            }
            if (waktu < '08:00' || waktu > '17:00') {
                alert('Waktu pengukuran harus antara jam 08:00 - 17:00 WIB');
                return;
            }

            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin mr-2"></i>Memproses...';

            const formData = new FormData(this);

            fetch('/checkout/pilih-jadwal', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Jadwal berhasil dipilih!');
                    location.reload();
                } else {
                    alert(data.message || 'Terjadi kesalahan saat memilih jadwal');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat memilih jadwal');
            })
            .finally(() => {
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalText;
            });
        });
    }
});

function hapusJadwal() {
    if (confirm('Hapus jadwal yang telah dipilih?')) {
        fetch('/checkout/hapus-jadwal', {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Jadwal berhasil dihapus!');
                location.reload();
            } else {
                alert(data.message || 'Terjadi kesalahan saat menghapus jadwal');
            }
        })
        .catch(error => {
            console.error('Delete error:', error);
            alert('Terjadi kesalahan saat menghapus jadwal');
        });
    }
}
</script>
@endsection
