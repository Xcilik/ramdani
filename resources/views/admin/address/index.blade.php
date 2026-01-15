@extends('layouts.admin')

@section('title', 'ADDRESS LIST')

@section('content')
    <div class="min-h-screen bg-gray-50/50 pb-20 pt-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- HEADER SECTION --}}
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8">
                <div>
                    <div class="flex items-center gap-2 mb-1">
                        <span class="text-xs font-semibold text-indigo-600 tracking-wider uppercase">Logistics Database</span>
                        <span class="px-2 py-0.5 rounded-md bg-gray-100 text-gray-500 text-[10px] font-mono font-bold">{{ count($addresses) }} ENTRIES</span>
                    </div>
                    <h1 class="text-3xl font-bold text-gray-800 tracking-tight">Shipping Addresses</h1>
                </div>

                <a href="{{ route('admin.addresses.create') }}" 
                   class="group flex items-center gap-2 px-6 py-3 bg-[#111] text-white text-sm font-bold rounded-xl hover:bg-black hover:shadow-lg hover:shadow-gray-200 transition-all transform hover:-translate-y-0.5">
                    <svg class="w-4 h-4 text-gray-400 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    <span>Add New Address</span>
                </a>
            </div>

            {{-- FLASH MESSAGE --}}
            @if (session('success'))
                <div class="mb-6 rounded-xl bg-green-50 border border-green-100 p-4 flex items-center gap-3 animate-fade-in-down">
                    <div class="flex-shrink-0 w-8 h-8 rounded-full bg-green-100 flex items-center justify-center text-green-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-green-800">System Notification</p>
                        <p class="text-xs text-green-600">{{ session('success') }}</p>
                    </div>
                    <button onclick="this.parentElement.remove()" class="ml-auto text-green-400 hover:text-green-600">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
            @endif

            {{-- TABLE CARD --}}
            <div class="bg-white rounded-2xl shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] border border-gray-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50/50 border-b border-gray-100">
                                <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-400">Receiver / Label</th>
                                <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-400">Contact</th>
                                <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-400">Location Details</th>
                                <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-400 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($addresses as $address)
                                <tr class="group hover:bg-gray-50/80 transition-colors">
                                    
                                    {{-- NAME --}}
                                    <td class="px-6 py-4 align-top">
                                        <div class="flex items-start gap-3">
                                            <div class="mt-1 w-2 h-2 rounded-full bg-indigo-500"></div>
                                            <div>
                                                <p class="font-bold text-gray-800 text-sm group-hover:text-indigo-600 transition-colors">
                                                    {{ $address->name }}
                                                </p>
                                                <span class="inline-flex items-center px-2 py-0.5 mt-1 rounded text-[10px] font-medium bg-gray-100 text-gray-500 font-mono">
                                                    ID: {{ $address->id }}
                                                </span>
                                            </div>
                                        </div>
                                    </td>

                                    {{-- CONTACT --}}
                                    <td class="px-6 py-4 align-top">
                                        <div class="flex items-center gap-2 text-sm text-gray-600">
                                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                            <span class="font-mono">{{ $address->phone }}</span>
                                        </div>
                                    </td>

                                    {{-- LOCATION --}}
                                    <td class="px-6 py-4 align-top">
                                        <p class="text-sm text-gray-600 font-medium line-clamp-2 mb-2">
                                            {{ $address->address }}
                                        </p>
                                        <div class="flex flex-wrap gap-2">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-50 text-indigo-700">
                                                {{ $address->city }}
                                            </span>
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-600">
                                                {{ $address->province }}
                                            </span>
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-500 font-mono">
                                                {{ $address->postal_code }}
                                            </span>
                                        </div>
                                    </td>

                                    {{-- ACTIONS --}}
                                    <td class="px-6 py-4 align-top text-right">
                                        <div class="flex justify-end items-center gap-2">
                                            {{-- Edit --}}
                                            <a href="{{ route('admin.addresses.edit', $address->id) }}" 
                                               class="p-2 rounded-lg text-gray-400 hover:text-indigo-600 hover:bg-indigo-50 transition-all" title="Edit Address">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                            </a>

                                            {{-- Delete --}}
                                            <form action="{{ route('admin.addresses.destroy', $address->id) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button onclick="return confirm('WARNING: Are you sure you want to remove this address?')" 
                                                        class="p-2 rounded-lg text-gray-400 hover:text-red-600 hover:bg-red-50 transition-all" title="Delete">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-12 text-center text-gray-400">
                                        <div class="flex flex-col items-center justify-center">
                                            <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mb-4">
                                                <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                            </div>
                                            <p class="text-sm font-medium text-gray-500">No addresses found</p>
                                            <p class="text-xs text-gray-400 mt-1">Start by adding a new shipping destination.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- FOOTER / PAGINATION --}}
                <div class="px-6 py-4 border-t border-gray-100 bg-gray-50 flex items-center justify-between">
                    <p class="text-xs text-gray-500">
                        Total Records: <span class="font-bold text-gray-800">{{ count($addresses) }}</span>
                    </p>
                    {{-- Pagination Placeholder if needed --}}
                    {{-- {{ $addresses->links() }} --}}
                </div>
            </div>

        </div>
    </div>
@endsection