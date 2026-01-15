@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-50/50 pb-20 pt-10 font-sans text-gray-800">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- HEADER NAVIGATION --}}
            <div class="mb-8">
                <a href="{{ route('user.addresses.index') }}" 
                   class="inline-flex items-center gap-2 text-sm font-medium text-gray-500 hover:text-indigo-600 transition-colors mb-4 group">
                    <div class="w-8 h-8 rounded-full bg-white border border-gray-200 flex items-center justify-center group-hover:border-indigo-200 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    </div>
                    Back to Address List
                </a>
                
                <h1 class="text-3xl font-bold text-gray-900 tracking-tight">
                    {{ isset($address) ? 'Update Address' : 'New Delivery Address' }}
                </h1>
                <p class="text-sm text-gray-500 mt-2">
                    {{ isset($address) ? 'Edit your existing shipping details below.' : 'Please fill in the details for accurate delivery.' }}
                </p>
            </div>

            {{-- FORM CARD --}}
            <div class="bg-white rounded-2xl shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] border border-gray-100 p-8 overflow-hidden relative">
                
                <form action="{{ isset($address) ? route('user.addresses.update', $address->id) : route('user.addresses.store') }}" method="POST">
                    @csrf
                    @if(isset($address)) 
                        @method('PUT') 
                    @endif

                    <div class="space-y-8">
                        
                        {{-- SECTION 1: PERSONAL INFO --}}
                        <div>
                            <div class="flex items-center gap-3 mb-6 pb-2 border-b border-gray-50">
                                <span class="flex h-6 w-6 items-center justify-center rounded-full bg-indigo-100 text-xs font-bold text-indigo-600">1</span>
                                <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wide">Contact Info</h3>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                {{-- Nama --}}
                                <div class="space-y-2">
                                    <label class="text-sm font-semibold text-gray-700">Receiver Name <span class="text-red-500">*</span></label>
                                    <input type="text" 
                                           name="name" 
                                           value="{{ old('name', $address->name ?? '') }}" 
                                           class="w-full px-4 py-3 rounded-xl bg-gray-50 border-transparent focus:bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 outline-none transition-all placeholder-gray-400 text-sm font-medium" 
                                           placeholder="e.g. Budi Santoso" 
                                           required>
                                </div>
        
                                {{-- Telepon --}}
                                <div class="space-y-2">
                                    <label class="text-sm font-semibold text-gray-700">Phone Number <span class="text-red-500">*</span></label>
                                    <input type="text" 
                                           name="phone" 
                                           value="{{ old('phone', $address->phone ?? '') }}" 
                                           class="w-full px-4 py-3 rounded-xl bg-gray-50 border-transparent focus:bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 outline-none transition-all placeholder-gray-400 text-sm font-medium" 
                                           placeholder="0812..." 
                                           required>
                                </div>
                            </div>
                        </div>

                        {{-- SECTION 2: LOCATION --}}
                        <div>
                            <div class="flex items-center gap-3 mb-6 pb-2 border-b border-gray-50">
                                <span class="flex h-6 w-6 items-center justify-center rounded-full bg-indigo-100 text-xs font-bold text-indigo-600">2</span>
                                <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wide">Location Details</h3>
                            </div>
                            
                            {{-- Alamat --}}
                            <div class="space-y-2 mb-6">
                                <label class="text-sm font-semibold text-gray-700">Full Address <span class="text-red-500">*</span></label>
                                <textarea name="address" 
                                          rows="3" 
                                          class="w-full px-4 py-3 rounded-xl bg-gray-50 border-transparent focus:bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 outline-none transition-all placeholder-gray-400 text-sm font-medium resize-none" 
                                          placeholder="Street Name, House Number, RT/RW..." 
                                          required>{{ old('address', $address->address ?? '') }}</textarea>
                                <p class="text-xs text-gray-400">Please provide complete details to ensure smooth delivery.</p>
                            </div>
        
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                {{-- Kota --}}
                                <div class="space-y-2">
                                    <label class="text-sm font-semibold text-gray-700">City <span class="text-red-500">*</span></label>
                                    <input type="text" 
                                           name="city" 
                                           value="{{ old('city', $address->city ?? '') }}" 
                                           class="w-full px-4 py-3 rounded-xl bg-gray-50 border-transparent focus:bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 outline-none transition-all placeholder-gray-400 text-sm font-medium" 
                                           required>
                                </div>
        
                                {{-- Provinsi --}}
                                <div class="space-y-2">
                                    <label class="text-sm font-semibold text-gray-700">Province <span class="text-red-500">*</span></label>
                                    <input type="text" 
                                           name="province" 
                                           value="{{ old('province', $address->province ?? '') }}" 
                                           class="w-full px-4 py-3 rounded-xl bg-gray-50 border-transparent focus:bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 outline-none transition-all placeholder-gray-400 text-sm font-medium" 
                                           required>
                                </div>
        
                                {{-- Kode Pos --}}
                                <div class="space-y-2">
                                    <label class="text-sm font-semibold text-gray-700">Postal Code <span class="text-red-500">*</span></label>
                                    <input type="text" 
                                           name="postal_code" 
                                           value="{{ old('postal_code', $address->postal_code ?? '') }}" 
                                           class="w-full px-4 py-3 rounded-xl bg-gray-50 border-transparent focus:bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 outline-none transition-all placeholder-gray-400 text-sm font-medium" 
                                           required>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- ACTIONS --}}
                    <div class="mt-10 pt-6 border-t border-gray-100 flex items-center justify-end gap-4">
                        <a href="{{ route('user.addresses.index') }}" 
                           class="text-sm font-bold text-gray-400 hover:text-gray-600 transition-colors">
                            Cancel
                        </a>
                        
                        <button type="submit" 
                                class="px-8 py-3 bg-[#111] text-white text-sm font-bold rounded-xl hover:bg-black hover:shadow-lg hover:shadow-gray-200 transition-all transform hover:-translate-y-0.5 flex items-center gap-2">
                            <span>{{ isset($address) ? 'Save Changes' : 'Save Address' }}</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection