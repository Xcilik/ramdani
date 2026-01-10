@extends('layouts.admin')

@section('title', 'PRODUCT_LIST_')

@section('content')
    <div class="max-w-full">
        
        {{-- HEADER SECTION --}}
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4 mb-8 border-b-2 border-[#1a1a1a] pb-6">
            <div>
                <span class="font-mono text-xs text-gray-400 mb-1 block">DATABASE_VIEW</span>
                <h1 class="text-3xl font-black uppercase tracking-tighter text-[#1a1a1a]">
                    Data Product
                </h1>
            </div>

            <a href="{{ route('admin.products.create') }}" 
               class="group relative inline-flex items-center justify-start px-6 py-3 overflow-hidden font-bold transition-all bg-[#1a1a1a] hover:bg-[#EB0000]">
                <span class="absolute top-0 right-0 inline-block w-4 h-4 transition-all duration-500 ease-in-out bg-[#333] group-hover:-mr-4 group-hover:-mt-4">
                    <span class="absolute top-0 right-0 w-5 h-5 rotate-45 translate-x-1/2 -translate-y-1/2 bg-white"></span>
                </span>
                <span class="relative w-full text-left text-white transition-colors duration-200 ease-in-out uppercase tracking-widest text-xs">
                    + New Entry
                </span>
            </a>
        </div>

        {{-- TABLE CONTAINER --}}
        <div class="border-2 border-[#1a1a1a] bg-white">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    {{-- TABLE HEAD --}}
                    <thead>
                        <tr class="border-b-2 border-[#1a1a1a] bg-[#F5F5F5]">
                            <th class="p-4 text-[10px] font-bold uppercase tracking-[0.2em] text-gray-500 border-r border-gray-300 w-1/3">
                                Product Name
                            </th>
                            <th class="p-4 text-[10px] font-bold uppercase tracking-[0.2em] text-gray-500 border-r border-gray-300">
                                Category
                            </th>
                            <th class="p-4 text-[10px] font-bold uppercase tracking-[0.2em] text-gray-500 border-r border-gray-300">
                                Variant
                            </th>
                            <th class="p-4 text-[10px] font-bold uppercase tracking-[0.2em] text-gray-500 text-right">
                                Actions
                            </th>
                        </tr>
                    </thead>

                    {{-- TABLE BODY --}}
                    <tbody class="text-sm">
                        @foreach($products as $product)
                        <tr class="border-b border-gray-200 hover:bg-gray-50 group transition-colors">
                            
                            {{-- NAME COLUMN --}}
                            <td class="p-4 border-r border-gray-100">
                                <div class="flex items-center gap-3">
                                    <div class="w-2 h-2 bg-[#1a1a1a] group-hover:bg-[#EB0000] transition-colors"></div>
                                    <div>
                                        <p class="font-bold text-[#1a1a1a] uppercase leading-none mb-1">
                                            {{ $product->name }}
                                        </p>
                                        <p class="font-mono text-[10px] text-gray-400">ID: {{ substr(md5($product->id), 0, 8) }}</p>
                                    </div>
                                </div>
                            </td>

                            {{-- CATEGORY COLUMN --}}
                            <td class="p-4 border-r border-gray-100">
                                <span class="px-2 py-1 border border-[#1a1a1a] text-[10px] font-bold uppercase bg-white">
                                    {{ $product->category->name }}
                                </span>
                            </td>

                            {{-- VARIANT COLUMN --}}
                            <td class="p-4 border-r border-gray-100">
                                <span class="font-mono font-bold text-lg text-[#1a1a1a]">
                                    {{ str_pad($product->variants->count(), 2, '0', STR_PAD_LEFT) }}
                                </span>
                            </td>

                            {{-- ACTION COLUMN --}}
                            <td class="p-4 text-right">
                                <div class="flex justify-end items-center gap-4">
                                    <a href="{{ route('admin.products.show',$product) }}" 
                                       class="text-[10px] font-bold uppercase tracking-wider text-gray-400 hover:text-[#1a1a1a] hover:underline decoration-2 underline-offset-4 transition-all">
                                        View
                                    </a>
                                    
                                    <a href="{{ route('admin.products.edit',$product) }}" 
                                       class="text-[10px] font-bold uppercase tracking-wider text-gray-400 hover:text-[#1a1a1a] hover:underline decoration-2 underline-offset-4 transition-all">
                                        Edit
                                    </a>

                                    <form method="POST" action="{{ route('admin.products.destroy',$product) }}" class="inline-block">
                                        @csrf @method('DELETE')
                                        <button onclick="return confirm('Confirm Deletion?')" 
                                                class="text-[10px] font-bold uppercase tracking-wider text-[#EB0000] hover:bg-[#EB0000] hover:text-white px-2 py-1 transition-all">
                                            [ DEL ]
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- FOOTER / PAGINATION PLACEHOLDER --}}
            <div class="p-4 border-t-2 border-[#1a1a1a] bg-[#F5F5F5] flex justify-between items-center">
                <span class="font-mono text-[10px] text-gray-400">TOTAL: {{ $products->count() }} RECORDS</span>
                <div class="flex gap-1">
                    <button class="w-8 h-8 border border-[#1a1a1a] bg-white hover:bg-[#1a1a1a] hover:text-white flex items-center justify-center transition-colors font-mono text-xs"><</button>
                    <button class="w-8 h-8 border border-[#1a1a1a] bg-[#1a1a1a] text-white flex items-center justify-center font-mono text-xs">1</button>
                    <button class="w-8 h-8 border border-[#1a1a1a] bg-white hover:bg-[#1a1a1a] hover:text-white flex items-center justify-center transition-colors font-mono text-xs">></button>
                </div>
            </div>
        </div>
    </div>
@endsection