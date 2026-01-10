@extends('layouts.app')

@section('title', 'Akun Saya')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="flex flex-col md:flex-row gap-8">
        
        {{-- SIDEBAR NAV --}}
        <aside class="w-full md:w-64 space-y-1">
            <div class="pb-4 mb-4 border-b border-gray-100">
                <h2 class="text-xs font-black uppercase tracking-widest text-gray-400">Menu Akun</h2>
            </div>
            <a href="#" class="flex items-center px-4 py-3 text-sm font-bold uppercase tracking-tighter bg-black text-white rounded-sm">Dashboard</a>
            <a href="#" class="flex items-center px-4 py-3 text-sm font-bold uppercase tracking-tighter text-gray-600 hover:bg-gray-100 transition rounded-sm">Pesanan Saya</a>
            <a href="#" class="flex items-center px-4 py-3 text-sm font-bold uppercase tracking-tighter text-gray-600 hover:bg-gray-100 transition rounded-sm">Alamat Pengiriman</a>
            <a href="#" class="flex items-center px-4 py-3 text-sm font-bold uppercase tracking-tighter text-red-600 hover:bg-red-50 transition rounded-sm mt-10">Keluar</a>
        </aside>

        {{-- MAIN CONTENT --}}
        <div class="flex-1 space-y-8">
            
            {{-- WELCOME BANNER --}}
            <section class="bg-white p-8 border border-gray-100 shadow-sm relative overflow-hidden">
                <div class="relative z-10">
                    <h1 class="text-2xl font-black uppercase tracking-tighter">Halo, {{ auth()->user()->name ?? 'Pelanggan Setia' }}!</h1>
                    <p class="text-sm text-gray-500 mt-1">Senang melihat Anda kembali. Cek status pesanan terbaru Anda di sini.</p>
                </div>
                <div class="absolute right-0 top-0 h-full w-32 bg-gray-50 -skew-x-12 translate-x-10"></div>
            </section>

            {{-- STATS GRID --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-white p-6 border border-gray-100">
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">Total Pesanan</p>
                    <p class="text-3xl font-black mt-2">12</p>
                </div>
                <div class="bg-white p-6 border border-gray-100">
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">Menunggu Pembayaran</p>
                    <p class="text-3xl font-black mt-2 text-red-600">1</p>
                </div>
                <div class="bg-white p-6 border border-gray-100">
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">Point Reward</p>
                    <p class="text-3xl font-black mt-2 text-indigo-600">2.500</p>
                </div>
            </div>

            {{-- RECENT ORDERS TABLE --}}
            <section class="bg-white border border-gray-100">
                <div class="p-6 border-b border-gray-50 flex justify-between items-center">
                    <h3 class="text-sm font-black uppercase tracking-widest">Pesanan Terakhir</h3>
                    <a href="#" class="text-[10px] font-bold underline uppercase tracking-tighter">Lihat Semua</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-gray-50 text-[10px] font-black uppercase tracking-widest text-gray-400">
                                <th class="px-6 py-4">Order ID</th>
                                <th class="px-6 py-4">Tanggal</th>
                                <th class="px-6 py-4">Status</th>
                                <th class="px-6 py-4 text-right">Total</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50 text-sm italic font-medium">
                            <tr>
                                <td class="px-6 py-4 font-bold not-italic">#INV-99021</td>
                                <td class="px-6 py-4 text-gray-500">24 Des 2025</td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 bg-green-100 text-green-700 text-[10px] font-bold uppercase tracking-tighter rounded-sm">Dikirim</span>
                                </td>
                                <td class="px-6 py-4 text-right font-black not-italic">Rp 599.000</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 font-bold not-italic">#INV-98812</td>
                                <td class="px-6 py-4 text-gray-500">12 Des 2025</td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 bg-gray-100 text-gray-700 text-[10px] font-bold uppercase tracking-tighter rounded-sm">Selesai</span>
                                </td>
                                <td class="px-6 py-4 text-right font-black not-italic">Rp 1.250.000</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>

        </div>
    </div>
</div>
@endsection