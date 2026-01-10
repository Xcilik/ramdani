@extends('layouts.admin')

@section('title', 'CATEGORY_INDEX_')

@section('content')
    <div class="max-w-full">

        {{-- HEADER SECTION --}}
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4 mb-8 border-b-2 border-[#1a1a1a] pb-6">
            <div>
                <span class="font-mono text-xs text-gray-400 mb-1 block">TAXONOMY // MASTER_DATA</span>
                <h1 class="text-3xl font-black uppercase tracking-tighter text-[#1a1a1a]">
                    Category List
                </h1>
            </div>

            <a href="{{ route('admin.categories.create') }}" 
               class="group relative inline-flex items-center justify-start px-6 py-3 overflow-hidden font-bold transition-all bg-[#1a1a1a] hover:bg-[#EB0000]">
                <span class="absolute top-0 right-0 inline-block w-4 h-4 transition-all duration-500 ease-in-out bg-[#333] group-hover:-mr-4 group-hover:-mt-4">
                    <span class="absolute top-0 right-0 w-5 h-5 rotate-45 translate-x-1/2 -translate-y-1/2 bg-white"></span>
                </span>
                <span class="relative w-full text-left text-white transition-colors duration-200 ease-in-out uppercase tracking-widest text-xs">
                    + New Category
                </span>
            </a>
        </div>

        {{-- FLASH MESSAGE (SYSTEM LOG STYLE) --}}
        @if (session('success'))
            <div class="mb-6 border border-[#1a1a1a] bg-gray-50 p-4 flex items-center gap-4 animate-pulse">
                <div class="w-3 h-3 bg-green-500"></div>
                <div>
                    <p class="text-[10px] font-bold uppercase tracking-widest text-gray-500">System Notification</p>
                    <p class="font-mono text-xs text-[#1a1a1a]">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        {{-- TABLE CONTAINER --}}
        <div class="border-2 border-[#1a1a1a] bg-white">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    {{-- TABLE HEAD --}}
                    <thead>
                        <tr class="border-b-2 border-[#1a1a1a] bg-[#F5F5F5]">
                            <th class="p-4 text-[10px] font-bold uppercase tracking-[0.2em] text-gray-500 border-r border-gray-300 w-16 text-center">
                                No
                            </th>
                            <th class="p-4 text-[10px] font-bold uppercase tracking-[0.2em] text-gray-500 border-r border-gray-300">
                                Category Name
                            </th>
                            <th class="p-4 text-[10px] font-bold uppercase tracking-[0.2em] text-gray-500 border-r border-gray-300">
                                Slug / Key
                            </th>
                            <th class="p-4 text-[10px] font-bold uppercase tracking-[0.2em] text-gray-500 text-right">
                                Actions
                            </th>
                        </tr>
                    </thead>

                    {{-- TABLE BODY --}}
                    <tbody class="text-sm">
                        @forelse ($categories as $category)
                            <tr class="border-b border-gray-200 hover:bg-gray-50 group transition-colors">
                                
                                {{-- NO --}}
                                <td class="p-4 border-r border-gray-100 text-center font-mono text-gray-400">
                                    {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                                </td>

                                {{-- NAME --}}
                                <td class="p-4 border-r border-gray-100">
                                    <span class="font-bold text-[#1a1a1a] uppercase text-lg group-hover:text-[#EB0000] transition-colors">
                                        {{ $category->name }}
                                    </span>
                                </td>

                                {{-- SLUG --}}
                                <td class="p-4 border-r border-gray-100">
                                    <span class="font-mono text-xs bg-gray-100 px-2 py-1 text-gray-600">
                                        /{{ $category->slug }}
                                    </span>
                                </td>

                                {{-- ACTIONS --}}
                                <td class="p-4 text-right">
                                    <div class="flex justify-end items-center gap-4">
                                        <a href="{{ route('admin.categories.edit', $category) }}" 
                                           class="text-[10px] font-bold uppercase tracking-wider text-gray-400 hover:text-[#1a1a1a] hover:underline decoration-2 underline-offset-4 transition-all">
                                            Edit
                                        </a>

                                        <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="return confirm('WARNING: Delete this category?')" 
                                                    class="text-[10px] font-bold uppercase tracking-wider text-[#EB0000] hover:bg-[#EB0000] hover:text-white px-2 py-1 transition-all">
                                                [ DEL ]
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="p-8 text-center border-b border-gray-200">
                                    <div class="flex flex-col items-center justify-center opacity-50">
                                        <div class="w-12 h-1 bg-[#1a1a1a] mb-2"></div>
                                        <span class="font-mono text-xs uppercase tracking-widest text-[#1a1a1a]">No Records Found</span>
                                        <span class="text-[10px] text-gray-400 mt-1">Initialize new category data to begin.</span>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- FOOTER STATUS --}}
            <div class="p-4 border-t-2 border-[#1a1a1a] bg-[#F5F5F5] flex justify-between items-center">
                <span class="font-mono text-[10px] text-gray-400">TOTAL CATEGORIES: {{ $categories->count() }}</span>
                <div class="w-2 h-2 bg-green-500 animate-pulse" title="System Active"></div>
            </div>
        </div>

    </div>
@endsection