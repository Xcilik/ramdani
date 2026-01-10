@extends('layouts.admin')

@section('title', 'NEW_CATEGORY_')

@section('content')
<div class="max-w-md mx-auto mt-10">
    
    {{-- HEADER --}}
    <div class="mb-6 border-b-2 border-[#1a1a1a] pb-2">
        <span class="font-mono text-xs text-gray-400 block mb-1">TAXONOMY // WRITE_MODE</span>
        <h1 class="text-2xl font-black uppercase tracking-tighter text-[#1a1a1a]">
            Add Category
        </h1>
    </div>

    {{-- FORM CONTAINER --}}
    <div class="border-2 border-[#1a1a1a] bg-white p-8 relative shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">
        {{-- Decorative Corner --}}
        <div class="absolute top-0 right-0 w-4 h-4 bg-[#1a1a1a]"></div>

        <form method="POST" action="{{ route('admin.categories.store') }}" class="space-y-8">
            @csrf

            {{-- Input Field --}}
            <div class="space-y-2">
                <label class="text-[10px] font-bold uppercase tracking-[0.2em] text-gray-500">
                    Category Name
                </label>
                <input type="text" 
                       name="name" 
                       placeholder="ENTER_NAME" 
                       class="w-full bg-[#F5F5F5] border-b-2 border-[#1a1a1a] p-3 font-mono text-sm focus:outline-none focus:bg-[#1a1a1a] focus:text-white focus:placeholder-gray-500 transition-colors placeholder-gray-400 uppercase"
                       required
                       autofocus>
                
                @error('name')
                    <div class="flex items-center gap-2 mt-2 text-[#EB0000]">
                        <span class="text-lg font-bold">!</span>
                        <p class="text-[10px] font-bold uppercase tracking-wide">{{ $message }}</p>
                    </div>
                @enderror
            </div>

            {{-- Action Buttons --}}
            <div class="pt-4 flex flex-col gap-3">
                <button type="submit" class="w-full bg-[#1a1a1a] text-white py-3 text-xs font-black uppercase tracking-[0.2em] hover:bg-[#EB0000] transition-colors flex justify-center items-center gap-2 group">
                    <span>Save Data</span>
                    <svg class="w-3 h-3 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="square" stroke-linejoin="miter" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </button>

                <a href="{{ route('admin.categories.index') }}" class="text-center text-[10px] font-bold uppercase tracking-widest text-gray-400 hover:text-[#1a1a1a] decoration-2 underline underline-offset-4 transition-colors">
                    Cancel & Return
                </a>
            </div>
        </form>
    </div>
</div>
@endsection