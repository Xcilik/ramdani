@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-12 text-[#1a1a1a] font-sans">

    {{-- HEADER SECTION --}}
    <div class="mb-10 border-b-2 border-[#1a1a1a] pb-6">
        <span class="font-mono text-xs text-gray-400 block mb-2 uppercase tracking-wider">Form // Address Entry</span>
        <h1 class="text-3xl md:text-4xl font-black uppercase tracking-tighter leading-none">
            {{ isset($address) ? 'Edit Data Alamat' : 'Input Alamat Baru' }}
        </h1>
    </div>

    {{-- FORM START --}}
    {{-- Fix: Route update menggunakan 'user.addresses.update', bukan create --}}
    <form action="{{ isset($address) ? route('user.addresses.update', $address->id) : route('user.addresses.store') }}" method="POST">
        @csrf
        @if(isset($address)) 
            @method('PUT') 
        @endif

        <div class="space-y-8">
            
            {{-- ROW 1: PERSONAL INFO --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Nama --}}
                <div class="group">
                    <label class="block font-mono text-xs font-bold uppercase text-gray-500 mb-2 group-focus-within:text-black transition-colors">
                        Nama Penerima <span class="text-red-600">*</span>
                    </label>
                    <input type="text" 
                           name="name" 
                           value="{{ old('name', $address->name ?? '') }}" 
                           class="w-full border border-gray-300 bg-white p-3 text-sm focus:outline-none focus:border-[#1a1a1a] focus:ring-1 focus:ring-[#1a1a1a] transition-all rounded-none placeholder-gray-300" 
                           placeholder="CONTOH: BUDI SANTOSO"
                           required>
                </div>

                {{-- Telepon --}}
                <div class="group">
                    <label class="block font-mono text-xs font-bold uppercase text-gray-500 mb-2 group-focus-within:text-black transition-colors">
                        No. Telepon <span class="text-red-600">*</span>
                    </label>
                    <input type="text" 
                           name="phone" 
                           value="{{ old('phone', $address->phone ?? '') }}" 
                           class="w-full border border-gray-300 bg-white p-3 text-sm focus:outline-none focus:border-[#1a1a1a] focus:ring-1 focus:ring-[#1a1a1a] transition-all rounded-none placeholder-gray-300" 
                           placeholder="0812..."
                           required>
                </div>
            </div>

            {{-- ROW 2: ADDRESS --}}
            <div class="group">
                <label class="block font-mono text-xs font-bold uppercase text-gray-500 mb-2 group-focus-within:text-black transition-colors">
                    Alamat Lengkap <span class="text-red-600">*</span>
                </label>
                <textarea name="address" 
                          rows="4" 
                          class="w-full border border-gray-300 bg-white p-3 text-sm focus:outline-none focus:border-[#1a1a1a] focus:ring-1 focus:ring-[#1a1a1a] transition-all rounded-none placeholder-gray-300" 
                          placeholder="Jalan, Nomor Rumah, RT/RW, Patokan..."
                          required>{{ old('address', $address->address ?? '') }}</textarea>
                <p class="text-[10px] text-gray-400 mt-1">* Tulis selengkap mungkin untuk memudahkan kurir.</p>
            </div>

            {{-- ROW 3: LOCATION DETAILS --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                {{-- Kota --}}
                <div class="group">
                    <label class="block font-mono text-xs font-bold uppercase text-gray-500 mb-2 group-focus-within:text-black transition-colors">
                        Kota / Kab <span class="text-red-600">*</span>
                    </label>
                    <input type="text" 
                           name="city" 
                           value="{{ old('city', $address->city ?? '') }}" 
                           class="w-full border border-gray-300 bg-white p-3 text-sm focus:outline-none focus:border-[#1a1a1a] focus:ring-1 focus:ring-[#1a1a1a] transition-all rounded-none" 
                           required>
                </div>

                {{-- Provinsi --}}
                <div class="group">
                    <label class="block font-mono text-xs font-bold uppercase text-gray-500 mb-2 group-focus-within:text-black transition-colors">
                        Provinsi <span class="text-red-600">*</span>
                    </label>
                    <input type="text" 
                           name="province" 
                           value="{{ old('province', $address->province ?? '') }}" 
                           class="w-full border border-gray-300 bg-white p-3 text-sm focus:outline-none focus:border-[#1a1a1a] focus:ring-1 focus:ring-[#1a1a1a] transition-all rounded-none" 
                           required>
                </div>

                {{-- Kode Pos --}}
                <div class="group">
                    <label class="block font-mono text-xs font-bold uppercase text-gray-500 mb-2 group-focus-within:text-black transition-colors">
                        Kode Pos <span class="text-red-600">*</span>
                    </label>
                    <input type="text" 
                           name="postal_code" 
                           value="{{ old('postal_code', $address->postal_code ?? '') }}" 
                           class="w-full border border-gray-300 bg-white p-3 text-sm focus:outline-none focus:border-[#1a1a1a] focus:ring-1 focus:ring-[#1a1a1a] transition-all rounded-none" 
                           required>
                </div>
            </div>
        </div>

        {{-- ACTION BUTTONS --}}
        <div class="mt-12 pt-6 border-t border-gray-200 flex items-center justify-between">
            <a href="{{ route('user.addresses.index') }}" 
               class="text-xs font-bold uppercase tracking-widest text-gray-400 hover:text-[#1a1a1a] underline decoration-2 underline-offset-4 transition-colors">
                &larr; Batalkan
            </a>
            
            <button type="submit" 
                    class="bg-[#1a1a1a] text-white px-10 py-4 text-xs font-bold uppercase tracking-widest hover:bg-[#EB0000] transition-colors rounded-none focus:ring-2 focus:ring-offset-2 focus:ring-black">
                {{ isset($address) ? 'Update Data' : 'Simpan Alamat' }}
            </button>
        </div>
    </form>
</div>
@endsection