@extends('layouts.admin')

@section('title', 'NEW ADDRESS')

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
                            </div>
                            <h1 class="text-3xl font-bold text-gray-800 tracking-tight leading-tight mb-4">
                                Add New <br>Address
                            </h1>
                            <p class="text-sm text-gray-500 leading-relaxed mb-8">
                                Ensure the shipping details are accurate to avoid delivery delays. This address will be saved to your master database.
                            </p>

                            <a href="{{ route('admin.addresses.index') }}" 
                               class="inline-flex items-center gap-2 text-sm font-medium text-gray-500 hover:text-gray-900 transition-colors group">
                                <div class="w-8 h-8 rounded-full bg-white border border-gray-200 flex items-center justify-center group-hover:border-gray-400 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                                </div>
                                Back to Address List
                            </a>
                        </div>
                        
                        {{-- Optional: Quick Tips / Visual Decoration --}}
                        <div class="hidden lg:block p-4 bg-indigo-50 rounded-xl border border-indigo-100">
                            <div class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-indigo-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <div>
                                    <p class="text-xs font-bold text-indigo-900">Tips:</p>
                                    <p class="text-xs text-indigo-700 mt-1">Include the RT/RW details for faster local couriers.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- KOLOM KANAN: FORM INPUT --}}
                <div class="lg:col-span-8">
                    <div class="bg-white rounded-2xl shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] border border-gray-100 overflow-hidden p-8">
                        
                        <form action="{{ route('admin.addresses.store') }}" method="POST">
                            @csrf
                
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
                                                   value="{{ old('name') }}" 
                                                   class="w-full px-4 py-3 rounded-xl bg-gray-50 border-transparent focus:bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 outline-none transition-all placeholder-gray-400 text-sm font-medium" 
                                                   placeholder="e.g. Head Office / John Doe" 
                                                   required>
                                        </div>
                
                                        {{-- Telepon --}}
                                        <div class="space-y-2">
                                            <label class="text-sm font-semibold text-gray-700">Phone Number <span class="text-red-500">*</span></label>
                                            <input type="text" 
                                                   name="phone" 
                                                   value="{{ old('phone') }}" 
                                                   class="w-full px-4 py-3 rounded-xl bg-gray-50 border-transparent focus:bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 outline-none transition-all placeholder-gray-400 text-sm font-medium" 
                                                   placeholder="0812..." 
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
                                                  placeholder="Street Name, Block, Number, RT/RW..." 
                                                  required>{{ old('address') }}</textarea>
                                    </div>
                
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                        {{-- Kota --}}
                                        <div class="space-y-2">
                                            <label class="text-sm font-semibold text-gray-700">City <span class="text-red-500">*</span></label>
                                            <input type="text" 
                                                   name="city" 
                                                   value="{{ old('city') }}" 
                                                   class="w-full px-4 py-3 rounded-xl bg-gray-50 border-transparent focus:bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 outline-none transition-all placeholder-gray-400 text-sm font-medium" 
                                                   required>
                                        </div>
                
                                        {{-- Provinsi --}}
                                        <div class="space-y-2">
                                            <label class="text-sm font-semibold text-gray-700">Province <span class="text-red-500">*</span></label>
                                            <input type="text" 
                                                   name="province" 
                                                   value="{{ old('province') }}" 
                                                   class="w-full px-4 py-3 rounded-xl bg-gray-50 border-transparent focus:bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 outline-none transition-all placeholder-gray-400 text-sm font-medium" 
                                                   required>
                                        </div>
                
                                        {{-- Kode Pos --}}
                                        <div class="space-y-2">
                                            <label class="text-sm font-semibold text-gray-700">Postal Code <span class="text-red-500">*</span></label>
                                            <input type="text" 
                                                   name="postal_code" 
                                                   value="{{ old('postal_code') }}" 
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
                                    <span>Save Address</span>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection