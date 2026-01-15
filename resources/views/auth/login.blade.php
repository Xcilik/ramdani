@extends('layouts.app')

@section('content')
<div class="min-h-screen flex flex-col items-center pt-10 pb-20 px-4 bg-white">
    
    {{-- ================= LOGO HEADER ================= --}}
    <div class="mb-8 text-center">
        <a href="/" class="inline-block">
            <svg class="h-6 md:h-10 w-auto text-black" viewBox="0 0 24 24" fill="currentColor">
                <path d="M21 8.719L7.836 14.303C6.74 14.768 5.818 15 5.075 15c-.836 0-1.445-.295-1.819-.884-.485-.76-.273-1.982.559-3.272.494-.754 1.122-1.446 1.734-2.108-.601.575-1.48 1.43-1.987 2.384-1.5 2.82-1.31 5.485.807 7.02 1.156.837 2.593 1.144 3.965.86 1.383-.284 3.03-1.163 4.904-2.227L22 12.18l-1-3.461z"/> 
            </svg>
        </a>
    </div>

    {{-- ================= FORM CONTAINER ================= --}}
    <div class="w-full max-w-[380px]">
        
        {{-- Heading --}}
        <div class="text-center mb-8">
            <h1 class="text-2xl md:text-[26px] font-bold uppercase leading-none tracking-tight mb-4">
                Akun Anda Untuk <br> Semuanya
            </h1>
        </div>

        {{-- Error Message --}}
        @if ($errors->any())
            <div class="mb-6 p-3 bg-white border border-red-500 rounded-md flex items-start gap-3">
                <svg class="w-5 h-5 text-red-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <p class="text-xs text-red-600 font-medium mt-0.5">
                    {{ $errors->first() }}
                </p>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            {{-- Email --}}
            <div>
                <input type="email" name="email" 
                       class="w-full border border-gray-300 rounded-md text-sm px-4 py-3 focus:ring-1 focus:ring-black focus:border-black placeholder-gray-500 transition"
                       placeholder="Alamat Email" 
                       required autofocus>
            </div>

            {{-- Password --}}
            <div>
                <input type="password" name="password" 
                       class="w-full border border-gray-300 rounded-md text-sm px-4 py-3 focus:ring-1 focus:ring-black focus:border-black placeholder-gray-500 transition"
                       placeholder="Kata Sandi" 
                       required>
            </div>

            {{-- Forgot Password Link & Terms Text --}}
            <div class="flex justify-between items-center mt-6 mb-6">
                <label class="flex items-center">
                    <input type="checkbox" name="remember" class="rounded border-gray-300 text-black focus:ring-black">
                    <span class="ml-2 text-xs text-gray-500">Ingat saya</span>
                </label>
                <a href="#" class="text-xs text-gray-500 hover:underline">Lupa Kata Sandi?</a>
            </div>

            <div class="text-center text-[11px] text-gray-500 mb-6 leading-normal px-2">
                Dengan masuk, Anda menyetujui <a href="#" class="underline text-black">Kebijakan Privasi</a> dan <a href="#" class="underline text-black">Syarat Penggunaan</a> kami.
            </div>

            {{-- Submit Button --}}
            <button type="submit" 
                    class="w-full bg-black text-white text-sm font-bold uppercase rounded-full py-4 hover:bg-gray-800 transition duration-200 shadow-lg">
                Masuk
            </button>
        </form>

        {{-- Register Link --}}
        <div class="mt-8 text-center">
            <p class="text-xs text-gray-500 mb-2">Belum menjadi member?</p>
            <a href="{{ route('register') }}" 
               class="inline-block text-black text-sm font-bold uppercase hover:opacity-70 transition underline underline-offset-4">
                Gabung Bersama Kami
            </a>
        </div>
    </div>
</div>
@endsection