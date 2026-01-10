@extends('layouts.admin')

@section('title', 'SPEC_SHEET_')

@section('content')
    <div class="max-w-5xl mx-auto">

        {{-- HEADER NAVIGATION --}}
        <div class="flex justify-between items-end mb-6 border-b-2 border-[#1a1a1a] pb-4">
            <div>
                <span class="font-mono text-xs text-gray-400 block mb-1">DATABASE // RECORD_VIEW</span>
                <div class="flex items-center gap-2">
                    <h1 class="text-3xl font-black uppercase tracking-tighter text-[#1a1a1a] leading-none">
                        Product Details
                    </h1>
                    <span class="px-2 py-1 bg-[#1a1a1a] text-white text-[10px] font-mono font-bold">
                        ID: {{ substr(md5($product->id), 0, 6) }}
                    </span>
                </div>
            </div>

            <div class="flex gap-4">
                <a href="{{ route('admin.products.index') }}"
                    class="text-[10px] font-bold uppercase tracking-widest hover:text-[#EB0000] decoration-2 underline underline-offset-4 self-center">
                    < Back to Index </a>

                        <a href="{{ route('admin.products.edit', $product) }}"
                            class="bg-[#1a1a1a] text-white px-4 py-2 text-[10px] font-bold uppercase tracking-widest hover:bg-[#EB0000] transition-colors">
                            Edit Entry
                        </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-0 border-2 border-[#1a1a1a] bg-white">

            {{-- COL 1: IMAGES GALLERY --}}
            <div class="lg:col-span-1 border-b-2 lg:border-b-0 lg:border-r-2 border-[#1a1a1a] bg-[#F5F5F5] p-6">
                <h3 class="text-[10px] font-bold uppercase tracking-[0.2em] text-gray-500 mb-4">Visual Assets</h3>

                <div class="space-y-4">
                    {{-- Main Image (First one) --}}
                    @if ($product->images->count() > 0)
                        <div class="border-2 border-[#1a1a1a] bg-white p-2">
                            <img src="{{ asset('storage/' . $product->images->first()->image) }}"
                                class="w-full h-auto object-cover aspect-square grayscale hover:grayscale-0 transition-all duration-500">
                        </div>

                        {{-- Thumbnails Grid --}}
                        @if ($product->images->count() > 1)
                            <div class="grid grid-cols-3 gap-2">
                                @foreach ($product->images->skip(1) as $img)
                                    <div class="border border-gray-400 hover:border-[#1a1a1a] cursor-pointer">
                                        <img src="{{ asset('storage/' . $img->image) }}"
                                            class="w-full h-full object-cover aspect-square grayscale hover:grayscale-0 transition-all">
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    @else
                        <div
                            class="w-full aspect-square bg-gray-200 border-2 border-dashed border-gray-400 flex items-center justify-center">
                            <span class="font-mono text-xs text-gray-400">NO_IMAGE_DATA</span>
                        </div>
                    @endif
                </div>
            </div>

            {{-- COL 2: DATA & VARIANTS --}}
            <div class="lg:col-span-2">

                {{-- Top Info --}}
                <div class="p-8 border-b-2 border-[#1a1a1a]">
                    <div class="flex justify-between items-start mb-4">
                        <span
                            class="inline-block px-3 py-1 border border-[#1a1a1a] text-[10px] font-bold uppercase bg-white tracking-wider">
                            {{ $product->category->name }}
                        </span>
                        <span class="font-mono text-xs text-gray-400">
                            CREATED: {{ $product->created_at->format('d M Y') }}
                        </span>
                    </div>

                    <h2 class="text-4xl font-black uppercase leading-none text-[#1a1a1a] mb-6">
                        {{ $product->name }}
                    </h2>

                    <div class="mb-2">
                        <span
                            class="text-[10px] font-bold uppercase tracking-[0.2em] text-gray-400 block mb-2">Description</span>
                        <p class="text-sm text-gray-800 leading-relaxed font-medium max-w-2xl">
                            {{ $product->description }}
                        </p>
                    </div>
                </div>

                {{-- Variant Table --}}
                <div class="p-0">
                    <div class="flex items-center justify-between p-4 bg-[#1a1a1a] text-white">
                        <h3 class="text-[10px] font-bold uppercase tracking-[0.2em]">Inventory Configuration</h3>
                        <span class="font-mono text-xs">{{ $product->variants->count() }} UNITS</span>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-gray-100 border-b border-[#1a1a1a]">
                                    <th class="py-3 px-6 text-[9px] font-bold uppercase tracking-wider text-gray-500 w-1/4">
                                        Color</th>
                                    <th class="py-3 px-6 text-[9px] font-bold uppercase tracking-wider text-gray-500 w-1/4">
                                        Size</th>
                                    <th
                                        class="py-3 px-6 text-[9px] font-bold uppercase tracking-wider text-gray-500 w-1/4 text-right">
                                        Stock</th>
                                    <th
                                        class="py-3 px-6 text-[9px] font-bold uppercase tracking-wider text-gray-500 w-1/4 text-right">
                                        Price</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach ($product->variants as $v)
                                    <tr class="hover:bg-red-50 transition-colors group">
                                        <td
                                            class="py-3 px-6 font-mono text-xs font-bold text-[#1a1a1a] uppercase group-hover:text-[#EB0000]">
                                            {{ $v->color }}
                                        </td>
                                        <td class="py-3 px-6 font-mono text-xs font-bold text-[#1a1a1a] uppercase">
                                            {{ $v->size }}
                                        </td>
                                        <td class="py-3 px-6 text-right">
                                            @if ($v->stock > 0)
                                                <span class="text-xs font-bold text-green-700 bg-green-100 px-2 py-0.5">
                                                    {{ $v->stock }}
                                                </span>
                                            @else
                                                <span class="text-[10px] font-bold text-white bg-[#EB0000] px-2 py-0.5">
                                                    OUT
                                                </span>
                                            @endif
                                        </td>
                                        <td class="py-3 px-6 text-right font-mono text-sm font-bold">
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
@endsection
