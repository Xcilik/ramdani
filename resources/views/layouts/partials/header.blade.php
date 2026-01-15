<header class="bg-white font-sans sticky top-0 z-50">

    {{-- Top Bar --}}
    <div class="bg-gray-100 hidden md:block">
        <div
            class="max-w-[1920px] mx-auto px-4 md:px-10 h-9 flex items-center justify-between text-[11px] font-medium text-gray-800">
            <div>
                {{-- Optional Left Content --}}
            </div>
            <div class="flex gap-4">
                <a href="#" class="hover:text-gray-500">Cari Toko</a>
                <span class="text-gray-400">|</span>
                <a href="#" class="hover:text-gray-500">Bantuan</a>
                <span class="text-gray-400">|</span>

                @auth
                    {{-- Tampilan di Topbar jika sudah login --}}
                    <span class="text-gray-800">Hi, {{ Auth::user()->name }}</span>
                @else
                    <a href="#" class="hover:text-gray-500">Join Us</a>
                    <span class="text-gray-400">|</span>
                    <a href="{{ route('login') }}" class="hover:text-gray-500">Sign In</a>
                @endauth
            </div>
        </div>
    </div>

    {{-- Main Navbar --}}
    <div class="bg-white border-b border-gray-100 relative">
        <div class="max-w-[1920px] mx-auto px-4 md:px-10">
            <div class="flex items-center justify-between h-[60px] lg:h-[72px]">

                {{-- Logo --}}
                <a href="{{ route('home') }}" class="flex-shrink-0 hover:opacity-70 transition">
                    <svg class="w-12 h-12 md:w-16 md:h-16 text-black" viewBox="0 0 512 512" fill="currentColor"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M20 300c60 40 120 80 180 120 80-140 180-260 300-340-140 40-260 120-360 240-40-20-80-40-120-20z" />
                    </svg>
                </a>


                {{-- Desktop Menu --}}
                <nav class="hidden lg:flex items-center absolute left-1/2 transform -translate-x-1/2">
                    <ul class="flex gap-6 xl:gap-8">
                        <li><a href="{{ route('home') }}"
                                class="text-base font-semibold text-gray-900 hover:border-b-2 hover:border-black py-6 transition-all">New
                                & Featured</a></li>
                        <li><a href="{{ route('home', ['category' => 'pria']) }}"
                                class="text-base font-semibold text-gray-900 hover:border-b-2 hover:border-black py-6 transition-all">Pria</a>
                        </li>
                        <li><a href="{{ route('home', ['category' => 'wanita']) }}"
                                class="text-base font-semibold text-gray-900 hover:border-b-2 hover:border-black py-6 transition-all">Wanita</a>
                        </li>
                    <li><a href="{{ route('home', ['category' => 'anak']) }}"
                                class="text-base font-semibold text-gray-900 hover:border-b-2 hover:border-black py-6 transition-all">Anak</a>
                        </li>
                        <li><a href="#"
                                class="text-base font-semibold text-gray-900 hover:border-b-2 hover:border-black py-6 transition-all">Sale</a>
                        </li>
                    </ul>
                </nav>

                {{-- Icons Right --}}
                <div class="flex items-center gap-2 md:gap-4">

                    {{-- Search Bar --}}
                    <div
                        class="hidden md:flex items-center bg-gray-100 px-4 py-2 rounded-full hover:bg-gray-200 transition group w-44 lg:w-48">
                        <svg class="w-6 h-6 text-gray-800 bg-transparent rounded-full p-1 group-hover:bg-gray-300 transition"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <input type="text" placeholder="Cari"
                            class="bg-transparent border-none text-sm font-medium focus:ring-0 w-full placeholder-gray-500 hover:placeholder-gray-700 ml-1">
                    </div>

                    {{-- Favorites Icon --}}
                    <a href="#" class="p-2 rounded-full hover:bg-gray-100 transition hidden sm:block">
                        <svg class="w-6 h-6 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                    </a>

                    {{-- Cart Icon --}}
                    <a href="{{ route('cart.index') }}" class="relative p-2 rounded-full hover:bg-gray-100 transition">
                        <svg class="w-6 h-6 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                        @php
                            $cartCount = session('cart') ? collect(session('cart'))->sum('qty') : 0;
                        @endphp
                        @if ($cartCount > 0)
                            <span
                                class="absolute top-1 right-0 bg-black text-white text-[10px] font-medium w-4 h-4 rounded-full flex items-center justify-center ring-1 ring-white">
                                {{ $cartCount }}
                            </span>
                        @endif
                    </a>

                    {{-- USER ICON (LOGIC ADMIN/USER) --}}
                    @auth
                        @php
                            // Cek role user (sesuaikan dengan logic role di aplikasimu)
                            // Contoh: jika menggunakan Spatie Permission atau kolom 'role' di tabel users
                            $dashboardRoute = auth()->user()->hasRole('admin')
                                ? route('admin.dashboard')
                                : route('user.dashboard');
                        @endphp
                        <a href="{{ $dashboardRoute }}" class="p-2 rounded-full hover:bg-gray-100 transition"
                            title="Dashboard">
                            <svg class="w-6 h-6 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </a>
                    @else
                        {{-- Jika Guest, icon user mengarah ke Login --}}
                        <a href="{{ route('login') }}" class="p-2 rounded-full hover:bg-gray-100 transition"
                            title="Sign In">
                            <svg class="w-6 h-6 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </a>
                    @endauth

                    {{-- Hamburger Button --}}
                    <button class="lg:hidden p-2 text-gray-900"
                        onclick="document.getElementById('mobileMenu').classList.toggle('hidden')">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Promo Banner --}}

    {{-- Mobile Menu Overlay --}}
    <div id="mobileMenu" class="hidden fixed inset-0 z-50 bg-white lg:hidden overflow-y-auto">
        <div class="p-6">
            <div class="flex justify-end mb-8">
                <button onclick="document.getElementById('mobileMenu').classList.add('hidden')"
                    class="p-2 bg-gray-100 rounded-full">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            {{-- Mobile Links --}}
            <div class="space-y-6">
                @auth
                    {{-- Dashboard Menu di Mobile (Logic sama seperti icon) --}}
                    @php
                        $mobileDashRoute = auth()->user()->hasRole('admin')
                            ? route('admin.dashboard')
                            : route('user.dashboard');
                    @endphp
                    <a href="{{ $mobileDashRoute }}"
                        class="flex justify-between items-center text-2xl font-bold text-black border-b pb-2">
                        My Dashboard
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                @endauth

                <a href="#" class="flex justify-between items-center text-2xl font-medium text-gray-900">New &
                    Featured <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg></a>
                <a href="#" class="flex justify-between items-center text-2xl font-medium text-gray-900">Pria
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg></a>
                <a href="#" class="flex justify-between items-center text-2xl font-medium text-gray-900">Wanita
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg></a>
                <a href="#" class="flex justify-between items-center text-2xl font-medium text-gray-900">Anak
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg></a>
                <a href="#" class="flex justify-between items-center text-2xl font-medium text-gray-900">Sale
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg></a>
            </div>

            {{-- Mobile Footer Links --}}
            <div class="mt-12 space-y-4 pt-8 border-t border-gray-200">
                @guest
                    <p class="text-lg text-gray-500 mb-4">Menjadi Member Niken? <a href="{{ route('login') }}"
                            class="text-black font-bold">Sign In</a></p>
                @else
                    {{-- Logout Form untuk Mobile --}}
                    <form action="{{ route('logout') }}" method="POST" class="mb-4">
                        @csrf
                        <button type="submit" class="text-lg font-bold text-red-600 hover:text-red-800">
                            Log Out
                        </button>
                    </form>
                @endguest

                <a href="#" class="flex gap-4 items-center text-base font-medium text-gray-600"><span
                        class="p-2 bg-gray-100 rounded-full"><svg class="w-5 h-5" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg></span> Bag</a>
                <a href="#" class="flex gap-4 items-center text-base font-medium text-gray-600"><span
                        class="p-2 bg-gray-100 rounded-full"><svg class="w-5 h-5" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg></span> Favorites</a>
                <a href="#" class="flex gap-4 items-center text-base font-medium text-gray-600"><span
                        class="p-2 bg-gray-100 rounded-full"><svg class="w-5 h-5" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg></span> Bantuan</a>
            </div>
        </div>
    </div>
</header>
