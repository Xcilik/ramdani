@extends('layouts.admin')

@section('title', 'OVERVIEW_')

@section('content')
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-0 mb-12 border-2 border-[#1a1a1a] bg-white">
        
        <div class="p-6 border-b-2 lg:border-b-0 lg:border-r-2 border-[#1a1a1a] hover:bg-[#F5F5F5] transition-colors group relative overflow-hidden">
            <span class="absolute top-2 right-2 text-[60px] leading-none text-gray-100 font-black -z-0 group-hover:text-gray-200 transition-colors">01</span>
            <p class="text-[10px] font-bold uppercase tracking-[0.2em] text-gray-500 mb-4 relative z-10">Total Sales</p>
            <div class="flex flex-col relative z-10">
                <span class="font-mono text-xs text-gray-400 mb-1">IDR CURRENCY</span>
                <span class="text-3xl font-black tracking-tight text-[#1a1a1a]">45.2M</span>
            </div>
        </div>

        <div class="p-6 border-b-2 md:border-b-0 md:border-r-2 border-[#1a1a1a] hover:bg-[#F5F5F5] transition-colors group relative">
             <span class="absolute top-2 right-2 text-[60px] leading-none text-gray-100 font-black -z-0 group-hover:text-gray-200 transition-colors">02</span>
            <p class="text-[10px] font-bold uppercase tracking-[0.2em] text-gray-500 mb-4 relative z-10">Product SKU</p>
            <div class="flex flex-col relative z-10">
                <span class="font-mono text-xs text-gray-400 mb-1">ACTIVE ITEMS</span>
                <span class="text-3xl font-black tracking-tight text-[#1a1a1a]">2,340</span>
            </div>
        </div>

        <div class="p-6 border-b-2 md:border-b-0 lg:border-r-2 border-[#1a1a1a] hover:bg-[#F5F5F5] transition-colors group relative">
             <span class="absolute top-2 right-2 text-[60px] leading-none text-gray-100 font-black -z-0 group-hover:text-gray-200 transition-colors">03</span>
            <p class="text-[10px] font-bold uppercase tracking-[0.2em] text-gray-500 mb-4 relative z-10">Orders</p>
            <div class="flex flex-col relative z-10">
                <span class="font-mono text-xs text-gray-400 mb-1">PENDING PROC.</span>
                <span class="text-3xl font-black tracking-tight text-[#EB0000]">12</span>
            </div>
        </div>

         <div class="p-6 bg-[#1a1a1a] text-white flex flex-col justify-between group cursor-pointer hover:bg-[#EB0000] transition-colors">
            <div class="flex justify-between items-start">
                <p class="text-[10px] font-bold uppercase tracking-[0.2em] opacity-70">Quick Action</p>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="square" stroke-linejoin="miter" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            </div>
            <div>
                <p class="text-xl font-bold uppercase leading-none">Add New<br>Product</p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
        
        <div class="lg:col-span-2 space-y-8">
            <div class="flex items-center justify-between border-b-2 border-[#1a1a1a] pb-2">
                <h3 class="text-xl font-black uppercase tracking-tighter">Recent Products</h3>
                <a href="#" class="text-xs font-bold uppercase underline decoration-2 underline-offset-4 hover:text-[#EB0000]">View All</a>
            </div>

            <div class="space-y-4">
                {{-- ITEM LIST STRIP --}}
                @for($i = 1; $i <= 3; $i++)
                <div class="flex items-center gap-6 p-4 border border-gray-200 bg-white hover:border-[#1a1a1a] hover:shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] transition-all duration-200 group">
                    <div class="w-16 h-16 bg-gray-100 flex items-center justify-center border border-gray-300">
                        <span class="text-[10px] font-mono text-gray-400">IMG</span>
                    </div>
                    
                    <div class="flex-1">
                        <div class="flex items-center gap-2 mb-1">
                            <span class="px-1.5 py-0.5 bg-[#EB0000] text-white text-[9px] font-bold uppercase">New</span>
                            <span class="text-[10px] font-mono text-gray-500">SKU-892{{$i}}</span>
                        </div>
                        <h4 class="font-bold text-lg leading-none uppercase group-hover:text-[#EB0000] transition-colors">Oversized Airism Tee</h4>
                        <p class="text-xs text-gray-500 mt-1">Men / Tops / Casual</p>
                    </div>

                    <div class="text-right">
                        <p class="font-mono text-sm font-bold">Rp 199.000</p>
                        <p class="text-[10px] text-green-600 font-bold uppercase">Stock: 45</p>
                    </div>
                </div>
                @endfor
            </div>
        </div>

        <div class="space-y-8">
            <div class="border-2 border-[#1a1a1a] p-6 bg-white">
                <h3 class="text-sm font-black uppercase tracking-widest mb-6 border-b border-gray-200 pb-2">System Log</h3>
                
                <ul class="space-y-4 relative">
                    <div class="absolute left-[5px] top-2 bottom-2 w-[1px] bg-gray-200"></div>

                    <li class="pl-6 relative">
                        <div class="absolute left-0 top-1.5 w-2.5 h-2.5 bg-[#1a1a1a]"></div>
                        <p class="text-[10px] font-mono text-gray-500">10:42 AM</p>
                        <p class="text-xs font-bold uppercase leading-tight mt-0.5">Category Updated</p>
                        <p class="text-[10px] text-gray-400">By Admin User</p>
                    </li>
                    <li class="pl-6 relative">
                        <div class="absolute left-0 top-1.5 w-2.5 h-2.5 bg-gray-300"></div>
                        <p class="text-[10px] font-mono text-gray-500">09:15 AM</p>
                        <p class="text-xs font-bold uppercase leading-tight mt-0.5">New Order #9921</p>
                        <p class="text-[10px] text-gray-400">System Bot</p>
                    </li>
                     <li class="pl-6 relative">
                        <div class="absolute left-0 top-1.5 w-2.5 h-2.5 bg-gray-300"></div>
                        <p class="text-[10px] font-mono text-gray-500">Yesterday</p>
                        <p class="text-xs font-bold uppercase leading-tight mt-0.5">Database Backup</p>
                        <p class="text-[10px] text-gray-400">Automated</p>
                    </li>
                </ul>

                <button class="w-full mt-8 border-2 border-[#1a1a1a] py-3 text-xs font-black uppercase tracking-widest hover:bg-[#1a1a1a] hover:text-white transition-all">
                    View Full Logs
                </button>
            </div>

            <div class="bg-[#1a1a1a] p-6 text-white">
                 <h3 class="text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-4">Storage Usage</h3>
                 <div class="flex items-end gap-2 mb-2">
                     <span class="text-4xl font-mono font-bold">42%</span>
                     <span class="text-xs text-gray-400 mb-1">USED</span>
                 </div>
                 <div class="w-full h-1 bg-gray-700 mt-2">
                     <div class="h-full bg-[#EB0000] w-[42%]"></div>
                 </div>
            </div>
        </div>

    </div>
@endsection