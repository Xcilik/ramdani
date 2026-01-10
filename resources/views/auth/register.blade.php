@extends('layouts.app')

@section('content')
<div class="min-h-[80vh] flex items-center justify-center py-12 px-4">
    <div class="max-w-md w-full">
        
        {{-- Header --}}
        <div class="text-center mb-10">
            <h1 class="text-3xl font-black uppercase tracking-tighter mb-2">
                BUAT AKUN <span class="text-red-600">.</span>
            </h1>
            <p class="text-[10px] text-gray-500 uppercase tracking-[0.2em] font-medium leading-relaxed">
                Dapatkan akses eksklusif ke koleksi terbaru <br> dan penawaran khusus anggota.
            </p>
        </div>

        <div class="bg-white border border-gray-200 p-8 md:p-10 shadow-sm">
            {{-- Error Handling --}}
            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-600">
                    <p class="text-[11px] font-bold text-red-600 uppercase tracking-tight">
                        {{ $errors->first() }}
                    </p>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                {{-- Name Field --}}
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-1">
                        Nama Lengkap *
                    </label>
                    <input type="text" name="name" value="{{ old('name') }}"
                           class="w-full border-gray-300 rounded-none text-sm py-3 px-4 focus:ring-0 focus:border-black transition"
                           placeholder="Contoh: Budi Santoso" required>
                </div>

                {{-- Email Field --}}
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-1">
                        Alamat Email *
                    </label>
                    <input type="email" name="email" value="{{ old('email') }}"
                           class="w-full border-gray-300 rounded-none text-sm py-3 px-4 focus:ring-0 focus:border-black transition"
                           placeholder="nama@email.com" required>
                </div>

                {{-- Password Field --}}
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-1">
                        Kata Sandi *
                    </label>
                    <input type="password" name="password" 
                           class="w-full border-gray-300 rounded-none text-sm py-3 px-4 focus:ring-0 focus:border-black transition"
                           placeholder="Minimal 8 karakter" required>
                </div>

                {{-- Confirm Password Field --}}
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-1">
                        Konfirmasi Kata Sandi *
                    </label>
                    <input type="password" name="password_confirmation" 
                           class="w-full border-gray-300 rounded-none text-sm py-3 px-4 focus:ring-0 focus:border-black transition"
                           placeholder="Ulangi kata sandi" required>
                </div>

                {{-- Agreement --}}
                <div class="pt-2">
                    <p class="text-[10px] text-gray-400 leading-normal">
                        Dengan membuat akun, Anda menyetujui <a href="#" class="underline hover:text-black">Ketentuan Penggunaan</a> dan <a href="#" class="underline hover:text-black">Kebijakan Privasi</a> kami.
                    </p>
                </div>

                {{-- Register Button --}}
                <div class="pt-4">
                    <button type="submit" 
                            class="w-full bg-black text-white text-sm font-black uppercase tracking-widest py-4 hover:bg-gray-800 transition duration-300">
                        Daftar Sekarang
                    </button>
                </div>
            </form>

            {{-- Footer Form --}}
            <div class="mt-10 pt-8 border-t border-gray-100 text-center">
                <p class="text-xs text-gray-500 font-medium mb-4">Sudah menjadi anggota?</p>
                <a href="{{ route('login') }}" 
                   class="inline-block w-full border border-black text-black text-sm font-black uppercase tracking-widest py-4 hover:bg-black hover:text-white transition duration-300">
                    Masuk ke Akun Anda
                </a>
            </div>
        </div>
    </div>
</div>
@endsection