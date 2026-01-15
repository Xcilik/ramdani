@extends('layouts.admin')

@section('title', 'PRODUCT DETAILS')

@section('content')
    <div class="min-h-screen bg-gray-50/50 pb-20 pt-8">
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- HEADER NAVIGATION --}}
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8">
                <div>
                    <div class="flex items-center gap-2 mb-1">
                        <span class="text-xs font-semibold text-indigo-600 tracking-wider uppercase">Product Details</span>
                        <span class="text-xs text-gray-400 font-mono">ID: {{ substr(md5($product->id), 0, 8) }}</span>
                    </div>
                    <h1 class="text-3xl font-bold text-gray-800 tracking-tight">Specification Sheet</h1>
                </div>

                <div class="flex items-center gap-3">
                    <a href="{{ route('admin.products.index') }}"
                        class="px-4 py-2 bg-white border border-gray-200 text-sm font-medium text-gray-600 rounded-lg hover:bg-gray-50 hover:text-gray-900 transition-colors flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                        Back to List
                    </a>

                    <a href="{{ route('admin.products.edit', $product) }}"
                        class="px-6 py-2 bg-[#111] text-white text-sm font-bold rounded-lg hover:bg-black hover:shadow-lg transition-all flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                        Edit Product
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                {{-- COL 1: IMAGES GALLERY --}}
                <div class="lg:col-span-1 space-y-6">
                    {{-- Main Image Card --}}
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-2">
                        <div class="relative aspect-square rounded-xl overflow-hidden bg-gray-100 group">
                            @if ($product->images->count() > 0)
                                <img src="{{ asset('storage/' . $product->images->first()->image) }}"
                                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                            @else
                                <div class="w-full h-full flex flex-col items-center justify-center text-gray-300">
                                    <svg class="w-12 h-12 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    <span class="text-xs font-medium">No Image Available</span>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Thumbnails --}}
                    @if ($product->images->count() > 1)
                        <div class="grid grid-cols-4 gap-3">
                            @foreach ($product->images->skip(1) as $img)
                                <div class="aspect-square rounded-lg overflow-hidden border border-gray-200 cursor-pointer hover:ring-2 hover:ring-indigo-500 hover:border-transparent transition-all">
                                    <img src="{{ asset('storage/' . $img->image) }}" class="w-full h-full object-cover">
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                {{-- COL 2: DATA & VARIANTS --}}
                <div class="lg:col-span-2 space-y-8">

                    {{-- Product Info Card --}}
                    <div class="bg-white rounded-2xl shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] border border-gray-100 p-8">
                        
                        <div class="flex items-center gap-3 mb-6">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-indigo-50 text-indigo-700 uppercase tracking-wide">
                                {{ $product->category->name }}
                            </span>
                            <span class="text-xs text-gray-400 font-medium">
                                Created on {{ $product->created_at->format('d M Y') }}
                            </span>
                        </div>

                        <h2 class="text-3xl font-bold text-gray-900 mb-4 leading-tight">
                            {{ $product->name }}
                        </h2>

                        <div class="prose prose-sm text-gray-600 max-w-none">
                            <p class="leading-relaxed">
                                {{ $product->description }}
                            </p>
                        </div>
                    </div>

                    {{-- Inventory / Variants Card --}}
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                            <h3 class="font-bold text-gray-800">Inventory & Pricing</h3>
                            <span class="text-xs font-semibold text-gray-500 bg-white border border-gray-200 px-2 py-1 rounded-md">
                                {{ $product->variants->count() }} Variants
                            </span>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="w-full text-left">
                                <thead>
                                    <tr class="text-xs font-semibold text-gray-400 uppercase tracking-wider border-b border-gray-50">
                                        <th class="px-6 py-4">Color</th>
                                        <th class="px-6 py-4">Size</th>
                                        <th class="px-6 py-4 text-right">Stock Level</th>
                                        <th class="px-6 py-4 text-right">Price</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-50">
                                    @foreach ($product->variants as $v)
                                        <tr class="hover:bg-gray-50 transition-colors group">
                                            <td class="px-6 py-4">
                                                <div class="flex items-center gap-2">
                                                    {{-- Color Dot Indicator (Optional visual flair) --}}
                                                    <div class="w-3 h-3 rounded-full border border-gray-200 shadow-sm" style="background-color: {{ strtolower($v->color) }};"></div>
                                                    <span class="font-medium text-gray-700">{{ $v->color }}</span>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-gray-100 text-xs font-bold text-gray-600">
                                                    {{ $v->size }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 text-right">
                                                @if ($v->stock > 5)
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-50 text-green-700">
                                                        {{ $v->stock }} Units
                                                    </span>
                                                @elseif($v->stock > 0)
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-orange-50 text-orange-700">
                                                        Low: {{ $v->stock }}
                                                    </span>
                                                @else
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-500">
                                                        Out of Stock
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 text-right font-mono font-medium text-gray-900">
                                                Rp {{ number_format($v->price, 0, ',', '.') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection