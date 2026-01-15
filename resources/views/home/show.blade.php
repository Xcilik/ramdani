@extends('layouts.app')

@section('title', $product->name)

@section('content')
    <div class="max-w-[1440px] mx-auto px-4 md:px-10 py-6 md:py-10 relative">
        
        {{-- Breadcrumb Minimalis --}}
        <nav class="flex text-[11px] font-medium text-gray-500 mb-6 md:mb-0" aria-label="Breadcrumb">
            <a href="/" class="hover:text-black transition">Home</a>
            <span class="mx-2">/</span>
            <a href="{{ route('home', ['category' => $product->category->slug]) }}" class="hover:text-black transition">{{ $product->category->name }}</a>
            <span class="mx-2">/</span>
            <span class="text-black">{{ $product->name }}</span>
        </nav>

        <div class="lg:flex lg:gap-12 items-start mt-4">
            
            {{-- ================= KIRI: GALERI FOTO (Niken STYLE) ================= --}}
            {{-- Desktop: Grid 2 Kolom | Mobile: Horizontal Scroll --}}
            <div class="w-full lg:w-[65%] mb-8 lg:mb-0">
                
                {{-- Mobile View (Scroll Samping) --}}
                <div class="flex overflow-x-auto gap-2 lg:hidden snap-x snap-mandatory scrollbar-hide pb-4">
                    @foreach ($product->images as $image)
                        <div class="flex-shrink-0 w-[90%] snap-center bg-[#f5f5f5]">
                            <img src="{{ asset('storage/' . $image->image) }}" 
                                 class="w-full h-auto object-cover mix-blend-multiply" 
                                 alt="{{ $product->name }}">
                        </div>
                    @endforeach
                </div>

                {{-- Desktop View (Grid) --}}
                <div class="hidden lg:grid grid-cols-2 gap-3">
                    @foreach ($product->images as $image)
                        <div class="bg-[#f5f5f5] w-full relative">
                            <img src="{{ asset('storage/' . $image->image) }}" 
                                 class="w-full h-auto object-cover mix-blend-multiply transition hover:scale-[1.02] duration-500" 
                                 alt="{{ $product->name }}">
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- ================= KANAN: INFO PRODUK (STICKY) ================= --}}
            <div class="w-full lg:w-[35%] sticky top-24">
                
                <div class="pr-2">
                    <h1 class="text-2xl md:text-3xl font-medium tracking-tight mb-1 text-black">
                        {{ $product->name }}
                    </h1>
                    <p class="text-base font-medium text-gray-500 mb-4">
                        {{ $product->category->name }}
                    </p>
                    
                    <div class="mb-6">
                        <p class="text-lg font-medium text-gray-900" id="display_price">
                            Rp {{ number_format($product->variants->min('price'), 0, ',', '.') }}
                        </p>
                    </div>

                    {{-- FORM START --}}
                    <form action="{{ route('cart.add') }}" method="POST" id="addToCartForm">
                        @csrf
                        {{-- Data Hidden untuk Controller --}}
                        <input type="hidden" name="product_name" value="{{ $product->name }}">
                        <input type="hidden" name="qty" value="1"> {{-- Default Qty 1 (Niken Style biasanya handle qty di cart) --}}
                        <input type="hidden" name="variant_id" id="selectedVariantId" required>
                        <input type="hidden" name="price" id="selectedPriceInput" value="{{ $product->variants->min('price') }}">

                        {{-- Size Selector --}}
                        <div class="mb-8">
                            <div class="flex justify-between items-center mb-3">
                                <label class="text-base font-medium">Pilih Ukuran</label>
                                <a href="#" class="text-base font-medium text-gray-400 hover:text-black transition">Panduan Ukuran</a>
                            </div>

                            <div class="grid grid-cols-3 gap-2">
                                @foreach ($product->variants as $variant)
                                    @php $isOutOfStock = $variant->stock <= 0; @endphp
                                    <div class="relative">
                                        <input type="radio" 
                                               name="size_selector" 
                                               id="variant_{{ $variant->id }}" 
                                               value="{{ $variant->id }}"
                                               class="peer sr-only"
                                               {{ $isOutOfStock ? 'disabled' : '' }}
                                               onchange="selectSize('{{ $variant->id }}', '{{ $variant->price }}')">
                                        
                                        <label for="variant_{{ $variant->id }}" 
                                               class="flex items-center justify-center w-full py-3 rounded-md border border-gray-200 bg-white text-base hover:border-black cursor-pointer transition
                                               peer-checked:border-black peer-checked:ring-1 peer-checked:ring-black
                                               {{ $isOutOfStock ? 'bg-gray-100 text-gray-300 cursor-not-allowed hover:border-gray-200' : 'text-black' }}">
                                            {{ $variant->size }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                            <p id="sizeError" class="text-red-600 text-sm mt-2 hidden">Silakan pilih ukuran terlebih dahulu.</p>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="space-y-3 mb-8">
                            <button type="submit" 
                                    class="w-full bg-black text-white rounded-full py-4 text-base font-medium hover:bg-gray-800 transition duration-200">
                                Tambahkan ke Keranjang
                            </button>
                            
                            <button type="button" 
                                    class="w-full bg-white text-black border border-gray-300 rounded-full py-4 text-base font-medium hover:border-black flex items-center justify-center gap-2 transition duration-200">
                                Favorit <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                            </button>
                        </div>
                    </form>

                    {{-- Description --}}
                    <div class="text-base text-gray-900 leading-relaxed mb-8 pt-6">
                        <p class="mb-6">{{ $product->description }}</p>
                        <ul class="list-disc pl-5 space-y-1 text-sm text-gray-700">
                            <li>Warna: {{ $product->variants->first()->color ?? 'Sesuai Foto' }}</li>
                            <li>Kategori: {{ $product->category->name }}</li>
                        </ul>
                    </div>

                    {{-- Accordion Info --}}
                    <div class="border-t border-gray-200 py-4">
                        <details class="group cursor-pointer">
                            <summary class="flex justify-between items-center font-medium list-none text-lg">
                                <span>Pengiriman & Pengembalian</span>
                                <span class="transition group-open:rotate-180">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M6 9l6 6 6-6"/></svg>
                                </span>
                            </summary>
                            <div class="text-gray-600 mt-4 text-base group-open:animate-fadeIn">
                                <p>Gratis ongkir standar untuk pesanan member Niken.</p>
                            </div>
                        </details>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>

    <script>
        // JS Sederhana untuk update input hidden saat ukuran dipilih
        function selectSize(variantId, price) {
            // Update Variant ID
            document.getElementById('selectedVariantId').value = variantId;
            
            // Update Price Input
            document.getElementById('selectedPriceInput').value = price;
            
            // Update Display Price (Opsional jika harga beda tiap size)
            document.getElementById('display_price').innerText = 'Rp ' + Number(price).toLocaleString('id-ID');

            // Hide Error
            document.getElementById('sizeError').classList.add('hidden');
        }

        // Validasi form sebelum submit
        document.getElementById('addToCartForm').addEventListener('submit', function(e) {
            const variantId = document.getElementById('selectedVariantId').value;
            if (!variantId) {
                e.preventDefault();
                document.getElementById('sizeError').classList.remove('hidden');
            }
        });
    </script>

    <style>
        /* Hilangkan Scrollbar di Mobile tapi tetap bisa scroll */
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }
        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
        
        /* Animasi Accordion */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fadeIn {
            animation: fadeIn 0.3s ease-out forwards;
        }
    </style>
@endsection