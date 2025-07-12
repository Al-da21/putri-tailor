<aside id="sidebarAdmin" class="fixed top-0 left-0 z-40 w-64 h-screen pt-4 transition-transform -translate-x-full bg-white shadow-lg lg:translate-x-0" aria-label="Sidebar">
    <div class="h-full px-3 py-4 overflow-y-auto bg-white">
        <ul class="mt-5 space-y-2 font-medium">
            @php
    $userName = strtolower(trim(Auth::user()->name));
@endphp

@if ($userName === 'admin')
    {{-- Semua menu untuk admin --}}
    <li class="{{ request()->is('admin/dashboard') ? 'bg-indigo-100 rounded-lg' : '' }}">
        <a href="{{ url('admin/dashboard') }}" class="flex items-center p-3 rounded-lg text-slate-800 hover:bg-indigo-100">
            <svg class="w-6 h-6 text-indigo-400" fill="currentColor" viewBox="0 0 20 20">
                <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
                <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path>
            </svg>
            <span class="ml-3">Dashboard</span>
        </a>
    </li>
    <li class="{{ request()->is('admin/product') ? 'bg-indigo-100 rounded-lg' : '' }}">
        <a href="{{ url('admin/product') }}" class="flex items-center p-3 text-slate-800 rounded-lg hover:bg-indigo-100">
            <i class="fa-solid fa-fw fa-boxes-stacked text-indigo-400"></i>
            <span class="flex-1 ml-3 whitespace-nowrap">Data Barang</span>
        </a>
    </li>
    <li class="{{ request()->is('admin/transaction*') ? 'bg-indigo-100 rounded-lg' : '' }}">
        <a href="{{ url('admin/transaction') }}" class="flex items-center p-3 text-slate-800 rounded-lg hover:bg-indigo-100">
            <i class="fa-solid fa-fw fa-shopping-cart text-indigo-400"></i>
            <span class="flex-1 ml-3 whitespace-nowrap">Kelola Pesanan</span>
        </a>
    </li>
    <li class="{{ request()->is('admin/payment*') ? 'bg-indigo-100 rounded-lg' : '' }}">
        <a href="{{ url('admin/payment') }}" class="flex items-center p-3 text-slate-800 rounded-lg hover:bg-indigo-100">
            <i class="fa-solid fa-fw fa-credit-card text-indigo-400"></i>
            <span class="flex-1 ml-3 whitespace-nowrap">Kelola Pembayaran</span>
        </a>
    </li>
    <li class="{{ request()->is('admin/kursus-menjahit*') ? 'bg-indigo-100 rounded-lg' : '' }}">
        <a href="{{ url('admin/kursus-menjahit') }}" class="flex items-center p-3 text-slate-800 rounded-lg hover:bg-indigo-100">
            <i class="fa-solid fa-fw fa-graduation-cap text-indigo-400"></i>
            <span class="flex-1 ml-3 whitespace-nowrap">Kursus Menjahit</span>
        </a>
    </li>
    <li class="{{ request()->is('laporan*') ? 'bg-indigo-100 rounded-lg' : '' }}">
        <a href="{{ url('laporan') }}" class="flex items-center p-3 text-slate-800 rounded-lg hover:bg-indigo-100">
            <i class="fa-solid fa-fw fa-file-pdf text-indigo-400"></i>
            <span class="flex-1 ml-3 whitespace-nowrap">Laporan</span>
        </a>
    </li>
    <li class="{{ request()->is('employee*') ? 'bg-indigo-100 rounded-lg' : '' }}">
        <a href="{{ url('employee') }}" class="flex items-center p-3 text-slate-800 rounded-lg hover:bg-indigo-100">
            <i class="fa-solid fa-fw fa-user text-indigo-400"></i>
            <span class="flex-1 ml-3 whitespace-nowrap">Data Karyawan</span>
        </a>
    </li>
@elseif ($userName === 'karyawan')
    {{-- Hanya menu pesanan dan pembayaran untuk karyawan --}}
    <li class="{{ request()->is('admin/transaction*') ? 'bg-indigo-100 rounded-lg' : '' }}">
        <a href="{{ url('admin/transaction') }}" class="flex items-center p-3 text-slate-800 rounded-lg hover:bg-indigo-100">
            <i class="fa-solid fa-fw fa-shopping-cart text-indigo-400"></i>
            <span class="flex-1 ml-3 whitespace-nowrap">Kelola Pesanan</span>
        </a>
    </li>
    <li class="{{ request()->is('admin/payment*') ? 'bg-indigo-100 rounded-lg' : '' }}">
        <a href="{{ url('admin/payment') }}" class="flex items-center p-3 text-slate-800 rounded-lg hover:bg-indigo-100">
            <i class="fa-solid fa-fw fa-credit-card text-indigo-400"></i>
            <span class="flex-1 ml-3 whitespace-nowrap">Kelola Pembayaran</span>
        </a>
    </li>
@endif

    </div>
</aside>