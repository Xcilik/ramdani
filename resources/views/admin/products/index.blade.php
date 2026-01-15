@extends('layouts.admin')

@section('title', 'INVENTORY LIST')

@section('content')
    <div class="min-h-screen bg-gray-50/50 pb-20 pt-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- HEADER SECTION --}}
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8">
                <div>
                    <div class="flex items-center gap-2 mb-1">
                        <span class="text-xs font-semibold text-indigo-600 tracking-wider uppercase">Database View</span>
                        <span class="px-2 py-0.5 rounded-md bg-gray-100 text-gray-500 text-[10px] font-mono font-bold">{{ $products->count() }} ITEMS</span>
                    </div>
                    <h1 class="text-3xl font-bold text-gray-800 tracking-tight">Product Inventory</h1>
                </div>

                <a href="{{ route('admin.products.create') }}" 
                   class="group flex items-center gap-2 px-6 py-3 bg-[#111] text-white text-sm font-bold rounded-xl hover:bg-black hover:shadow-lg hover:shadow-gray-200 transition-all transform hover:-translate-y-0.5">
                    <svg class="w-4 h-4 text-gray-400 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    <span>Add New Kicks</span>
                </a>
            </div>

            {{-- TABLE CARD --}}
            <div class="bg-white rounded-2xl shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] border border-gray-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50/50 border-b border-gray-100">
                                <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-400">Product Details</th>
                                <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-400">Category</th>
                                <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-400">Variants</th>
                                <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-400 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($products as $product)
                            <tr class="group hover:bg-gray-50/80 transition-colors">
                                
                                {{-- PRODUCT INFO --}}
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-4">
                                        {{-- Thumbnail Image (Ambil gambar pertama atau placeholder) --}}
                                        <div class="w-12 h-12 rounded-lg bg-gray-100 border border-gray-200 overflow-hidden flex-shrink-0 relative">
                                            @if($product->images->count() > 0)
                                                <img src="{{ asset('storage/' . $product->images->first()->image) }}" class="w-full h-full object-cover">
                                            @else
                                                <div class="flex items-center justify-center h-full text-gray-300">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                                </div>
                                            @endif
                                        </div>

                                        <div>
                                            <p class="font-bold text-gray-800 text-sm group-hover:text-indigo-600 transition-colors">
                                                {{ $product->name }}
                                            </p>
                                            <p class="font-mono text-[10px] text-gray-400 mt-0.5">
                                                ID: {{ substr(md5($product->id), 0, 8) }}
                                            </p>
                                        </div>
                                    </div>
                                </td>

                                {{-- CATEGORY --}}
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-50 text-indigo-700">
                                        {{ $product->category->name }}
                                    </span>
                                </td>

                                {{-- VARIANTS COUNT --}}
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <span class="font-bold text-gray-800">{{ $product->variants->count() }}</span>
                                        <span class="text-xs text-gray-400">Types</span>
                                    </div>
                                </td>

                                {{-- ACTIONS --}}
                                <td class="px-6 py-4 text-right">
                                    <div class="flex justify-end items-center gap-2">
                                        {{-- View --}}
                                        <a href="{{ route('admin.products.show', $product) }}" 
                                           class="p-2 rounded-lg text-gray-400 hover:text-indigo-600 hover:bg-indigo-50 transition-all" title="View Details">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                        </a>

                                        {{-- Edit --}}
                                        <a href="{{ route('admin.products.edit', $product) }}" 
                                           class="p-2 rounded-lg text-gray-400 hover:text-green-600 hover:bg-green-50 transition-all" title="Edit Product">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                        </a>

                                        {{-- Delete --}}
                                        <form method="POST" action="{{ route('admin.products.destroy', $product) }}" class="inline-block">
                                            @csrf @method('DELETE')
                                            <button onclick="return confirm('Are you sure you want to delete this product?')" 
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
                                            <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                                        </div>
                                        <p class="text-sm font-medium text-gray-500">No products found</p>
                                        <p class="text-xs text-gray-400 mt-1">Start by adding a new pair of kicks.</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- PAGINATION --}}
                <div class="px-6 py-4 border-t border-gray-100 bg-gray-50 flex items-center justify-between">
                    <p class="text-xs text-gray-500">
                        Showing <span class="font-bold text-gray-800">{{ $products->count() }}</span> results
                    </p>
                    
                    {{-- Pagination Placeholder (Or use standard Laravel Links) --}}
                    <div class="flex gap-2">
                        <button class="px-3 py-1 bg-white border border-gray-200 rounded-lg text-xs font-medium text-gray-600 hover:bg-gray-50 hover:text-gray-900 transition-colors disabled:opacity-50">Previous</button>
                        <button class="px-3 py-1 bg-[#111] border border-[#111] rounded-lg text-xs font-medium text-white shadow-sm">1</button>
                        <button class="px-3 py-1 bg-white border border-gray-200 rounded-lg text-xs font-medium text-gray-600 hover:bg-gray-50 hover:text-gray-900 transition-colors">Next</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection