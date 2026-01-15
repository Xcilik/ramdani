<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Niken</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;900&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #ffffff;
        }

        /* Custom Scrollbar untuk kesan premium */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #f5f5f5;
        }
        ::-webkit-scrollbar-thumb {
            background: #d4d4d4;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #111;
        }
    </style>
</head>

<body class="text-[#111111] antialiased min-h-screen flex flex-col selection:bg-black selection:text-white">

    <div id="mobileOverlay" class="fixed inset-0 bg-black/50 z-40 hidden backdrop-blur-sm transition-opacity"></div>

    <div id="mobileSidebar"
        class="fixed top-0 left-0 w-[280px] h-full bg-white z-50 transform -translate-x-full transition-transform duration-300 border-r border-gray-100 flex flex-col">

        <div class="h-[70px] flex items-center justify-between px-6 border-b border-gray-100">
            <span class="text-lg font-black tracking-tighter uppercase">Niken</span>
            <button onclick="toggleSidebar()" class="p-2 hover:bg-gray-100 rounded-full transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <div class="flex-1 py-6 px-4 space-y-1">
            <a href="{{ route('admin.dashboard') }}"
                class="block px-4 py-3 text-sm font-medium rounded-md transition-colors
                {{ request()->routeIs('admin.dashboard') ? 'bg-black text-white' : 'text-gray-500 hover:bg-gray-50 hover:text-black' }}">
                Dashboard
            </a>
            <a href="{{ route('admin.categories.index') }}"
                class="block px-4 py-3 text-sm font-medium rounded-md transition-colors
                {{ request()->routeIs('admin.categories*') ? 'bg-black text-white' : 'text-gray-500 hover:bg-gray-50 hover:text-black' }}">
                Categories
            </a>
            <a href="{{ route('admin.products.index') }}"
                class="block px-4 py-3 text-sm font-medium rounded-md transition-colors
                {{ request()->routeIs('admin.products*') ? 'bg-black text-white' : 'text-gray-500 hover:bg-gray-50 hover:text-black' }}">
                Products
            </a>
        </div>

        <div class="p-4 border-t border-gray-100">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="w-full flex items-center justify-center gap-2 px-4 py-3 text-xs font-bold uppercase tracking-widest text-black border border-gray-200 rounded-full hover:border-black hover:bg-black hover:text-white transition-all duration-300">
                    Sign Out
                </button>
            </form>
        </div>
    </div>

    <nav class="border-b border-[#e5e5e5] bg-white sticky top-0 z-30">
        <div class="max-w-[1920px] mx-auto px-6 md:px-10 h-[70px] flex items-center justify-between">

            <div class="flex items-center gap-12">
                <button onclick="toggleSidebar()" class="lg:hidden p-1">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>

                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 group">
                    <svg class="w-8 h-8 text-black" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M21 8.719L7.836 14.303C6.74 14.768 5.818 15 5.075 15c-.836 0-1.445-.295-1.819-.884-.485-.76-.273-1.982.559-3.272.494-.754 1.122-1.446 1.734-2.108-.601.576-2.856 2.723-2.842 6.002.021 5.258 4.015 6.602 7.29 6.602 3.843 0 11-2.909 11-12.621z"/>
                    </svg>
                    <span class="hidden md:block text-lg font-black tracking-tighter uppercase italic group-hover:opacity-70 transition">Admin Panel</span>
                </a>

                <div class="hidden lg:flex items-center gap-8">
                    <a href="{{ route('admin.dashboard') }}" class="group relative py-6 text-sm font-bold uppercase tracking-wide {{ request()->routeIs('admin.dashboard') ? 'text-black' : 'text-gray-400 hover:text-black' }} transition-colors">
                        Overview
                        <span class="absolute bottom-0 left-0 h-[2px] bg-black transition-all duration-300 {{ request()->routeIs('admin.dashboard') ? 'w-full' : 'w-0 group-hover:w-full' }}"></span>
                    </a>
                    <a href="{{ route('admin.categories.index') }}" class="group relative py-6 text-sm font-bold uppercase tracking-wide {{ request()->routeIs('admin.categories*') ? 'text-black' : 'text-gray-400 hover:text-black' }} transition-colors">
                        Categories
                        <span class="absolute bottom-0 left-0 h-[2px] bg-black transition-all duration-300 {{ request()->routeIs('admin.categories*') ? 'w-full' : 'w-0 group-hover:w-full' }}"></span>
                    </a>
                    <a href="{{ route('admin.products.index') }}" class="group relative py-6 text-sm font-bold uppercase tracking-wide {{ request()->routeIs('admin.products*') ? 'text-black' : 'text-gray-400 hover:text-black' }} transition-colors">
                        Products
                        <span class="absolute bottom-0 left-0 h-[2px] bg-black transition-all duration-300 {{ request()->routeIs('admin.products*') ? 'w-full' : 'w-0 group-hover:w-full' }}"></span>
                    </a>
                </div>
            </div>

            <div class="flex items-center gap-6">
                <div class="hidden sm:flex flex-col items-end">
                    <span class="text-[10px] font-bold uppercase tracking-widest text-gray-400">Signed in as</span>
                    <span class="text-xs font-bold text-black">{{ auth()->user()->name }}</span>
                </div>
                
                <form method="POST" action="{{ route('logout') }}" class="hidden sm:block">
                    @csrf
                    <button type="submit" class="text-xs font-bold text-gray-500 hover:text-black underline underline-offset-4 decoration-gray-300 hover:decoration-black transition-all">
                        Log Out
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <main class="flex-grow max-w-[1920px] w-full mx-auto px-6 md:px-10 py-12">
        
        <div class="mb-12 flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div>
                <h1 class="text-4xl md:text-5xl font-black uppercase tracking-tighter leading-[0.9] text-black mb-2">
                    @yield('title')
                </h1>
                <p class="text-sm text-gray-500 font-medium">Manage your empire seamlessly.</p>
            </div>
            
            <div class="flex gap-3">
                @yield('actions')
            </div>
        </div>

        <div class="w-full">
            @yield('content')
        </div>
    </main>

    <footer class="border-t border-[#e5e5e5] mt-auto bg-[#fafafa]">
        <div class="max-w-[1920px] mx-auto px-6 md:px-10 py-10 flex flex-col md:flex-row justify-between items-center gap-4">
            <div class="flex items-center gap-2">
                <svg class="w-5 h-5 text-gray-400" viewBox="0 0 24 24" fill="currentColor"><path d="M21 8.719L7.836 14.303C6.74 14.768 5.818 15 5.075 15c-.836 0-1.445-.295-1.819-.884-.485-.76-.273-1.982.559-3.272.494-.754 1.122-1.446 1.734-2.108-.601.576-2.856 2.723-2.842 6.002.021 5.258 4.015 6.602 7.29 6.602 3.843 0 11-2.909 11-12.621z"/></svg>
                <span class="text-[11px] font-bold text-gray-400 uppercase tracking-widest">
                    &copy; {{ date('Y') }} Niken Inc.
                </span>
            </div>
            <div class="flex gap-6">
                <a href="#" class="text-[11px] font-bold text-gray-400 hover:text-black uppercase tracking-widest transition">Support</a>
                <a href="#" class="text-[11px] font-bold text-gray-400 hover:text-black uppercase tracking-widest transition">System Status</a>
            </div>
        </div>
    </footer>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('mobileSidebar');
            const overlay = document.getElementById('mobileOverlay');

            if (sidebar.classList.contains('-translate-x-full')) {
                // Open
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.remove('hidden');
            } else {
                // Close
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
            }
        }

        document.getElementById('mobileOverlay').addEventListener('click', toggleSidebar);
    </script>

</body>
</html>