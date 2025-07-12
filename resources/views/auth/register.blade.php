@extends('layouts.app-auth')

@section('title', 'Register User')

@section('content')
<div class="flex justify-center items-center h-screen w-screen bg-gray-50 px-4 sm:px-0">
    <div class="w-full max-w-md bg-white p-8 rounded-lg shadow border">
        {{-- Tab --}}
        <div class="flex mb-6 border-b border-gray-300">
            <a href="#" class="flex-1 text-center py-2 font-medium border-b-2 border-black text-black">Pelanggan Baru</a>
            <a href="{{ route('login') }}" class="flex-1 text-center py-2 font-medium text-gray-500 hover:text-black">Pelanggan Lama</a>
        </div>

        {{-- Title --}}
        <h2 class="text-xl font-semibold text-center mb-4">Buat akun</h2>

        {{-- Google Login --}}
        <div class="mb-3">
            <a href="{{ route('login.google') }}"
               class="flex items-center justify-center gap-2 w-full border border-gray-300 rounded px-4 py-2 hover:bg-gray-100 transition text-sm">
                <img src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg" class="w-5 h-5" alt="Google">
                Lanjutkan dengan Google
            </a>
        </div>

        <p class="text-xs text-center text-gray-500 mb-4">
            Kami tidak akan posting atas nama Anda atau membagikan informasi tanpa persetujuan Anda.
        </p>

        {{-- Divider --}}
        <div class="flex items-center gap-2 mb-4">
            <hr class="flex-grow border-gray-300">
            <span class="text-xs text-gray-400">atau daftar dengan email</span>
            <hr class="flex-grow border-gray-300">
        </div>

        {{-- Error --}}
        @if ($errors->any())
            <div class="mb-4 text-sm text-red-600 bg-red-100 p-3 rounded">
                <ul class="list-disc ml-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Form --}}
        <form action="{{ route('do.register') }}" method="POST" class="space-y-4">
            @csrf

            <input type="text" name="name" value="{{ old('name') }}" required
                   class="w-full px-4 py-2 border border-gray-300 rounded placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                   placeholder="Nama">

            <input type="email" name="email" value="{{ old('email') }}" required
                   class="w-full px-4 py-2 border border-gray-300 rounded placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                   placeholder="Alamat Email">

            <input type="password" name="password" required
                   class="w-full px-4 py-2 border border-gray-300 rounded placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                   placeholder="Password">

            <input type="password" name="password_confirmation" required
                   class="w-full px-4 py-2 border border-gray-300 rounded placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                   placeholder="Konfirmasi Password">

            <div class="flex items-center">
                <input type="checkbox" id="remember" name="remember"
                       class="mr-2 border-gray-300 rounded focus:ring-indigo-500">
                <label for="remember" class="text-sm text-gray-700">Saya ingin tetap login</label>
            </div>

            <button type="submit"
                    class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 rounded text-sm uppercase">
                DAFTAR
            </button>
        </form>
    </div>
</div>
@endsection
