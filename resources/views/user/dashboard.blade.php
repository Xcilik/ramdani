@extends('layouts.app')

@section('title', 'My Account')

@section('content')
    <div class="min-h-screen bg-gray-50/50 pb-20 pt-8 font-sans text-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="flex flex-col md:flex-row gap-8 lg:gap-12">
                
                {{-- SIDEBAR NAV --}}
                <aside class="w-full md:w-72 flex-shrink-0">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sticky top-24">
                        
                        {{-- User Mini Profile --}}
                        <div class="flex items-center gap-4 mb-8 pb-8 border-b border-gray-50">
                            <div class="w-12 h-12 rounded-full bg-gray-100 flex items-center justify-center text-gray-400">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-gray-900">{{ auth()->user()->name ?? 'Guest User' }}</p>
                                <p class="text-xs text-gray-500">Member since 2025</p>
                            </div>
                        </div>

                        <nav class="space-y-2">
                            <a href="#" class="flex items-center gap-3 px-4 py-3 text-sm font-bold text-indigo-600 bg-indigo-50 rounded-xl transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                                Dashboard
                            </a>
                            <a href="#" class="flex items-center gap-3 px-4 py-3 text-sm font-medium text-gray-600 hover:bg-gray-50 hover:text-gray-900 rounded-xl transition-colors">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                                My Orders
                            </a>
                            <a href="#" class="flex items-center gap-3 px-4 py-3 text-sm font-medium text-gray-600 hover:bg-gray-50 hover:text-gray-900 rounded-xl transition-colors">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                Shipping Address
                            </a>
                            
                            <div class="pt-6 mt-6 border-t border-gray-50">
                                <form action="#" method="POST">
                                    @csrf
                                    <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 text-sm font-bold text-red-500 hover:bg-red-50 rounded-xl transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                        Sign Out
                                    </button>
                                </form>
                            </div>
                        </nav>
                    </div>
                </aside>

                {{-- MAIN CONTENT --}}
                <div class="flex-1 space-y-8">
                    
                    {{-- WELCOME BANNER --}}
                    <section class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100 relative overflow-hidden">
                        <div class="relative z-10 max-w-lg">
                            <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Welcome back, {{ auth()->user()->name ?? 'Fam' }}! 👋</h1>
                            <p class="text-sm text-gray-500 mt-2 leading-relaxed">
                                Good to see you again. Check your latest order status or update your profile information here.
                            </p>
                        </div>
                        {{-- Decorative Blob --}}
                        <div class="absolute right-0 top-0 w-64 h-64 bg-indigo-50 rounded-full blur-3xl opacity-50 translate-x-1/3 -translate-y-1/3"></div>
                    </section>

                    {{-- STATS GRID --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        {{-- Card 1 --}}
                        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-start justify-between">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wider text-gray-400">Total Orders</p>
                                <p class="text-3xl font-bold text-gray-900 mt-2">12</p>
                            </div>
                            <div class="p-2 bg-gray-50 rounded-lg text-gray-400">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                            </div>
                        </div>

                        {{-- Card 2 --}}
                        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-start justify-between">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wider text-gray-400">Unpaid</p>
                                <p class="text-3xl font-bold text-orange-500 mt-2">1</p>
                            </div>
                            <div class="p-2 bg-orange-50 rounded-lg text-orange-500">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                        </div>

                        {{-- Card 3 --}}
                        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-start justify-between">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wider text-gray-400">Points</p>
                                <p class="text-3xl font-bold text-indigo-600 mt-2">2.5k</p>
                            </div>
                            <div class="p-2 bg-indigo-50 rounded-lg text-indigo-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
                            </div>
                        </div>
                    </div>

                    {{-- RECENT ORDERS TABLE --}}
                    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                        <div class="p-6 border-b border-gray-50 flex justify-between items-center bg-gray-50/50">
                            <h3 class="text-base font-bold text-gray-900">Recent Orders</h3>
                            <a href="#" class="text-xs font-bold text-indigo-600 hover:text-indigo-800 transition-colors">View All History</a>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left">
                                <thead>
                                    <tr class="text-xs font-semibold text-gray-400 uppercase tracking-wider border-b border-gray-50">
                                        <th class="px-6 py-4">Order ID</th>
                                        <th class="px-6 py-4">Date</th>
                                        <th class="px-6 py-4">Status</th>
                                        <th class="px-6 py-4 text-right">Total</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-50 text-sm">
                                    <tr class="group hover:bg-gray-50/80 transition-colors">
                                        <td class="px-6 py-4 font-bold text-gray-900">#INV-99021</td>
                                        <td class="px-6 py-4 text-gray-500">24 Dec 2025</td>
                                        <td class="px-6 py-4">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-50 text-indigo-700">
                                                Shipped
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-right font-medium text-gray-900">Rp 599.000</td>
                                    </tr>
                                    <tr class="group hover:bg-gray-50/80 transition-colors">
                                        <td class="px-6 py-4 font-bold text-gray-900">#INV-98812</td>
                                        <td class="px-6 py-4 text-gray-500">12 Dec 2025</td>
                                        <td class="px-6 py-4">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-50 text-green-700">
                                                Completed
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-right font-medium text-gray-900">Rp 1.250.000</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection