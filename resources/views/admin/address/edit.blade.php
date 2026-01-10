@extends('layouts.app')

@section('content')
{{-- CONTAINER: Menggunakan max-w-7xl dan px-4 md:px-6 agar SEJAJAR dengan Header --}}
<div class="max-w-7xl mx-auto px-4 md:px-6 py-10 text-[#1a1a1a] font-sans">

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">

        {{-- KOLOM KIRI: JUDUL & INFO (Sticky) --}}
        <div class="lg:col-span-4">
            <div class="sticky top-24 border-t-4 border-[#1a1a1a] pt-4">
                <div class="flex justify-between items-start mb-2">
                    <span class="font-mono text-xs text-gray-400 block uppercase tracking-widest">
                        Admin Panel // Edit
                    </span>
                    {{-- Badge ID Industrial Style --}}
                    <span class="font-mono text-[10px] bg-gray-100 px-2 py-1 border border-gray-200">
                        REF_ID: {{ $address->id }}
                    </span>
                </div>

                <h1 class="text-3xl md:text-4xl font-black uppercase tracking-tighter leading-none mb-4">
                    Perbarui <br>Data Alamat
                </h1>
                <p class="text-sm text-gray-500 leading-relaxed">
                    Ubah informasi pengiriman di formulir sebelah kanan. Pastikan data tetap valid.
                </p>
                
                <div class="mt-8">
                    <a href="{{ route('admin.addresses.index') }}" 
                       class="text-xs font-bold uppercase tracking-widest text-gray-400 hover:text-[#1a1a1a] underline decoration-2 underline-offset-4 transition-colors">
                        &larr; Kembali ke Daftar
                    </a>
                </div>
            </div>
        </div>

        {{-- KOLOM KANAN: FORM UPDATE --}}
        <div class="lg:col-span-8">
            <div class="bg-white border border-gray-200 p-6 md:p-8">
                <form action="{{ route('admin.addresses.update', $address->id) }}" method="POST">
                    @csrf
                    @method('PUT')
        
                    <div class="space-y-8">
                        
                        {{-- SECTION 01: INFORMASI KONTAK --}}
                        <div>
                            <h3 class="font-bold text-sm uppercase tracking-wider border-b border-gray-100 pb-2 mb-4 text-gray-400">
                                01. Informasi Kontak
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                {{-- Nama / Label --}}
                                <div class="group">
                                    <label class="block font-mono text-xs font-bold uppercase text-gray-500 mb-2 group-focus-within:text-black transition-colors">
                                        Label / Nama Penerima <span class="text-red-600">*</span>
                                    </label>
                                    <input type="text" 
                                           name="name" 
                                           value="{{ old('name', $address->name) }}" 
                                           class="w-full border border-gray-300 bg-white p-3 text-sm focus:outline-none focus:border-[#1a1a1a] focus:ring-1 focus:ring-[#1a1a1a] transition-all rounded-none placeholder-gray-300" 
                                           required>
                                </div>
        
                                {{-- Telepon --}}
                                <div class="group">
                                    <label class="block font-mono text-xs font-bold uppercase text-gray-500 mb-2 group-focus-within:text-black transition-colors">
                                        Nomor Telepon <span class="text-red-600">*</span>
                                    </label>
                                    <input type="text" 
                                           name="phone" 
                                           value="{{ old('phone', $address->phone) }}" 
                                           class="w-full border border-gray-300 bg-white p-3 text-sm focus:outline-none focus:border-[#1a1a1a] focus:ring-1 focus:ring-[#1a1a1a] transition-all rounded-none placeholder-gray-300" 
                                           required>
                                </div>
                            </div>
                        </div>
        
                        {{-- SECTION 02: DETAIL LOKASI --}}
                        <div>
                            <h3 class="font-bold text-sm uppercase tracking-wider border-b border-gray-100 pb-2 mb-4 text-gray-400">
                                02. Detail Lokasi
                            </h3>
                            
                            {{-- Alamat --}}
                            <div class="group mb-6">
                                <label class="block font-mono text-xs font-bold uppercase text-gray-500 mb-2 group-focus-within:text-black transition-colors">
                                    Alamat Lengkap <span class="text-red-600">*</span>
                                </label>
                                <textarea name="address" 
                                          rows="3" 
                                          class="w-full border border-gray-300 bg-white p-3 text-sm focus:outline-none focus:border-[#1a1a1a] focus:ring-1 focus:ring-[#1a1a1a] transition-all rounded-none placeholder-gray-300" 
                                          required>{{ old('address', $address->address) }}</textarea>
                            </div>
        
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                {{-- Kota --}}
                                <div class="group">
                                    <label class="block font-mono text-xs font-bold uppercase text-gray-500 mb-2 group-focus-within:text-black transition-colors">
                                        Kota / Kab <span class="text-red-600">*</span>
                                    </label>
                                    <input type="text" 
                                           name="city" 
                                           value="{{ old('city', $address->city) }}" 
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
                                           value="{{ old('province', $address->province) }}" 
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
                                           value="{{ old('postal_code', $address->postal_code) }}" 
                                           class="w-full border border-gray-300 bg-white p-3 text-sm focus:outline-none focus:border-[#1a1a1a] focus:ring-1 focus:ring-[#1a1a1a] transition-all rounded-none" 
                                           required>
                                </div>
                            </div>
                        </div>
                    </div>
        
                    {{-- ACTION BUTTONS --}}
                    <div class="mt-8 pt-6 border-t border-gray-200 flex justify-end">
                        <button type="submit" 
                                class="bg-[#1a1a1a] text-white px-12 py-4 text-xs font-bold uppercase tracking-widest hover:bg-[#EB0000] transition-colors rounded-none focus:ring-2 focus:ring-offset-2 focus:ring-black">
                            Update Data
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection