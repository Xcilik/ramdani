@extends('layouts.admin')

@section('title', 'EDIT KICKS')

@section('content')
    <div class="min-h-screen bg-gray-50/50 pb-20 pt-8">
        
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- HEADER SECTION --}}
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8">
                <div>
                    <div class="flex items-center gap-2 mb-1">
                        <span class="text-xs font-semibold text-indigo-600 tracking-wider uppercase">Edit Mode</span>
                        <span class="text-xs text-gray-400 font-mono">ID: {{ substr(md5($product->id), 0, 8) }}</span>
                    </div>
                    <h1 class="text-3xl font-bold text-gray-800 tracking-tight">Update Product</h1>
                </div>
                <a href="{{ route('admin.products.index') }}"
                    class="group flex items-center gap-2 text-sm font-medium text-gray-500 hover:text-gray-800 transition-colors">
                    <div class="w-8 h-8 rounded-full bg-white border border-gray-200 flex items-center justify-center group-hover:border-gray-400 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    </div>
                    Cancel & Return
                </a>
            </div>

            {{-- FORM CARD --}}
            <div class="bg-white rounded-2xl shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] border border-gray-100 overflow-hidden">
                
                <form method="POST" 
                      enctype="multipart/form-data" 
                      action="{{ route('admin.products.update', $product) }}" 
                      class="p-8">
                    @csrf
                    @method('PUT')

                    {{-- SECTION 1: DETAILS --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">
                        
                        {{-- Product Name --}}
                        <div class="space-y-2">
                            <label class="text-sm font-semibold text-gray-700">Product Name</label>
                            <input name="name" type="text" value="{{ $product->name }}"
                                class="w-full px-4 py-3 rounded-xl bg-gray-50 border-transparent focus:bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 transition-all outline-none placeholder-gray-400 text-sm font-medium">
                        </div>

                        {{-- Category --}}
                        <div class="space-y-2">
                            <label class="text-sm font-semibold text-gray-700">Category</label>
                            <div class="relative">
                                <select name="category_id"
                                    class="w-full px-4 py-3 rounded-xl bg-gray-50 border-transparent focus:bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 transition-all outline-none appearance-none text-sm font-medium cursor-pointer">
                                    @foreach ($categories as $c)
                                        <option value="{{ $c->id }}" @selected($product->category_id == $c->id)>
                                            {{ $c->name }}
                                        </option>
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
                                class="w-full px-4 py-3 rounded-xl bg-gray-50 border-transparent focus:bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 transition-all outline-none placeholder-gray-400 text-sm resize-none">{{ $product->description }}</textarea>
                        </div>
                    </div>

                    <hr class="border-gray-100 mb-10">

                    {{-- SECTION 2: IMAGES --}}
                    <div class="mb-10">
                        <div class="flex items-center justify-between mb-4">
                            <label class="text-sm font-semibold text-gray-700">Image Management</label>
                        </div>

                        {{-- A. Existing Images (Delete Mode) --}}
                        @if($product->images->count() > 0)
                            <div class="mb-6">
                                <p class="text-xs text-gray-500 mb-3 font-medium uppercase tracking-wide">Current Images (Select to Delete)</p>
                                <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
                                    @foreach($product->images as $img)
                                        <div class="relative group rounded-xl overflow-hidden border border-gray-200">
                                            <img src="{{ asset('storage/'.$img->image) }}" class="w-full h-24 object-cover">
                                            
                                            {{-- Overlay Checkbox --}}
                                            <label class="absolute inset-0 bg-white/80 opacity-0 group-hover:opacity-100 transition-all cursor-pointer flex flex-col items-center justify-center backdrop-blur-sm">
                                                <input type="checkbox" name="delete_images[]" value="{{ $img->id }}" class="peer sr-only">
                                                <div class="w-8 h-8 rounded-full bg-gray-100 text-gray-400 peer-checked:bg-red-500 peer-checked:text-white flex items-center justify-center transition-colors shadow-sm">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                </div>
                                                <span class="text-[10px] font-bold text-gray-600 mt-2 peer-checked:text-red-500 uppercase tracking-wide">Remove</span>
                                            </label>
                                            
                                            {{-- Status badge if checked (Visual trick requires JS or Peer checked logic above covers it) --}}
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        
                        {{-- B. Upload New Images --}}
                        <div>
                            <p class="text-xs text-gray-500 mb-3 font-medium uppercase tracking-wide">Upload New Images</p>
                            <div class="relative border-2 border-dashed border-gray-300 hover:border-indigo-500 hover:bg-indigo-50/30 rounded-2xl p-6 text-center transition-all group cursor-pointer">
                                <input type="file" name="images[]" id="imageInput" multiple onchange="previewImages(event)"
                                    class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                                
                                <div class="flex flex-col items-center justify-center space-y-2 pointer-events-none">
                                    <div class="w-10 h-10 rounded-full bg-gray-100 text-gray-400 flex items-center justify-center group-hover:bg-indigo-100 group-hover:text-indigo-600 transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                    </div>
                                    <p class="text-xs font-medium text-gray-600">Add more photos</p>
                                </div>
                            </div>

                            {{-- Preview for NEW images --}}
                            <div id="image-preview-container" class="grid grid-cols-2 md:grid-cols-5 gap-4 mt-4 hidden"></div>
                        </div>
                    </div>

                    <hr class="border-gray-100 mb-10">

                    {{-- SECTION 3: VARIANTS --}}
                    <div>
                        <div class="flex justify-between items-center mb-6">
                            <div>
                                <h3 class="text-lg font-bold text-gray-800">Variants & Stock</h3>
                                <p class="text-xs text-gray-400">Update sizes, prices and inventory.</p>
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
                            @foreach($product->variants as $i => $v)
                            <div class="grid grid-cols-12 gap-4 variant-item group">
                                {{-- HIDDEN ID IS CRUCIAL FOR UPDATING --}}
                                <input type="hidden" name="variants[{{ $i }}][id]" value="{{ $v->id }}">

                                <div class="col-span-3">
                                    <input name="variants[{{ $i }}][color]" value="{{ $v->color }}"
                                        class="w-full px-3 py-2 rounded-lg bg-gray-50 border-transparent focus:bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 outline-none text-sm transition-all">
                                </div>
                                <div class="col-span-3">
                                    <input name="variants[{{ $i }}][size]" value="{{ $v->size }}"
                                        class="w-full px-3 py-2 rounded-lg bg-gray-50 border-transparent focus:bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 outline-none text-sm transition-all">
                                </div>
                                <div class="col-span-3">
                                    <input name="variants[{{ $i }}][price]" value="{{ $v->price }}" type="number"
                                        class="w-full px-3 py-2 rounded-lg bg-gray-50 border-transparent focus:bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 outline-none text-sm transition-all">
                                </div>
                                <div class="col-span-2">
                                    <input name="variants[{{ $i }}][stock]" value="{{ $v->stock }}" type="number"
                                        class="w-full px-3 py-2 rounded-lg bg-gray-50 border-transparent focus:bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 outline-none text-sm transition-all">
                                </div>
                                <div class="col-span-1 flex items-center justify-center">
                                    {{-- Optional: Add Delete logic for specific variant ID if needed by backend --}}
                                    <button type="button" onclick="removeVariant(this)"
                                        class="text-gray-400 hover:text-red-500 p-2 rounded-full hover:bg-red-50 transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- SUBMIT BUTTON --}}
                    <div class="pt-10 mt-6 flex justify-end">
                        <button class="px-8 py-3 bg-[#111] text-white text-sm font-bold rounded-xl hover:bg-black hover:shadow-lg hover:shadow-gray-200 transition-all transform hover:-translate-y-0.5 flex items-center gap-2">
                            <span>Save Changes</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    {{-- SCRIPT --}}
    <script>
        // Start index from the current count to avoid collision
        let variantIndex = {{ $product->variants->count() }};

        function addVariant() {
            const wrapper = document.getElementById('variant-wrapper');
            const html = `
                <div class="grid grid-cols-12 gap-4 variant-item animate-fade-in">
                    <div class="col-span-3">
                        <input name="variants[${variantIndex}][color]" placeholder="Color" class="w-full px-3 py-2 rounded-lg bg-gray-50 border-transparent focus:bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 outline-none text-sm transition-all">
                    </div>
                    <div class="col-span-3">
                        <input name="variants[${variantIndex}][size]" placeholder="Size" class="w-full px-3 py-2 rounded-lg bg-gray-50 border-transparent focus:bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 outline-none text-sm transition-all">
                    </div>
                    <div class="col-span-3">
                        <input name="variants[${variantIndex}][price]" placeholder="Price" type="number" class="w-full px-3 py-2 rounded-lg bg-gray-50 border-transparent focus:bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 outline-none text-sm transition-all">
                    </div>
                    <div class="col-span-2">
                        <input name="variants[${variantIndex}][stock]" placeholder="Stock" type="number" class="w-full px-3 py-2 rounded-lg bg-gray-50 border-transparent focus:bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 outline-none text-sm transition-all">
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
            // Note: If deleting an existing variant, you might need to handle ID tracking for backend deletion
            // For now, this just removes the row from the DOM
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
                        const html = `
                            <div class="relative group rounded-xl overflow-hidden border border-gray-200 shadow-sm animate-fade-in">
                                <div class="absolute top-1 right-1 bg-green-500 text-white text-[9px] font-bold px-1.5 py-0.5 rounded-full z-10">NEW</div>
                                <div class="h-24 w-full bg-gray-100">
                                     <img src="${e.target.result}" class="w-full h-full object-cover">
                                </div>
                                <div class="p-2 bg-white text-center">
                                    <p class="text-[10px] font-medium text-gray-600 truncate">${file.name}</p>
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