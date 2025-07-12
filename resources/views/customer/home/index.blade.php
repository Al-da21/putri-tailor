@extends('layouts.app')

@section('title', 'Beranda')

@section('navbar')
    @include('include.customer.navbar')
    <div class="mt-8 md:mt-[66px] lg:mt-16"></div>
@endsection

@section('content')
    <div class="px-4 sm:px-6 lg:px-10 xl:px-16 mx-auto w-full max-w-7xl">
        {{-- Produk --}}
        <section class="py-4">
            <div class="flex flex-col gap-3 sm:gap-0 sm:flex-row sm:justify-between sm:items-center mb-4">
                <div class="text-xl md:text-2xl font-bold text-slate-900">Produk</div>
                <div class="w-full max-w-sm lg:max-w-lg">
                    {{-- search --}}
                    <form action="{{ url('/search') }}" method="GET">
                        <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only">Search</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <input name="search" type="search" value="{{ Request::get('search') }}" id="default-search"
                                   class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-indigo-500 focus:border-indigo-500"
                                   placeholder="Cari produk impianmu..." required>
                            <button type="submit"
                                    class="text-white absolute right-2.5 bottom-2.5 bg-indigo-700 hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm px-4 py-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                                <span class="sr-only">Search</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Produk Grid --}}
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-5 md:gap-6 mb-10">
                @foreach ($products as $item)
                    <div class="bg-white rounded-lg border border-gray-200 shadow hover:shadow-md transition-shadow duration-300 overflow-hidden flex flex-col">
                        <div class="w-full aspect-[3/4] bg-gray-100">
                            <a href="{{ url('/product/' . $item->slug) }}">
                                @if ($item->image)
                                    <img src="{{ asset(Storage::url($item->image)) }}"
                                        class="object-cover w-full h-full"
                                        alt="Gambar Produk {{ $item->name }}">
                                @else
                                    <img src="{{ asset('assets/img/img-product.png') }}"
                                        class="object-cover w-full h-full" alt="...">
                                @endif
                            </a>
                        </div>
                        <div class="p-3 flex flex-col flex-grow justify-between">
                            <div>
                                <div class="text-sm font-medium text-slate-900 line-clamp-2">{{ $item->name }}</div>
                                <div class="text-sm font-bold text-indigo-600 mt-1">Rp{{ number_format($item->price, 0, ',', '.') }}</div>
                            </div>
                            <div class="mt-3 flex flex-col gap-2">
                                <a href="{{ url('/product/' . $item->slug) }}"
                                   class="text-center bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold px-3 py-2 rounded-md">
                                    Pesan Sekarang
                                </a>
                                <a href="{{ url('/product/custom/' . $item->slug) }}"
                                   class="text-center bg-gray-600 hover:bg-gray-700 text-white text-sm font-semibold px-3 py-2 rounded-md">
                                    Custom Bahan
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="flex justify-center">
                {{ $products->links() }}
            </div>
        </section>
    </div>

    {{-- Footer --}}
    @include('include.customer.footer')
@endsection

@section('backTop')
    <!-- Back to Top -->
    <a id="back-to-top" onclick="toTop()"
       class="fixed z-[9999] bottom-6 right-6 cursor-pointer hidden items-center justify-center w-14 h-14 bg-indigo-500 text-white text-xl rounded-full p-4">
        <i class="fa-solid fa-chevron-up"></i>
    </a>
@endsection
