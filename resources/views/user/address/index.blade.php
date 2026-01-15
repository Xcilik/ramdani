@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-50/50 pb-20 pt-8 font-sans text-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- HEADER SECTION --}}
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Address Book</h1>
                    <p class="text-sm text-gray-500 mt-1">Manage your shipping destinations.</p>
                </div>
                
                <a href="{{ route('user.addresses.create') }}" 
                   class="inline-flex items-center gap-2 px-5 py-2.5 bg-[#111] text-white text-sm font-bold rounded-xl hover:bg-black hover:shadow-lg transition-all transform hover:-translate-y-0.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    <span>Add New Address</span>
                </a>
            </div>

            {{-- NOTIFICATION --}}
            @if (session('success'))
                <div class="mb-8 rounded-xl bg-green-50 border border-green-100 p-4 flex items-center justify-between animate-fade-in-down">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center text-green-600">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                    </div>
                    <button onclick="this.parentElement.remove()" class="text-green-400 hover:text-green-600 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
            @endif

            {{-- ADDRESS GRID --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($addresses as $address)
                    <div class="bg-white rounded-2xl p-6 shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] border border-gray-100 flex flex-col h-full hover:border-indigo-200 transition-colors group">
                        
                        {{-- Card Header --}}
                        <div class="flex justify-between items-start mb-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-gray-50 flex items-center justify-center text-gray-400 group-hover:bg-indigo-50 group-hover:text-indigo-600 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                </div>
                                <div>
                                    <h3 class="font-bold text-gray-900 text-lg leading-tight">{{ $address->name }}</h3>
                                    <p class="text-xs text-gray-500 font-mono mt-0.5">{{ $address->phone }}</p>
                                </div>
                            </div>
                        </div>

                        {{-- Address Body --}}
                        <div class="flex-1 mb-6">
                            <p class="text-sm text-gray-600 leading-relaxed font-medium">
                                {{ $address->address }}
                            </p>
                            <div class="mt-3 flex flex-wrap gap-2">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-lg text-xs font-medium bg-gray-100 text-gray-600">
                                    {{ $address->city }}
                                </span>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-lg text-xs font-medium bg-gray-100 text-gray-600">
                                    {{ $address->province }}
                                </span>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-lg text-xs font-medium bg-gray-100 text-gray-500 font-mono">
                                    {{ $address->postal_code }}
                                </span>
                            </div>
                        </div>

                        {{-- Card Footer / Actions --}}
                        <div class="pt-4 border-t border-gray-50 flex items-center justify-between">
                            <a href="{{ route('user.addresses.edit', $address->id) }}" 
                               class="text-xs font-bold text-indigo-600 hover:text-indigo-800 transition-colors flex items-center gap-1">
                                Edit Details
                            </a>

                            <form action="{{ route('user.addresses.destroy', $address->id) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to remove this address?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-xs font-medium text-gray-400 hover:text-red-500 transition-colors flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    Delete
                                </button>
                            </form>
                        </div>

                    </div>
                @empty
                    {{-- Empty State --}}
                    <div class="col-span-1 md:col-span-2 lg:col-span-3">
                        <div class="rounded-2xl border-2 border-dashed border-gray-200 bg-gray-50 p-12 text-center flex flex-col items-center justify-center">
                            <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mb-4 shadow-sm text-gray-300">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900">No addresses saved</h3>
                            <p class="text-sm text-gray-500 mt-1 mb-6 max-w-xs mx-auto">
                                Save your shipping details now to speed up the checkout process later.
                            </p>
                            <a href="{{ route('user.addresses.create') }}" 
                               class="inline-flex items-center px-6 py-2 bg-white border border-gray-300 text-sm font-bold rounded-xl text-gray-700 hover:bg-gray-50 hover:border-gray-400 transition-all">
                                Create Address
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>

            {{-- Back Link --}}
            <div class="mt-12 text-center md:text-left">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-sm font-medium text-gray-400 hover:text-gray-600 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Back to Home
                </a>
            </div>

        </div>
    </div>
@endsection