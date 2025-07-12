@extends('layouts.app-auth')
@section('title', 'Login')

@section('content')
<div class="flex justify-center items-center h-screen w-screen bg-indigo-100 px-4 sm:px-0">
    <div class="w-full max-w-md p-8 shadow-lg bg-white rounded-md">
        {{-- Tabs --}}
        <div class="flex border-b border-gray-300 mb-6">
            <a href="{{ route('register') }}" class="w-1/2 text-center py-2 font-semibold {{ request()->is('register') ? 'bg-black text-white' : 'bg-white text-black' }}">
                Pelanggan baru
            </a>
            <a href="{{ route('login') }}" class="w-1/2 text-center py-2 font-semibold {{ request()->is('login') ? 'bg-black text-white' : 'bg-white text-black' }}">
                Pelanggan lama
            </a>
        </div>

        <h1 class="text-xl text-center font-semibold mb-4">Login akun</h1>

        {{-- Tombol Google (tampilan saja) --}}
        <div class="flex justify-center mb-4">
            <a href="{{ route('login.google') }}" class="flex items-center gap-2 px-4 py-2 border border-gray-300 rounded hover:bg-gray-100 transition justify-center">
                <img src="https://www.google.com/favicon.ico" alt="G" class="w-4 h-4">
                <span class="text-sm">Lanjutkan dengan Google</span>
            </a>
        </div>
        <p class="text-xs text-center text-gray-500 mb-6">Kami tidak akan posting atas nama Anda atau membagikan informasi tanpa persetujuan Anda.</p>

        <div class="flex items-center mb-4">
            <div class="flex-grow h-px bg-gray-300"></div>
            <span class="text-sm text-gray-500 mx-2">atau</span>
            <div class="flex-grow h-px bg-gray-300"></div>
        </div>

        {{-- Error handling --}}
        @if ($errors->any())
            <div class="mb-4 text-sm text-red-600">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Form login --}}
        <form action="{{ route('do.login') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <input type="email" id="email" name="email"
                    class="w-full border border-gray-300 px-4 py-2 rounded focus:ring-2 focus:ring-indigo-500"
                    placeholder="Alamat Email" value="{{ old('email') }}" required>
            </div>

            <div>
                <input type="password" id="password" name="password"
                    class="w-full border border-gray-300 px-4 py-2 rounded focus:ring-2 focus:ring-indigo-500"
                    placeholder="Password" required>
            </div>

            <div class="flex items-center">
                <input id="remember" type="checkbox" name="remember" class="mr-2">
                <label for="remember" class="text-sm">Saya ingin tetap login</label>
            </div>

            <button type="submit" class="w-full bg-indigo-700 hover:bg-indigo-800 text-white font-semibold py-2 rounded">
                MASUK
            </button>
        </form>
    </div>
</div>
@endsection
