@extends('layouts.admin')

@section('title', 'EDIT ADDRESS')

@section('content')
    <div class="min-h-screen bg-gray-50/50 pb-20 pt-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">

                {{-- KOLOM KIRI: INFO & NAVIGASI --}}
                <div class="lg:col-span-4">
                    <div class="sticky top-8">
                        <div class="mb-6">
                            <div class="flex items-center gap-2 mb-2">
                                <span class="text-xs font-semibold text-indigo-600 tracking-wider uppercase">Logistics & Delivery</span>
                                <span class="px-2 py-0.5 rounded-md bg-gray-200 text-gray-600 text-[10px] font-mono font-bold">
                                    ID: {{ $address->id }}
                                </span>
                            </div>
                            <h1 class="text-3xl font-bold text-gray-800 tracking-tight leading-tight mb-4">
                                Edit Shipping <br>Address
                            </h1>
                            <p class="text-sm text-gray-500 leading-relaxed mb-8">
                                Update the shipping details below. Changes will be reflected immediately in the master database.
                            </p>

                            <a href="{{ route('admin.addresses.index') }}" 
                               class="inline-flex items-center gap-2 text-sm font-medium text-gray-500 hover:text-gray-900 transition-colors group">
                                <div class="w-8 h-8 rounded-full bg-white border border-gray-200 flex items-center justify-center group-hover:border-gray-400 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                                </div>
                                Cancel & Return
                            </a>
                        </div>
                        
                        {{-- Context Box --}}
                        <div class="hidden lg:block p-4 bg-white rounded-xl border border-gray-100 shadow-sm">
                            <p class="text-xs font-bold text-gray-400 uppercase mb-2">Current Label</p>
                            <p class="text-sm font-bold text-gray-800 truncate">{{ $address->name }}</p>
                            <p class="text-xs text-gray-500 mt-1">{{ $address->city }}</p>
                        </div>
                    </div>
                </div>

                {{-- KOLOM KANAN: FORM INPUT --}}
                <div class="lg:col-span-8">
                    <div class="bg-white rounded-2xl shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] border border-gray-100 overflow-hidden p-8">
                        
                        <form action="{{ route('admin.addresses.update', $address->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                
                            <div class="space-y-10">
                                
                                {{-- SECTION 01: CONTACT INFO --}}
                                <div>
                                    <div class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-50">
                                        <div class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center text-gray-500">
                                            <span class="text-xs font-bold">01</span>
                                        </div>
                                        <h3 class="font-bold text-gray-800 text-lg">Contact Information</h3>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        {{-- Label / Nama --}}
                                        <div class="space-y-2">
                                            <label class="text-sm font-semibold text-gray-700">Label / Receiver Name <span class="text-red-500">*</span></label>
                                            <input type="text" 
                                                   name="name" 
                                                   value="{{ old('name', $address->name) }}" 
                                                   class="w-full px-4 py-3 rounded-xl bg-gray-50 border-transparent focus:bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 outline-none transition-all placeholder-gray-400 text-sm font-medium" 
                                                   required>
                                        </div>
                
                                        {{-- Telepon --}}
                                        <div class="space-y-2">
                                            <label class="text-sm font-semibold text-gray-700">Phone Number <span class="text-red-500">*</span></label>
                                            <input type="text" 
                                                   name="phone" 
                                                   value="{{ old('phone', $address->phone) }}" 
                                                   class="w-full px-4 py-3 rounded-xl bg-gray-50 border-transparent focus:bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 outline-none transition-all placeholder-gray-400 text-sm font-medium" 
                                                   required>
                                        </div>
                                    </div>
                                </div>
                
                                {{-- SECTION 02: LOCATION DETAILS --}}
                                <div>
                                    <div class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-50">
                                        <div class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center text-gray-500">
                                            <span class="text-xs font-bold">02</span>
                                        </div>
                                        <h3 class="font-bold text-gray-800 text-lg">Location Details</h3>
                                    </div>
                                    
                                    {{-- Alamat --}}
                                    <div class="space-y-2 mb-6">
                                        <label class="text-sm font-semibold text-gray-700">Full Address <span class="text-red-500">*</span></label>
                                        <textarea name="address" 
                                                  rows="3" 
                                                  class="w-full px-4 py-3 rounded-xl bg-gray-50 border-transparent focus:bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 outline-none transition-all placeholder-gray-400 text-sm font-medium resize-none" 
                                                  required>{{ old('address', $address->address) }}</textarea>
                                    </div>
                
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                        {{-- Kota --}}
                                        <div class="space-y-2">
                                            <label class="text-sm font-semibold text-gray-700">City <span class="text-red-500">*</span></label>
                                            <input type="text" 
                                                   name="city" 
                                                   value="{{ old('city', $address->city) }}" 
                                                   class="w-full px-4 py-3 rounded-xl bg-gray-50 border-transparent focus:bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 outline-none transition-all placeholder-gray-400 text-sm font-medium" 
                                                   required>
                                        </div>
                
                                        {{-- Provinsi --}}
                                        <div class="space-y-2">
                                            <label class="text-sm font-semibold text-gray-700">Province <span class="text-red-500">*</span></label>
                                            <input type="text" 
                                                   name="province" 
                                                   value="{{ old('province', $address->province) }}" 
                                                   class="w-full px-4 py-3 rounded-xl bg-gray-50 border-transparent focus:bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 outline-none transition-all placeholder-gray-400 text-sm font-medium" 
                                                   required>
                                        </div>
                
                                        {{-- Kode Pos --}}
                                        <div class="space-y-2">
                                            <label class="text-sm font-semibold text-gray-700">Postal Code <span class="text-red-500">*</span></label>
                                            <input type="text" 
                                                   name="postal_code" 
                                                   value="{{ old('postal_code', $address->postal_code) }}" 
                                                   class="w-full px-4 py-3 rounded-xl bg-gray-50 border-transparent focus:bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 outline-none transition-all placeholder-gray-400 text-sm font-medium" 
                                                   required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                
                            {{-- SUBMIT BUTTON --}}
                            <div class="mt-10 pt-6 border-t border-gray-100 flex justify-end">
                                <button type="submit" 
                                        class="px-8 py-3 bg-[#111] text-white text-sm font-bold rounded-xl hover:bg-black hover:shadow-lg hover:shadow-gray-200 transition-all transform hover:-translate-y-0.5 flex items-center gap-2">
                                    <span>Update Address</span>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection