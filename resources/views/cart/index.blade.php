@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-50/50 pb-20 pt-8 font-sans text-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- HEADER --}}
            <div class="flex items-end justify-between mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Shopping Bag</h1>
                    <p class="text-sm text-gray-500 mt-1">
                        You have <span class="font-bold text-indigo-600">{{ collect($cart)->sum('qty') }} items</span> in your cart
                    </p>
                </div>
                <div class="hidden md:block">
                    <a href="{{ route('home') }}" class="text-sm font-medium text-gray-500 hover:text-indigo-600 transition-colors flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                        Continue Shopping
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12">

                {{-- LEFT COLUMN: CART ITEMS --}}
                <div class="lg:col-span-8">
                    <div class="bg-white rounded-2xl shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] border border-gray-100 overflow-hidden">
                        
                        {{-- Table Header (Desktop) --}}
                        <div class="hidden md:grid grid-cols-12 gap-4 px-8 py-4 bg-gray-50/50 border-b border-gray-100 text-xs font-semibold uppercase tracking-wider text-gray-400">
                            <div class="col-span-6">Product Details</div>
                            <div class="col-span-3 text-center">Quantity</div>
                            <div class="col-span-3 text-right">Total</div>
                        </div>

                        <div class="divide-y divide-gray-50">
                            @forelse ($cart as $item)
                                <div class="p-6 md:p-8 hover:bg-gray-50/50 transition-colors group">
                                    <div class="grid grid-cols-1 md:grid-cols-12 gap-6 items-center">

                                        {{-- Product Info --}}
                                        <div class="md:col-span-6 flex gap-6">
                                            {{-- Image --}}
                                            <div class="w-24 h-24 flex-shrink-0 rounded-xl bg-gray-100 border border-gray-200 overflow-hidden relative">
                                                @if (!empty($item['image']))
                                                    <img src="{{ asset('storage/' . $item['image']) }}"
                                                        alt="{{ $item['product_name'] }}" class="w-full h-full object-cover">
                                                @else
                                                    <div class="w-full h-full flex items-center justify-center text-gray-300">
                                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="flex flex-col justify-center">
                                                <h3 class="font-bold text-gray-900 text-base mb-1">
                                                    {{ $item['product_name'] }}
                                                </h3>
                                                <p class="text-xs text-gray-500 font-mono mb-2">Variant ID: {{ $item['variant_id'] }}</p>
                                                <p class="text-sm font-medium text-gray-900">Rp {{ number_format($item['price']) }}</p>
                                                
                                                {{-- Mobile Remove --}}
                                                <form action="{{ route('cart.remove', $item['variant_id']) }}" method="POST" class="md:hidden mt-3">
                                                    @csrf @method('DELETE')
                                                    <button class="text-xs text-red-500 hover:text-red-700 font-medium flex items-center gap-1">
                                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                        Remove
                                                    </button>
                                                </form>
                                            </div>
                                        </div>

                                        {{-- Quantity Selector --}}
                                        <div class="md:col-span-3 flex justify-start md:justify-center">
                                            <form action="{{ route('cart.update') }}" method="POST" class="flex items-center bg-gray-100 rounded-lg p-1">
                                                @csrf
                                                <input type="hidden" name="variant_id" value="{{ $item['variant_id'] }}">
                                                
                                                <button name="qty" value="{{ $item['qty'] - 1 }}"
                                                    class="w-8 h-8 flex items-center justify-center bg-white rounded-md text-gray-600 hover:text-black shadow-sm transition-all disabled:opacity-50">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path></svg>
                                                </button>
                                                
                                                <span class="w-10 text-center font-bold text-sm text-gray-800">{{ $item['qty'] }}</span>
                                                
                                                <button name="qty" value="{{ $item['qty'] + 1 }}"
                                                    class="w-8 h-8 flex items-center justify-center bg-white rounded-md text-gray-600 hover:text-black shadow-sm transition-all">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                                </button>
                                            </form>
                                        </div>

                                        {{-- Subtotal & Remove --}}
                                        <div class="md:col-span-3 text-right">
                                            <p class="font-bold text-gray-900 text-lg">
                                                Rp {{ number_format($item['price'] * $item['qty']) }}
                                            </p>
                                            
                                            <form action="{{ route('cart.remove', $item['variant_id']) }}" method="POST" class="hidden md:block mt-2">
                                                @csrf @method('DELETE')
                                                <button class="text-xs text-gray-400 hover:text-red-500 transition-colors p-1" title="Remove Item">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                </button>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            @empty
                                <div class="py-20 text-center">
                                    <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                        <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                                    </div>
                                    <h3 class="text-lg font-bold text-gray-900">Your bag is empty</h3>
                                    <p class="text-gray-500 mb-6 mt-1">Looks like you haven't added any kicks yet.</p>
                                    <a href="{{ route('home') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-sm font-bold rounded-xl shadow-sm text-white bg-black hover:bg-gray-800 transition-all">
                                        Start Shopping
                                    </a>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                {{-- RIGHT COLUMN: SUMMARY --}}
                <div class="lg:col-span-4">
                    <div class="bg-white rounded-2xl shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] border border-gray-100 p-6 sticky top-8">
                        <h2 class="font-bold text-lg text-gray-900 mb-6">Order Summary</h2>

                        {{-- ADDRESS SELECTOR --}}
                        <div class="mb-6">
                            <div class="flex justify-between items-center mb-2">
                                <label class="text-xs font-bold text-gray-500 uppercase tracking-wide">Shipping Address</label>
                                @php
                                    $routeAdd = auth()->user()->hasRole('admin') ? route('admin.addresses.create') : route('user.addresses.create');
                                @endphp
                                <a href="{{ $routeAdd }}" class="text-xs font-bold text-indigo-600 hover:text-indigo-800 transition-colors">+ New Address</a>
                            </div>
                            
                            <div class="relative">
                                <select id="addressSelector" class="w-full appearance-none bg-gray-50 border-transparent focus:bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 rounded-xl text-sm p-3 pr-10 outline-none transition-all cursor-pointer font-medium">
                                    <option value="">Select Delivery Location...</option>
                                    @foreach ($addresses as $addr)
                                        <option value="{{ $addr->id }}">{{ $addr->name }} ({{ $addr->city }})</option>
                                    @endforeach
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-500">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </div>
                            </div>
                        </div>

                        {{-- COST BREAKDOWN --}}
                        <div class="space-y-3 py-4 border-t border-gray-50">
                            <div class="flex justify-between text-sm text-gray-600">
                                <span>Subtotal ({{ collect($cart)->sum('qty') }} items)</span>
                                <span class="font-medium">Rp {{ number_format(collect($cart)->sum(fn($i) => $i['price'] * $i['qty'])) }}</span>
                            </div>
                            <div class="flex justify-between text-sm text-gray-600">
                                <span>Shipping Cost</span>
                                <span class="text-xs bg-gray-100 text-gray-500 px-2 py-0.5 rounded">Calculated at checkout</span>
                            </div>
                        </div>

                        {{-- TOTAL --}}
                        <div class="flex justify-between items-center py-4 border-t border-gray-100 mb-6">
                            <span class="text-base font-bold text-gray-900">Total</span>
                            <span class="text-xl font-black text-indigo-600">
                                Rp {{ number_format(collect($cart)->sum(fn($i) => $i['price'] * $i['qty'])) }}
                            </span>
                        </div>

                        {{-- CHECKOUT BUTTON --}}
                        <button id="payButton" type="button"
                            class="w-full bg-[#111] hover:bg-black text-white py-4 rounded-xl font-bold text-sm uppercase tracking-wider shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition-all disabled:opacity-50 disabled:cursor-not-allowed disabled:shadow-none disabled:transform-none flex justify-center items-center gap-2"
                            {{ empty($cart) ? 'disabled' : '' }}>
                            <span>Pay Now</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </button>

                        {{-- TRUST BADGES --}}
                        <div class="mt-6 flex flex-col gap-2 text-xs text-gray-400 text-center">
                            <p>Tax included. Secure checkout powered by Midtrans.</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- MIDTRANS SNAP JS --}}
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('services.midtrans.clientKey') }}"></script>

    <script>
        document.getElementById('payButton')?.addEventListener('click', function(e) {
            e.preventDefault();
            const addressId = document.getElementById('addressSelector').value;

            if (!addressId) {
                alert('Please select a shipping address first!');
                // Optional: Highlight select box
                document.getElementById('addressSelector').focus();
                return;
            }

            const btn = this;
            const originalContent = btn.innerHTML;
            btn.innerHTML = `<svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Processing...`;
            btn.disabled = true;

            fetch("{{ route('checkout.store') }}", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    "Content-Type": "application/json",
                    "Accept": "application/json"
                },
                body: JSON.stringify({
                    address_id: addressId
                })
            })
            .then(async res => {
                const data = await res.json();
                if (!res.ok) throw new Error(data.error || 'Server Error');
                return data;
            })
            .then(data => {
                snap.pay(data.snap_token, {
                    onSuccess: function(result) {
                        window.location.href = '/';
                    },
                    onPending: function(result) {
                        alert("Waiting for payment...");
                        location.reload();
                    },
                    onError: function(result) {
                        alert("Payment failed!");
                        resetButton();
                    },
                    onClose: function() {
                        resetButton();
                    }
                });
            })
            .catch(err => {
                alert(err.message);
                resetButton();
            });

            function resetButton() {
                btn.innerHTML = originalContent;
                btn.disabled = false;
            }
        });
    </script>
@endsection