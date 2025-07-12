@extends('layouts.app-admin')

@section('title', 'Dashboard')

@section('admin')
<div class="lg:ml-3 mt-3">
    {{-- Statistik Bulanan --}}
    <div class="flex flex-wrap gap-3">
        <div class="w-full md:max-w-xs p-6 flex items-center justify-between bg-blue-100 border-b-8 border-blue-400 rounded-lg shadow-md">
            <div class="w-20 h-20 rounded-full bg-blue-400 text-white flex items-center justify-center">
                <i class="fa-solid fa-file-invoice text-4xl"></i>
            </div>
            <div class="space-y-2 w-full max-w-[180px]">
                <h5 class="text-center text-sm uppercase font-bold text-slate-600">Monthly Transactions Total</h5>
                <p class="text-center font-bold text-3xl text-slate-950">{{ $transactions }}</p>
            </div>
        </div>
        <div class="w-full md:max-w-xs p-6 flex items-center justify-between bg-orange-100 border-b-8 border-orange-400 rounded-lg shadow-md">
            <div class="w-20 h-20 rounded-full bg-orange-400 text-white flex items-center justify-center">
                <i class="fa-solid fa-tags text-4xl"></i>
            </div>
            <div class="space-y-2 w-full max-w-[180px]">
                <h5 class="text-center text-sm uppercase font-bold text-slate-600">Monthly Sales Total</h5>
                <p class="text-center font-bold text-3xl text-slate-950">Rp. {{ number_format($sales, 0, ',', '.') }}</p>
            </div>
        </div>
        <div class="w-full md:max-w-xs p-6 flex items-center justify-between bg-emerald-100 border-b-8 border-emerald-400 rounded-lg shadow-md">
            <div class="w-20 h-20 rounded-full bg-emerald-500 text-white flex items-center justify-center">
                <i class="fa-solid fa-money-bill-trend-up text-4xl"></i>
            </div>
            <div class="space-y-2 w-full max-w-[180px]">
                <h5 class="text-center text-sm uppercase font-bold text-slate-600">Monthly Profit Total</h5>
                <p class="text-center font-bold text-3xl text-slate-950">Rp. {{ number_format($profits, 0, ',', '.') }}</p>
            </div>
        </div>
    </div>

    {{-- Grafik --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-5">
        {{-- Penjualan Harian --}}
        <div class="bg-white rounded-lg shadow-md p-4">
            <h3 class="font-semibold text-md text-slate-700 mb-2">Penjualan Harian</h3>
            <canvas id="penjualanHarianChart" class="w-full h-64"></canvas>
        </div>

        {{-- Produk Terlaris --}}
        <div class="bg-white rounded-lg shadow-md p-4">
            <h3 class="font-semibold text-md text-slate-700 mb-2">Penjualan Produk Terbanyak</h3>
            <canvas id="produkTerlarisChart" class="w-full h-64"></canvas>
        </div>
    </div>
</div>
@endsection

@push('addon-script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Chart: Penjualan Harian (Contoh Dummy)
    const ctxHarian = document.getElementById('penjualanHarianChart').getContext('2d');
    const penjualanHarianChart = new Chart(ctxHarian, {
        type: 'bar',
        data: {
            labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
            datasets: [
                {
                    label: 'Jahitan A',
                    data: [12, 19, 3, 5, 2, 3, 9],
                    backgroundColor: '#3B82F6'
                },
                {
                    label: 'Jahitan B',
                    data: [9, 14, 6, 3, 7, 8, 4],
                    backgroundColor: '#EF4444'
                },
                {
                    label: 'Jahitan C',
                    data: [5, 11, 9, 6, 4, 10, 12],
                    backgroundColor: '#10B981'
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top'
                }
            }
        }
    });

    // Chart: Produk Terlaris
    const ctxProduk = document.getElementById('produkTerlarisChart').getContext('2d');
    const produkTerlarisChart = new Chart(ctxProduk, {
        type: 'bar',
        data: {
            labels: ['Jahitan A', 'Jahitan B', 'Jahitan C', 'Jahitan D', 'Jahitan E'],
            datasets: [{
                label: 'Jumlah Terjual',
                data: [150, 120, 200, 90, 170],
                backgroundColor: '#60A5FA'
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // DataTable
    var datatable = $('#crudTable').DataTable({
        processing: true,
        serverSide: true,
        ordering: true,
        ajax: {
            url: 'https://' + '{!! request()->getHttpHost().request()->getRequestUri() !!}',
        },
        columns: [
            {
                data: 'id',
                name: 'id',
                className: 'py-3 px-6 text-center whitespace-nowrap',
                width: '5%',
                render: function(data) {
                    return data.substr(data.length - 8);
                }
            },
            {
                data: 'created_at',
                name: 'created_at',
                className: 'py-4 px-6 whitespace-nowrap',
                width: '10%',
                render: function(data) {
                    const date = new Date(data);
                    const formattedDate = date.toLocaleDateString('id-ID', {
                        day: 'numeric',
                        month: 'long',
                        year: 'numeric',
                        hour: 'numeric',
                        minute: 'numeric',
                    });
                    return formattedDate.replace('pukul', '-');
                }
            },
            {
                data: 'user.name',
                name: 'user.name',
                className: 'py-3 px-6',
                width: '20%'
            },
            {
                data: 'total',
                name: 'total',
                className: 'py-3 px-6',
                width: '15%',
                render: function(data) {
                    return 'Rp ' + new Intl.NumberFormat('id-ID').format(data);
                }
            },
            {
                data: 'payment_status',
                name: 'payment_status',
                className: 'py-3 px-6 text-center',
                width: '20%'
            },
            {
                data: 'order_status',
                name: 'order_status',
                className: 'py-3 px-6',
                width: '20%'
            },
            {
                data: 'action',
                name: 'action',
                className: 'py-3 px-6',
                orderable: false,
                searchable: false,
                width: '15%'
            },
        ]
    });

    $('table').on('draw.dt', function () {
        $('[data-bs-toggle="tooltip-detail"]').tooltip();
    });
</script>
@endpush
