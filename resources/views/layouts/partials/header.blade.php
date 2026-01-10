<header class="bg-white border-b border-gray-200 sticky top-0 z-50">
    <div class="bg-gray-100 py-1.5 px-4 text-center">
        <p class="text-[11px] tracking-widest uppercase font-medium text-gray-600">
            Gratis Ongkir Minimal Belanja Rp 699.000
        </p>
    </div>

    <div class="max-w-7xl mx-auto px-4 md:px-6">
        <div class="flex items-center justify-between h-20">
            
            <div class="flex items-center gap-8">
                <a href="{{ route('home') }}" class="flex-shrink-0">
                    <span class="text-2xl font-black tracking-tighter bg-red-600 text-white px-2 py-1">
                        LARA<span class="font-light">CLO</span>
                    </span>
                </a>

                <nav class="hidden lg:flex items-center gap-8">
                    <a href="#" class="text-sm font-bold uppercase tracking-wider hover:text-red-600 transition">Pria</a>
                    <a href="#" class="text-sm font-bold uppercase tracking-wider hover:text-red-600 transition">Wanita</a>
                    <a href="#" class="text-sm font-bold uppercase tracking-wider hover:text-red-600 transition">Anak</a>
                    <a href="#" class="text-sm font-bold uppercase tracking-wider text-red-600 transition">Sale</a>
                </nav>
            </div>

            <div class="flex items-center gap-5">
                <div class="hidden md:flex items-center bg-gray-100 px-3 py-2 rounded-sm border border-transparent focus-within:border-gray-400">
                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    <input type="text" placeholder="Cari Produk..." class="bg-transparent border-none text-xs focus:ring-0 w-48 placeholder-gray-500">
                </div>

                <div class="flex items-center gap-4">
                    <a href="{{ route('login') }}" class="text-gray-700 hover:text-red-600 transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    </a>
                    
                    <a href="{{ route('cart.index') }}" class="relative text-gray-700 hover:text-red-600 transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                        @php
                            $cartCount = session('cart') ? collect(session('cart'))->sum('qty') : 0;
                        @endphp
                        @if ($cartCount > 0)
                            <span class="absolute -top-1 -right-1 bg-red-600 text-white text-[10px] font-bold w-4 h-4 rounded-full flex items-center justify-center">
                                {{ $cartCount }}
                            </span>
                        @endif
                    </a>

                    <button class="lg:hidden text-gray-700" onclick="document.getElementById('mobileMenu').classList.toggle('hidden')">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div id="mobileMenu" class="hidden lg:hidden bg-white border-t border-gray-100">
        <div class="px-4 py-6 space-y-4">
            <a href="#" class="block text-base font-bold uppercase">Pria</a>
            <a href="#" class="block text-base font-bold uppercase">Wanita</a>
            <a href="#" class="block text-base font-bold uppercase border-b pb-2">Anak</a>
            <a href="#" class="block text-sm text-gray-600">Bantuan</a>
            <a href="#" class="block text-sm text-gray-600">Lokasi Toko</a>
        </div>
    </div>
</header>