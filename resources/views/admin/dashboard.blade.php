@extends('layouts.admin')

@section('title', 'SNEAKER DASHBOARD')

@section('content')
    <div class="min-h-screen bg-gray-50/50 pb-10">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-8">

            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800 tracking-tight">Dashboard Overview</h1>
                    <p class="text-sm text-gray-500">Welcome back, here's what's happening with your store today.</p>
                </div>
                <div class="flex items-center gap-3">
                    <button
                        class="px-4 py-2 bg-white border border-gray-200 text-sm font-medium text-gray-600 rounded-lg hover:bg-gray-50 transition-colors">
                        Download Report
                    </button>
                    <button
                        class="px-4 py-2 bg-[#111] text-white text-sm font-medium rounded-lg hover:bg-black transition-colors shadow-lg shadow-gray-200">
                        + Add New Kicks
                    </button>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div
                    class="bg-white p-6 rounded-2xl shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] border border-gray-100 relative overflow-hidden group">
                    <div class="absolute right-0 top-0 h-full w-1 bg-gradient-to-b from-blue-500 to-blue-600"></div>
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Total Revenue</p>
                            <h3 class="text-2xl font-bold text-gray-800 mt-1">Rp 45.2M</h3>
                        </div>
                        <div class="p-2 bg-blue-50 rounded-lg text-blue-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                </path>
                            </svg>
                        </div>
                    </div>
                    <div class="flex items-center text-xs">
                        <span class="text-green-500 flex items-center font-bold bg-green-50 px-1.5 py-0.5 rounded mr-2">
                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                            </svg>
                            +12.5%
                        </span>
                        <span class="text-gray-400">vs last month</span>
                    </div>
                </div>

                <div
                    class="bg-white p-6 rounded-2xl shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] border border-gray-100 relative overflow-hidden">
                    <div class="absolute right-0 top-0 h-full w-1 bg-gradient-to-b from-purple-500 to-purple-600"></div>
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Pairs Sold</p>
                            <h3 class="text-2xl font-bold text-gray-800 mt-1">1,420</h3>
                        </div>
                        <div class="p-2 bg-purple-50 rounded-lg text-purple-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="flex items-center text-xs">
                        <span class="text-green-500 flex items-center font-bold bg-green-50 px-1.5 py-0.5 rounded mr-2">
                            +8.2%
                        </span>
                        <span class="text-gray-400">vs last month</span>
                    </div>
                </div>

                <div
                    class="bg-white p-6 rounded-2xl shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] border border-gray-100 relative overflow-hidden">
                    <div class="absolute right-0 top-0 h-full w-1 bg-gradient-to-b from-orange-500 to-orange-600"></div>
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Orders Pending</p>
                            <h3 class="text-2xl font-bold text-gray-800 mt-1">12</h3>
                        </div>
                        <div class="p-2 bg-orange-50 rounded-lg text-orange-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="flex items-center text-xs">
                        <span class="text-orange-500 font-bold bg-orange-50 px-1.5 py-0.5 rounded mr-2">Action Needed</span>
                        <span class="text-gray-400">Shipment</span>
                    </div>
                </div>

                <div
                    class="bg-white p-6 rounded-2xl shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] border border-gray-100 relative overflow-hidden">
                    <div class="absolute right-0 top-0 h-full w-1 bg-gradient-to-b from-teal-500 to-teal-600"></div>
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Total SKU</p>
                            <h3 class="text-2xl font-bold text-gray-800 mt-1">2,340</h3>
                        </div>
                        <div class="p-2 bg-teal-50 rounded-lg text-teal-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                                </path>
                            </svg>
                        </div>
                    </div>
                    <div class="flex items-center text-xs">
                        <span class="text-gray-500 font-bold bg-gray-100 px-1.5 py-0.5 rounded mr-2">24 New</span>
                        <span class="text-gray-400">Added this week</span>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100 flex flex-col">
                    <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                        <h3 class="font-bold text-lg text-gray-800">Top Selling Kicks</h3>
                        <a href="#" class="text-xs font-semibold text-blue-600 hover:text-blue-700">View All
                            Inventory</a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="text-xs text-gray-400 border-b border-gray-50">
                                    <th class="font-semibold px-6 py-4 uppercase tracking-wider">Product</th>
                                    <th class="font-semibold px-6 py-4 uppercase tracking-wider">Brand</th>
                                    <th class="font-semibold px-6 py-4 uppercase tracking-wider">Stock</th>
                                    <th class="font-semibold px-6 py-4 uppercase tracking-wider text-right">Price</th>
                                    <th class="font-semibold px-6 py-4 uppercase tracking-wider text-right">Sold</th>
                                </tr>
                            </thead>
                            <tbody class="text-sm">
                                @php
                                    $products = [
                                        [
                                            'name' => 'Niken Air Jordan 1 High',
                                            'brand' => 'Niken',
                                            'price' => '2.499.000',
                                            'stock' => 12,
                                            'sold' => 450,
                                            'color' => 'bg-red-500',
                                        ],
                                        [
                                            'name' => 'Adidas Yeezy Boost 350',
                                            'brand' => 'Adidas',
                                            'price' => '3.800.000',
                                            'stock' => 4,
                                            'sold' => 320,
                                            'color' => 'bg-gray-800',
                                        ],
                                        [
                                            'name' => 'New Balance 550',
                                            'brand' => 'NB',
                                            'price' => '1.899.000',
                                            'stock' => 28,
                                            'sold' => 210,
                                            'color' => 'bg-green-600',
                                        ],
                                        [
                                            'name' => 'Vans Old Skool Pro',
                                            'brand' => 'Vans',
                                            'price' => '999.000',
                                            'stock' => 0,
                                            'sold' => 180,
                                            'color' => 'bg-black',
                                        ],
                                    ];
                                @endphp

                                @foreach ($products as $product)
                                    <tr
                                        class="group hover:bg-gray-50 transition-colors border-b border-gray-50 last:border-0">
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-4">
                                                <div
                                                    class="w-12 h-12 rounded-lg bg-gray-100 flex items-center justify-center relative overflow-hidden">
                                                    <div class="absolute inset-0 opacity-10 {{ $product['color'] }}"></div>
                                                    <svg class="w-6 h-6 text-gray-400" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="1.5"
                                                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                                    </svg>
                                                </div>
                                                <div>
                                                    <p class="font-bold text-gray-800">{{ $product['name'] }}</p>
                                                    <p class="text-xs text-gray-400">SKU-202{{ $loop->iteration }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-gray-600 font-medium">{{ $product['brand'] }}</td>
                                        <td class="px-6 py-4">
                                            @if ($product['stock'] == 0)
                                                <span
                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                    Out of Stock
                                                </span>
                                            @elseif($product['stock'] < 10)
                                                <span
                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-orange-100 text-orange-800">
                                                    Low: {{ $product['stock'] }}
                                                </span>
                                            @else
                                                <span
                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                    In Stock: {{ $product['stock'] }}
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 text-right font-mono font-medium text-gray-700">Rp
                                            {{ $product['price'] }}</td>
                                        <td class="px-6 py-4 text-right font-bold text-gray-800">{{ $product['sold'] }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="space-y-8">

                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                        <h3 class="font-bold text-lg text-gray-800 mb-6">Live Sales Feed</h3>
                        <div class="space-y-6 relative">
                            <div class="absolute left-3 top-2 bottom-2 w-0.5 bg-gray-100"></div>

                            @for ($i = 0; $i < 3; $i++)
                                <div class="relative pl-8">
                                    <div
                                        class="absolute left-0 top-1 w-6 h-6 rounded-full bg-indigo-50 border-2 border-white shadow-sm flex items-center justify-center z-10">
                                        <svg class="w-3 h-3 text-indigo-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                        </svg>
                                    </div>
                                    <p class="text-xs font-mono text-gray-400 mb-1">Just Now</p>
                                    <p class="text-sm font-medium text-gray-800"><span class="font-bold">Budi
                                            Santoso</span> bought <span class="text-indigo-600 font-bold">Niken Dunk
                                            Low</span></p>
                                    <p class="text-xs text-gray-500 mt-0.5">Size: 42 • Rp 1.600.000</p>
                                </div>
                            @endfor
                        </div>
                        <button
                            class="w-full mt-6 py-2 text-xs font-bold text-gray-500 uppercase tracking-wide hover:text-gray-800 transition-colors">View
                            All Orders</button>
                    </div>

                    <div class="bg-[#1a1a1a] rounded-2xl shadow-lg p-6 text-white relative overflow-hidden">
                        <div class="absolute -right-4 -top-4 w-24 h-24 rounded-full bg-white opacity-5"></div>
                        <div class="absolute right-10 bottom-4 w-12 h-12 rounded-full bg-indigo-500 opacity-20"></div>

                        <h3 class="font-bold text-lg mb-4">Brand Performance</h3>
                        <div class="space-y-4">
                            <div>
                                <div class="flex justify-between text-xs mb-1">
                                    <span class="text-gray-400">Niken</span>
                                    <span class="font-mono">65%</span>
                                </div>
                                <div class="w-full bg-gray-700 h-1.5 rounded-full overflow-hidden">
                                    <div class="bg-white h-full w-[65%]"></div>
                                </div>
                            </div>
                            <div>
                                <div class="flex justify-between text-xs mb-1">
                                    <span class="text-gray-400">Adidas</span>
                                    <span class="font-mono">20%</span>
                                </div>
                                <div class="w-full bg-gray-700 h-1.5 rounded-full overflow-hidden">
                                    <div class="bg-gray-400 h-full w-[20%]"></div>
                                </div>
                            </div>
                            <div>
                                <div class="flex justify-between text-xs mb-1">
                                    <span class="text-gray-400">Others</span>
                                    <span class="font-mono">15%</span>
                                </div>
                                <div class="w-full bg-gray-700 h-1.5 rounded-full overflow-hidden">
                                    <div class="bg-indigo-500 h-full w-[15%]"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection
