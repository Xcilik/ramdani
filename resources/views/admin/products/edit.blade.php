@extends('layouts.admin')

@section('title', 'EDIT_ENTRY_')

@section('content')
<div class="max-w-4xl mx-auto">

    {{-- HEADER SECTION --}}
    <div class="mb-8 border-b-2 border-[#1a1a1a] pb-4 flex justify-between items-end">
        <div>
            <span class="font-mono text-xs text-gray-400 block mb-1">INVENTORY_CONTROL // UPDATE // ID: {{ substr(md5($product->id), 0, 8) }}</span>
            <h1 class="text-3xl font-black uppercase tracking-tighter text-[#1a1a1a] leading-none">
                Edit Product
            </h1>
        </div>
        <a href="{{ route('admin.products.index') }}" class="text-[10px] font-bold uppercase tracking-widest hover:text-[#EB0000] decoration-2 underline underline-offset-4">
            < Cancel & Return
        </a>
    </div>

    {{-- MAIN FORM CONTAINER --}}
    <div class="border-2 border-[#1a1a1a] bg-white p-8 relative">
        {{-- Decorative Corner --}}
        <div class="absolute top-0 right-0 w-4 h-4 bg-[#1a1a1a]"></div>

        <form method="POST"
              enctype="multipart/form-data"
              action="{{ route('admin.products.update', $product) }}"
              class="space-y-8">
            @csrf
            @method('PUT')

            {{-- SECTION 1: GENERAL INFO --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                {{-- Nama --}}
                <div class="space-y-2">
                    <label class="text-[10px] font-bold uppercase tracking-[0.2em] text-gray-500">Product Name</label>
                    <input name="name"
                           value="{{ $product->name }}"
                           class="w-full bg-[#F5F5F5] border-b-2 border-[#1a1a1a] p-3 font-mono text-sm focus:outline-none focus:bg-[#1a1a1a] focus:text-white transition-colors"
                           placeholder="PRODUCT_NAME">
                </div>

                {{-- Kategori --}}
                <div class="space-y-2">
                    <label class="text-[10px] font-bold uppercase tracking-[0.2em] text-gray-500">Category</label>
                    <div class="relative">
                        <select name="category_id"
                                class="w-full bg-[#F5F5F5] border-b-2 border-[#1a1a1a] p-3 font-mono text-sm appearance-none focus:outline-none cursor-pointer">
                            @foreach($categories as $c)
                                <option value="{{ $c->id }}" @selected($product->category_id == $c->id)>
                                    {{ $c->name }}
                                </option>
                            @endforeach
                        </select>
                        {{-- Custom Arrow --}}
                        <div class="absolute right-3 top-4 pointer-events-none">
                            <svg class="w-3 h-3 text-[#1a1a1a]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="square" stroke-linejoin="miter" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Deskripsi --}}
            <div class="space-y-2">
                <label class="text-[10px] font-bold uppercase tracking-[0.2em] text-gray-500">Description</label>
                <textarea name="description"
                          rows="4"
                          class="w-full bg-[#F5F5F5] border-b-2 border-[#1a1a1a] p-3 font-mono text-sm focus:outline-none focus:bg-[#1a1a1a] focus:text-white transition-colors resize-none">{{ $product->description }}</textarea>
            </div>

            {{-- SECTION 2: IMAGE MANAGEMENT --}}
            <div class="p-6 border border-gray-200 bg-gray-50">
                <h3 class="text-sm font-black uppercase tracking-widest mb-4">Image Management</h3>
                
                {{-- Existing Images --}}
                @if($product->images->count() > 0)
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                    @foreach($product->images as $img)
                        <div class="relative group border-2 border-[#1a1a1a]">
                            <img src="{{ asset('storage/'.$img->image) }}" class="w-full h-24 object-cover grayscale group-hover:grayscale-0 transition-all">
                            
                            {{-- Checkbox Overlay --}}
                            <label class="absolute inset-0 bg-black/80 opacity-0 group-hover:opacity-100 transition-opacity flex flex-col items-center justify-center cursor-pointer">
                                <span class="text-[10px] font-bold text-[#EB0000] uppercase mb-2">Mark Delete</span>
                                <input type="checkbox" name="delete_images[]" value="{{ $img->id }}" class="w-5 h-5 accent-[#EB0000]">
                            </label>
                        </div>
                    @endforeach
                </div>
                @else
                    <p class="font-mono text-xs text-gray-400 mb-4">[ NO_EXISTING_IMAGES ]</p>
                @endif

                {{-- Upload New --}}
                <div class="relative border-2 border-dashed border-gray-300 hover:border-[#1a1a1a] bg-white p-4 text-center transition-colors group cursor-pointer">
                    <input type="file" name="images[]" multiple class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                    <div class="space-y-1">
                        <p class="text-xs font-bold uppercase text-gray-500 group-hover:text-[#1a1a1a]">+ Upload New Images</p>
                    </div>
                </div>
            </div>

            {{-- SECTION 3: VARIANTS --}}
            <div class="pt-8 border-t-2 border-[#1a1a1a]">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-black uppercase tracking-tighter">Variant Configuration</h3>
                    <button type="button" onclick="addVariant()" class="text-[10px] font-bold uppercase tracking-widest border border-[#1a1a1a] px-4 py-2 hover:bg-[#1a1a1a] hover:text-white transition-colors">
                        + Add Row
                    </button>
                </div>

                {{-- Table Header --}}
                <div class="grid grid-cols-12 gap-2 mb-2 px-2">
                    <div class="col-span-3 text-[9px] font-bold uppercase text-gray-400">Color</div>
                    <div class="col-span-3 text-[9px] font-bold uppercase text-gray-400">Size</div>
                    <div class="col-span-3 text-[9px] font-bold uppercase text-gray-400">Price</div>
                    <div class="col-span-2 text-[9px] font-bold uppercase text-gray-400">Stock</div>
                    <div class="col-span-1 text-[9px] font-bold uppercase text-gray-400 text-center">Act</div>
                </div>

                <div id="variant-wrapper" class="space-y-2">
                    @foreach($product->variants as $i => $v)
                    <div class="grid grid-cols-12 gap-2 variant-item group">
                        {{-- Hidden ID for Update Logic (Optional if needed by controller) --}}
                        {{-- <input type="hidden" name="variants[{{ $i }}][id]" value="{{ $v->id }}"> --}}
                        
                        <div class="col-span-3">
                            <input name="variants[{{ $i }}][color]" value="{{ $v->color }}" class="w-full bg-gray-50 border border-gray-300 p-2 font-mono text-xs focus:border-[#1a1a1a] focus:bg-white focus:outline-none uppercase">
                        </div>
                        <div class="col-span-3">
                            <input name="variants[{{ $i }}][size]" value="{{ $v->size }}" class="w-full bg-gray-50 border border-gray-300 p-2 font-mono text-xs focus:border-[#1a1a1a] focus:bg-white focus:outline-none uppercase">
                        </div>
                        <div class="col-span-3">
                            <input name="variants[{{ $i }}][price]" value="{{ $v->price }}" class="w-full bg-gray-50 border border-gray-300 p-2 font-mono text-xs focus:border-[#1a1a1a] focus:bg-white focus:outline-none">
                        </div>
                        <div class="col-span-2">
                            <input name="variants[{{ $i }}][stock]" value="{{ $v->stock }}" class="w-full bg-gray-50 border border-gray-300 p-2 font-mono text-xs focus:border-[#1a1a1a] focus:bg-white focus:outline-none">
                        </div>
                        <div class="col-span-1 flex justify-center">
                            <button type="button" onclick="removeVariant(this)" class="w-full h-full bg-gray-200 text-gray-500 hover:bg-[#EB0000] hover:text-white font-mono text-xs transition-colors">X</button>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- SUBMIT --}}
            <div class="pt-6 mt-6">
                <button class="w-full bg-[#1a1a1a] text-white py-4 text-sm font-black uppercase tracking-[0.2em] hover:bg-[#EB0000] transition-colors flex justify-center items-center gap-2 group">
                    <span>Save Changes</span>
                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="square" stroke-linejoin="miter" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </button>
            </div>
        </form>
    </div>
</div>

{{-- SCRIPT --}}
<script>
let variantIndex = {{ $product->variants->count() }};

function addVariant() {
    const wrapper = document.getElementById('variant-wrapper');
    
    // Inject HTML dengan styling yang sama persis
    const html = `
        <div class="grid grid-cols-12 gap-2 variant-item group">
            <div class="col-span-3">
                <input name="variants[${variantIndex}][color]" placeholder="NEW" class="w-full bg-gray-50 border border-gray-300 p-2 font-mono text-xs focus:border-[#1a1a1a] focus:bg-white focus:outline-none uppercase">
            </div>
            <div class="col-span-3">
                <input name="variants[${variantIndex}][size]" placeholder="NEW" class="w-full bg-gray-50 border border-gray-300 p-2 font-mono text-xs focus:border-[#1a1a1a] focus:bg-white focus:outline-none uppercase">
            </div>
            <div class="col-span-3">
                <input name="variants[${variantIndex}][price]" placeholder="0" class="w-full bg-gray-50 border border-gray-300 p-2 font-mono text-xs focus:border-[#1a1a1a] focus:bg-white focus:outline-none">
            </div>
            <div class="col-span-2">
                <input name="variants[${variantIndex}][stock]" placeholder="0" class="w-full bg-gray-50 border border-gray-300 p-2 font-mono text-xs focus:border-[#1a1a1a] focus:bg-white focus:outline-none">
            </div>
            <div class="col-span-1 flex justify-center">
                <button type="button" onclick="removeVariant(this)" class="w-full h-full bg-gray-200 text-gray-500 hover:bg-[#EB0000] hover:text-white font-mono text-xs transition-colors">X</button>
            </div>
        </div>
    `;
    
    wrapper.insertAdjacentHTML('beforeend', html);
    variantIndex++;
}

function removeVariant(btn) {
    // Tambahkan logika konfirmasi jika perlu
    btn.closest('.variant-item').remove();
}
</script>
@endsection