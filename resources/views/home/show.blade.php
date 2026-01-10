@extends('layouts.app')

@section('title', $product->name)

@section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <div class="max-w-7xl mx-auto px-4 md:px-6 py-8 md:py-12">
        {{-- BREADCRUMB --}}
        <nav class="flex text-[10px] text-gray-400 uppercase tracking-widest mb-8" aria-label="Breadcrumb">
            <a href="/" class="hover:text-black transition">Home</a>
            <span class="mx-2">/</span>
            <a href="{{ route('home', ['category' => $product->category->slug]) }}"
                class="hover:text-black transition">{{ $product->category->name }}</a>
            <span class="mx-2">/</span>
            <span class="text-black font-bold">{{ $product->name }}</span>
        </nav>

        <div class="flex flex-col lg:flex-row gap-12">

            {{-- ================= LEFT: GALLERY SLIDER ================= --}}
            <div class="lg:w-7/12">
                <div class="sticky top-10">
                    <div class="swiper productMainSwiper aspect-[3/4] bg-gray-100 overflow-hidden mb-4">
                        <div class="swiper-wrapper">
                            @foreach ($product->images as $image)
                                <div class="swiper-slide">
                                    <img src="{{ asset('storage/' . $image->image) }}"
                                        class="w-full h-full object-cover object-center" alt="{{ $product->name }}">
                                </div>
                            @endforeach
                        </div>
                        <div class="swiper-button-next !text-black bg-white/80 w-10 h-10 !after:text-sm"></div>
                        <div class="swiper-button-prev !text-black bg-white/80 w-10 h-10 !after:text-sm"></div>
                    </div>

                    <div class="swiper productThumbSwiper">
                        <div class="swiper-wrapper">
                            @foreach ($product->images as $image)
                                <div
                                    class="swiper-slide cursor-pointer border-2 border-transparent opacity-60 transition duration-300">
                                    <img src="{{ asset('storage/' . $image->image) }}" class="aspect-[3/4] object-cover"
                                        alt="Thumbnail">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            {{-- ================= RIGHT: PRODUCT INFO ================= --}}
            <div class="lg:w-5/12">
                <div class="space-y-6">
                    <div>
                        <h1 class="text-2xl md:text-3xl font-black uppercase tracking-tighter text-gray-900 leading-tight">
                            {{ $product->name }}
                        </h1>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mt-2">
                            {{ $product->category->name }}
                        </p>
                    </div>

                    <div class="border-y border-gray-100 py-6">
                        <p class="text-[11px] font-bold text-gray-400 uppercase tracking-tighter mb-1">Harga Spesial</p>
                        <h2 id="display_price" class="text-3xl font-black text-gray-900 tracking-tighter italic">
                            Rp {{ number_format($product->variants->min('price'), 0, ',', '.') }}
                        </h2>
                    </div>

                    <p class="text-sm text-gray-600 leading-relaxed font-medium">
                        {{ $product->description }}
                    </p>

                    {{-- FORM ADD TO CART --}}
                    <form action="{{ route('cart.add') }}" method="POST" class="space-y-8">
                        @csrf
                        <input type="hidden" name="product_name" value="{{ $product->name }}">
                        <input type="hidden" id="selected_price" name="price"
                            value="{{ $product->variants->min('price') }}">

                        {{-- VARIANT SELECTOR (Uniqlo Style Grid) --}}
                        <div>
                            <div class="flex justify-between items-center mb-4">
                                <label class="text-xs font-black uppercase tracking-widest">Pilih Ukuran/Warna</label>
                                <a href="#"
                                    class="text-[10px] font-bold text-gray-400 underline uppercase tracking-tighter">Size
                                    Chart</a>
                            </div>

                            <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                                @foreach ($product->variants as $variant)
                                    <label
                                        class="relative group cursor-pointer {{ $variant->stock == 0 ? 'opacity-40 cursor-not-allowed' : '' }}">
                                        <input type="radio" name="variant_id" value="{{ $variant->id }}"
                                            data-price="{{ $variant->price }}" onchange="updatePrice(this)"
                                            class="peer sr-only" {{ $variant->stock == 0 ? 'disabled' : 'required' }}>

                                        <div
                                            class="border border-gray-200 py-3 px-2 text-center transition group-hover:border-black peer-checked:border-black peer-checked:bg-black peer-checked:text-white">
                                            <p class="text-[11px] font-bold uppercase tracking-tight">
                                                {{ $variant->color ?? '' }} {{ $variant->size }}
                                            </p>
                                            <p class="text-[9px] mt-0.5 opacity-70">Stok: {{ $variant->stock }}</p>
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        {{-- QUANTITY --}}
                        <div class="flex items-center gap-4 border-t border-gray-100 pt-8">
                            <div class="w-32">
                                <label
                                    class="text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2 block">Kuantitas</label>
                                <div class="flex border border-gray-300 h-12">
                                    <button type="button" onclick="this.nextElementSibling.stepDown()"
                                        class="flex-1 hover:bg-gray-100 text-lg">−</button>
                                    <input type="number" name="qty" value="1" min="1"
                                        class="w-12 text-center border-none focus:ring-0 font-bold text-sm">
                                    <button type="button" onclick="this.previousElementSibling.stepUp()"
                                        class="flex-1 hover:bg-gray-100 text-lg">+</button>
                                </div>
                            </div>

                            <div class="flex-1 self-end">
                                <button type="submit"
                                    class="w-full bg-black text-white h-12 text-sm font-black uppercase tracking-[0.2em] transition hover:bg-gray-800 disabled:bg-gray-300"
                                    {{ $product->variants->sum('stock') == 0 ? 'disabled' : '' }}>
                                    {{ $product->variants->sum('stock') == 0 ? 'Habis Terjual' : 'Tambah ke Keranjang' }}
                                </button>
                            </div>
                        </div>
                    </form>

                    {{-- ADDITIONAL INFO --}}
                    <div class="pt-8 border-t border-gray-100">
                        <div class="flex items-center gap-3 text-gray-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" stroke-width="2" />
                            </svg>
                            <span class="text-[10px] font-bold uppercase tracking-widest">Pengiriman Gratis untuk
                                Member</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        // Initialize Thumbnails
        var thumbSwiper = new Swiper(".productThumbSwiper", {
            spaceBetween: 10,
            slidesPerView: 5,
            freeMode: true,
            watchSlidesProgress: true,
        });

        // Initialize Main Slider
        var mainSwiper = new Swiper(".productMainSwiper", {
            spaceBetween: 10,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            thumbs: {
                swiper: thumbSwiper,
            },
        });

        function updatePrice(element) {
            const price = element.getAttribute('data-price');
            document.getElementById('selected_price').value = price;
            document.getElementById('display_price').innerText = 'Rp ' + Number(price).toLocaleString('id-ID');
        }
    </script>

    <style>
        /* Styling for active thumbnail */
        .productThumbSwiper .swiper-slide-thumb-active {
            opacity: 1;
            border-color: black;
        }

        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
    </style>
@endsection
