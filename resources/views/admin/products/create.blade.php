@extends('layouts.admin')

@section('title', 'ADD NEW KICKS')

@section('content')
    <div class="min-h-screen bg-gray-50/50 pb-20 pt-8">
        
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- HEADER SECTION --}}
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8">
                <div>
                    <span class="text-xs font-semibold text-indigo-600 tracking-wider uppercase mb-1 block">Inventory Management</span>
                    <h1 class="text-3xl font-bold text-gray-800 tracking-tight">Add New Product</h1>
                </div>
                <a href="{{ route('admin.products.index') }}"
                    class="group flex items-center gap-2 text-sm font-medium text-gray-500 hover:text-gray-800 transition-colors">
                    <div class="w-8 h-8 rounded-full bg-white border border-gray-200 flex items-center justify-center group-hover:border-gray-400 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    </div>
                    Back to Inventory
                </a>
            </div>

            {{-- FORM CARD --}}
            <div class="bg-white rounded-2xl shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] border border-gray-100 overflow-hidden">
                
                <form method="POST" enctype="multipart/form-data" action="{{ route('admin.products.store') }}" class="p-8">
                    @csrf

                    {{-- SECTION 1: DETAILS --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">
                        
                        {{-- Product Name --}}
                        <div class="space-y-2">
                            <label class="text-sm font-semibold text-gray-700">Product Name</label>
                            <input name="name" type="text"
                                class="w-full px-4 py-3 rounded-xl bg-gray-50 border-transparent focus:bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 transition-all outline-none placeholder-gray-400 text-sm font-medium"
                                placeholder="e.g. Niken Air Jordan 1 High OG">
                        </div>

                        {{-- Category --}}
                        <div class="space-y-2">
                            <label class="text-sm font-semibold text-gray-700">Category</label>
                            <div class="relative">
                                <select name="category_id"
                                    class="w-full px-4 py-3 rounded-xl bg-gray-50 border-transparent focus:bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 transition-all outline-none appearance-none text-sm font-medium cursor-pointer">
                                    <option value="" class="text-gray-400">Select Collection...</option>
                                    @foreach ($categories as $c)
                                        <option value="{{ $c->id }}">{{ $c->name }}</option>
                                    @endforeach
                                </select>
                                <div class="absolute right-4 top-3.5 pointer-events-none text-gray-500">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </div>
                            </div>
                        </div>

                        {{-- Description --}}
                        <div class="col-span-1 md:col-span-2 space-y-2">
                            <label class="text-sm font-semibold text-gray-700">Description</label>
                            <textarea name="description" rows="4"
                                class="w-full px-4 py-3 rounded-xl bg-gray-50 border-transparent focus:bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 transition-all outline-none placeholder-gray-400 text-sm resize-none"
                                placeholder="Describe the material, fit, and story behind the kicks..."></textarea>
                        </div>
                    </div>

                    <hr class="border-gray-100 mb-10">

                    {{-- SECTION 2: IMAGES --}}
                    <div class="mb-10">
                        <div class="flex items-center justify-between mb-4">
                            <label class="text-sm font-semibold text-gray-700">Product Gallery</label>
                            <span class="text-xs text-gray-400">Max 5MB per image</span>
                        </div>
                        
                        {{-- Upload Area --}}
                        <div class="relative border-2 border-dashed border-gray-300 hover:border-indigo-500 hover:bg-indigo-50/30 rounded-2xl p-8 text-center transition-all group cursor-pointer">
                            <input type="file" name="images[]" id="imageInput" multiple onchange="previewImages(event)"
                                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                            
                            <div class="flex flex-col items-center justify-center space-y-3 pointer-events-none">
                                <div class="w-12 h-12 rounded-full bg-gray-100 text-gray-400 flex items-center justify-center group-hover:bg-indigo-100 group-hover:text-indigo-600 transition-colors">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-700"><span class="text-indigo-600">Click to upload</span> or drag and drop</p>
                                    <p class="text-xs text-gray-400 mt-1">SVG, PNG, JPG or GIF (max. 800x400px)</p>
                                </div>
                            </div>
                        </div>

                        {{-- Preview Grid --}}
                        <div id="image-preview-container" class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-6 hidden">
                            </div>
                    </div>

                    <hr class="border-gray-100 mb-10">

                    {{-- SECTION 3: VARIANTS --}}
                    <div>
                        <div class="flex justify-between items-center mb-6">
                            <div>
                                <h3 class="text-lg font-bold text-gray-800">Variants & Stock</h3>
                                <p class="text-xs text-gray-400">Manage sizes, colors and inventory levels.</p>
                            </div>
                            <button type="button" onclick="addVariant()"
                                class="text-xs font-bold text-indigo-600 bg-indigo-50 hover:bg-indigo-100 px-4 py-2 rounded-lg transition-colors flex items-center gap-1">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                Add Variant
                            </button>
                        </div>

                        {{-- Variants Header --}}
                        <div class="grid grid-cols-12 gap-4 mb-3 px-1">
                            <div class="col-span-3 text-xs font-semibold uppercase text-gray-400 tracking-wider">Color</div>
                            <div class="col-span-3 text-xs font-semibold uppercase text-gray-400 tracking-wider">Size</div>
                            <div class="col-span-3 text-xs font-semibold uppercase text-gray-400 tracking-wider">Price</div>
                            <div class="col-span-2 text-xs font-semibold uppercase text-gray-400 tracking-wider">Stock</div>
                            <div class="col-span-1"></div>
                        </div>

                        <div id="variant-wrapper" class="space-y-3">
                            {{-- Default Row --}}
                            <div class="grid grid-cols-12 gap-4 variant-item">
                                <div class="col-span-3">
                                    <input name="variants[0][color]" placeholder="Red"
                                        class="w-full px-3 py-2 rounded-lg bg-gray-50 border-transparent focus:bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 outline-none text-sm transition-all">
                                </div>
                                <div class="col-span-3">
                                    <input name="variants[0][size]" placeholder="42"
                                        class="w-full px-3 py-2 rounded-lg bg-gray-50 border-transparent focus:bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 outline-none text-sm transition-all">
                                </div>
                                <div class="col-span-3">
                                    <div class="relative">
                                        <span class="absolute left-3 top-2 text-gray-400 text-sm">Rp</span>
                                        <input name="variants[0][price]" placeholder="0" type="number"
                                            class="w-full pl-8 pr-3 py-2 rounded-lg bg-gray-50 border-transparent focus:bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 outline-none text-sm transition-all">
                                    </div>
                                </div>
                                <div class="col-span-2">
                                    <input name="variants[0][stock]" placeholder="0" type="number"
                                        class="w-full px-3 py-2 rounded-lg bg-gray-50 border-transparent focus:bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 outline-none text-sm transition-all">
                                </div>
                                <div class="col-span-1 flex items-center justify-center">
                                    <button type="button" onclick="removeVariant(this)"
                                        class="text-gray-400 hover:text-red-500 p-2 rounded-full hover:bg-red-50 transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- SUBMIT BUTTON --}}
                    <div class="pt-10 mt-6 flex justify-end">
                        <button class="px-8 py-3 bg-[#111] text-white text-sm font-bold rounded-xl hover:bg-black hover:shadow-lg hover:shadow-gray-200 transition-all transform hover:-translate-y-0.5 flex items-center gap-2">
                            <span>Publish Product</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    {{-- SCRIPT --}}
    <script>
        let variantIndex = 1;

        function addVariant() {
            const wrapper = document.getElementById('variant-wrapper');
            // Stylenya disamakan dengan inputan form diatas (rounded-lg, soft focus ring)
            const html = `
                <div class="grid grid-cols-12 gap-4 variant-item animate-fade-in">
                    <div class="col-span-3">
                        <input name="variants[${variantIndex}][color]" placeholder="Color" class="w-full px-3 py-2 rounded-lg bg-gray-50 border-transparent focus:bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 outline-none text-sm transition-all">
                    </div>
                    <div class="col-span-3">
                        <input name="variants[${variantIndex}][size]" placeholder="Size" class="w-full px-3 py-2 rounded-lg bg-gray-50 border-transparent focus:bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 outline-none text-sm transition-all">
                    </div>
                    <div class="col-span-3">
                        <div class="relative">
                            <span class="absolute left-3 top-2 text-gray-400 text-sm">Rp</span>
                            <input name="variants[${variantIndex}][price]" placeholder="0" type="number" class="w-full pl-8 pr-3 py-2 rounded-lg bg-gray-50 border-transparent focus:bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 outline-none text-sm transition-all">
                        </div>
                    </div>
                    <div class="col-span-2">
                        <input name="variants[${variantIndex}][stock]" placeholder="0" type="number" class="w-full px-3 py-2 rounded-lg bg-gray-50 border-transparent focus:bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 outline-none text-sm transition-all">
                    </div>
                    <div class="col-span-1 flex items-center justify-center">
                        <button type="button" onclick="removeVariant(this)" class="text-gray-400 hover:text-red-500 p-2 rounded-full hover:bg-red-50 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
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

        function previewImages(event) {
            const previewContainer = document.getElementById('image-preview-container');
            previewContainer.innerHTML = ''; 

            const files = event.target.files;

            if (files.length > 0) {
                previewContainer.classList.remove('hidden');

                Array.from(files).forEach(file => {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        // Styling preview image agar rounded dan shadow halus
                        const html = `
                            <div class="relative group rounded-xl overflow-hidden border border-gray-200 shadow-sm">
                                <div class="absolute top-2 right-2 bg-indigo-500 text-white text-[10px] font-bold px-2 py-1 rounded-full z-10 opacity-90">
                                    PENDING
                                </div>
                                
                                <div class="h-32 w-full bg-gray-100">
                                     <img src="${e.target.result}" class="w-full h-full object-cover">
                                </div>

                                <div class="p-3 bg-white">
                                    <p class="text-xs font-medium text-gray-700 truncate">
                                        ${file.name}
                                    </p>
                                     <p class="text-[10px] text-gray-400 mt-0.5">
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