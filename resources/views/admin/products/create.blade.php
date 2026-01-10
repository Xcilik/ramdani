@extends('layouts.admin')

@section('title', 'NEW_ENTRY_')

@section('content')
    <div class="max-w-4xl mx-auto">

        {{-- HEADER --}}
        <div class="mb-8 border-b-2 border-[#1a1a1a] pb-4 flex justify-between items-end">
            <div>
                <span class="font-mono text-xs text-gray-400 block mb-1">INVENTORY_CONTROL // WRITE</span>
                <h1 class="text-3xl font-black uppercase tracking-tighter text-[#1a1a1a] leading-none">
                    Add New Product
                </h1>
            </div>
            <a href="{{ route('admin.products.index') }}"
                class="text-[10px] font-bold uppercase tracking-widest hover:text-[#EB0000] decoration-2 underline underline-offset-4">
                < Back to List </a>
        </div>

        {{-- FORM CONTAINER --}}
        <div class="border-2 border-[#1a1a1a] bg-white p-8 relative">
            {{-- Decorative Corner --}}
            <div class="absolute top-0 right-0 w-4 h-4 bg-[#1a1a1a]"></div>

            <form method="POST" enctype="multipart/form-data" action="{{ route('admin.products.store') }}" class="space-y-8">
                @csrf

                {{-- SECTION 1: GENERAL INFO --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    {{-- Product Name --}}
                    <div class="space-y-2">
                        <label class="text-[10px] font-bold uppercase tracking-[0.2em] text-gray-500">Product Name</label>
                        <input name="name"
                            class="w-full bg-[#F5F5F5] border-b-2 border-[#1a1a1a] p-3 font-mono text-sm focus:outline-none focus:bg-[#1a1a1a] focus:text-white focus:placeholder-gray-500 transition-colors placeholder-gray-400"
                            placeholder="ENTER_PRODUCT_NAME">
                    </div>

                    {{-- Category --}}
                    <div class="space-y-2">
                        <label class="text-[10px] font-bold uppercase tracking-[0.2em] text-gray-500">Category</label>
                        <div class="relative">
                            <select name="category_id"
                                class="w-full bg-[#F5F5F5] border-b-2 border-[#1a1a1a] p-3 font-mono text-sm appearance-none focus:outline-none cursor-pointer">
                                <option value="">-- SELECT_CATEGORY --</option>
                                @foreach ($categories as $c)
                                    <option value="{{ $c->id }}">{{ $c->name }}</option>
                                @endforeach
                            </select>
                            <div class="absolute right-3 top-4 pointer-events-none">
                                <svg class="w-3 h-3 text-[#1a1a1a]" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="square" stroke-linejoin="miter" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Description --}}
                <div class="space-y-2">
                    <label class="text-[10px] font-bold uppercase tracking-[0.2em] text-gray-500">Description</label>
                    <textarea name="description" rows="4"
                        class="w-full bg-[#F5F5F5] border-b-2 border-[#1a1a1a] p-3 font-mono text-sm focus:outline-none focus:bg-[#1a1a1a] focus:text-white transition-colors placeholder-gray-400 resize-none"
                        placeholder="WRITE_DESCRIPTION_HERE..."></textarea>
                </div>

                {{-- Images Input Area (UPDATED) --}}
                <div class="space-y-2">
                    <label class="text-[10px] font-bold uppercase tracking-[0.2em] text-gray-500">Product Images</label>

                    {{-- Input Box --}}
                    <div
                        class="relative border-2 border-dashed border-gray-300 hover:border-[#1a1a1a] bg-[#F5F5F5] p-6 text-center transition-colors group cursor-pointer">
                        <input type="file" name="images[]" id="imageInput" multiple onchange="previewImages(event)"
                            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">

                        <div class="space-y-1 pointer-events-none">
                            <p class="text-xs font-bold uppercase text-gray-500 group-hover:text-[#1a1a1a]">Click or Drag to
                                Upload</p>
                            <p class="font-mono text-[10px] text-gray-400">MAX_SIZE: 5MB // FORMAT: JPG, PNG</p>
                        </div>
                    </div>

                    {{-- Preview Container (NEW) --}}
                    <div id="image-preview-container" class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-4 hidden">
                    </div>
                </div>

                {{-- SECTION 2: VARIANTS --}}
                <div class="pt-8 border-t-2 border-[#1a1a1a]">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-black uppercase tracking-tighter">Variant Configuration</h3>

                        <button type="button" onclick="addVariant()"
                            class="text-[10px] font-bold uppercase tracking-widest border border-[#1a1a1a] px-4 py-2 hover:bg-[#1a1a1a] hover:text-white transition-colors">
                            + Add Row
                        </button>
                    </div>

                    {{-- Header Row for Variants --}}
                    <div class="grid grid-cols-12 gap-2 mb-2 px-2">
                        <div class="col-span-3 text-[9px] font-bold uppercase text-gray-400">Color</div>
                        <div class="col-span-3 text-[9px] font-bold uppercase text-gray-400">Size</div>
                        <div class="col-span-3 text-[9px] font-bold uppercase text-gray-400">Price (IDR)</div>
                        <div class="col-span-2 text-[9px] font-bold uppercase text-gray-400">Stock</div>
                        <div class="col-span-1 text-[9px] font-bold uppercase text-gray-400 text-center">Act</div>
                    </div>

                    <div id="variant-wrapper" class="space-y-2">
                        {{-- Default Row --}}
                        <div class="grid grid-cols-12 gap-2 variant-item group">
                            <div class="col-span-3">
                                <input name="variants[0][color]" placeholder="RED"
                                    class="w-full bg-gray-50 border border-gray-300 p-2 font-mono text-xs focus:border-[#1a1a1a] focus:bg-white focus:outline-none uppercase">
                            </div>
                            <div class="col-span-3">
                                <input name="variants[0][size]" placeholder="XL"
                                    class="w-full bg-gray-50 border border-gray-300 p-2 font-mono text-xs focus:border-[#1a1a1a] focus:bg-white focus:outline-none uppercase">
                            </div>
                            <div class="col-span-3">
                                <input name="variants[0][price]" placeholder="0" type="number"
                                    class="w-full bg-gray-50 border border-gray-300 p-2 font-mono text-xs focus:border-[#1a1a1a] focus:bg-white focus:outline-none">
                            </div>
                            <div class="col-span-2">
                                <input name="variants[0][stock]" placeholder="0" type="number"
                                    class="w-full bg-gray-50 border border-gray-300 p-2 font-mono text-xs focus:border-[#1a1a1a] focus:bg-white focus:outline-none">
                            </div>
                            <div class="col-span-1 flex justify-center">
                                <button type="button" onclick="removeVariant(this)"
                                    class="w-full h-full bg-gray-200 text-gray-500 hover:bg-[#EB0000] hover:text-white font-mono text-xs transition-colors">
                                    X
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- SUBMIT AREA --}}
                <div class="pt-6 mt-6">
                    <button
                        class="w-full bg-[#1a1a1a] text-white py-4 text-sm font-black uppercase tracking-[0.2em] hover:bg-[#EB0000] transition-colors flex justify-center items-center gap-2 group">
                        <span>Confirm Data Entry</span>
                        <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="square" stroke-linejoin="miter" stroke-width="2"
                                d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- SCRIPT --}}
    <script>
        // === LOGIKA VARIANT ===
        let variantIndex = 1;

        function addVariant() {
            const wrapper = document.getElementById('variant-wrapper');
            const html = `
        <div class="grid grid-cols-12 gap-2 variant-item group">
            <div class="col-span-3">
                <input name="variants[${variantIndex}][color]" placeholder="COLOR" class="w-full bg-gray-50 border border-gray-300 p-2 font-mono text-xs focus:border-[#1a1a1a] focus:bg-white focus:outline-none uppercase">
            </div>
            <div class="col-span-3">
                <input name="variants[${variantIndex}][size]" placeholder="SIZE" class="w-full bg-gray-50 border border-gray-300 p-2 font-mono text-xs focus:border-[#1a1a1a] focus:bg-white focus:outline-none uppercase">
            </div>
            <div class="col-span-3">
                <input name="variants[${variantIndex}][price]" placeholder="0" type="number" class="w-full bg-gray-50 border border-gray-300 p-2 font-mono text-xs focus:border-[#1a1a1a] focus:bg-white focus:outline-none">
            </div>
            <div class="col-span-2">
                <input name="variants[${variantIndex}][stock]" placeholder="0" type="number" class="w-full bg-gray-50 border border-gray-300 p-2 font-mono text-xs focus:border-[#1a1a1a] focus:bg-white focus:outline-none">
            </div>
            <div class="col-span-1 flex justify-center">
                <button type="button" onclick="removeVariant(this)" class="w-full h-full bg-gray-200 text-gray-500 hover:bg-[#EB0000] hover:text-white font-mono text-xs transition-colors">
                    X
                </button>
            </div>
        </div>
    `;
            wrapper.insertAdjacentHTML('beforeend', html);
            variantIndex++;
        }

        function removeVariant(button) {
            button.closest('.variant-item').remove();
        }

        // === LOGIKA IMAGE PREVIEW (BARU) ===
        function previewImages(event) {
            const previewContainer = document.getElementById('image-preview-container');
            previewContainer.innerHTML = ''; // Reset preview lama

            const files = event.target.files;

            if (files.length > 0) {
                previewContainer.classList.remove('hidden'); // Tampilkan container

                // Loop setiap file yang dipilih
                Array.from(files).forEach(file => {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        const html = `
                    <div class="border border-[#1a1a1a] bg-white p-2 relative group animate-fade-in">
                        {{-- Badge 'PENDING' --}}
                        <div class="absolute top-0 right-0 bg-[#EB0000] text-white text-[8px] font-bold px-1 py-0.5 z-10">
                            PENDING
                        </div>
                        
                        {{-- Image --}}
                        <div class="overflow-hidden h-24 w-full border border-gray-200 mb-2">
                             <img src="${e.target.result}" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-300">
                        </div>

                        {{-- Filename (Technical Look) --}}
                        <div class="border-t border-gray-200 pt-1">
                            <p class="text-[9px] font-mono text-gray-500 truncate uppercase">
                                ${file.name}
                            </p>
                             <p class="text-[8px] font-mono text-gray-400">
                                ${(file.size / 1024).toFixed(1)} KB
                            </p>
                        </div>
                    </div>
                `;
                        previewContainer.insertAdjacentHTML('beforeend', html);
                    }

                    reader.readAsDataURL(file);
                });
            } else {
                previewContainer.classList.add('hidden');
            }
        }
    </script>
@endsection
