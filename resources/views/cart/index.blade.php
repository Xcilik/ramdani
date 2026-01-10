@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 py-12 font-sans text-gray-900">
        {{-- HEADER --}}
        <h1 class="text-2xl md:text-3xl font-bold mb-8 uppercase tracking-widest border-b border-gray-900 pb-4">
            Keranjang Belanja <span class="text-gray-500 text-lg font-normal ml-2">({{ collect($cart)->sum('qty') }}
                item)</span>
        </h1>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">

            {{-- LEFT COLUMN: CART ITEMS --}}
            <div class="lg:col-span-8">
                <div class="w-full">
                    {{-- Table Header (Hidden on mobile) --}}
                    <div
                        class="hidden md:grid grid-cols-12 gap-4 text-xs font-bold uppercase text-gray-500 mb-4 tracking-wider">
                        <div class="col-span-6">Produk</div>
                        <div class="col-span-3 text-center">Jumlah</div>
                        <div class="col-span-3 text-right">Subtotal</div>
                    </div>

                    @forelse ($cart as $item)
                        <div class="border-t border-gray-200 py-6 group">
                            <div class="grid grid-cols-1 md:grid-cols-12 gap-6 items-center">

                                {{-- Product Info --}}
                                <div class="md:col-span-6 flex gap-4">
                                    {{-- Placeholder Image (Uniqlo style always has images, consider adding one if available) --}}
                                    {{-- GANTI BAGIAN PLACEHOLDER 'IMG' DENGAN KODE INI --}}
                                    <div class="w-20 h-20 flex-shrink-0 border border-gray-200 bg-white">
                                        @if (!empty($item['image']))
                                            <img src="{{ asset('storage/' . $item['image']) }}"
                                                alt="{{ $item['product_name'] }}" class="w-full h-full object-cover">
                                        @else
                                            {{-- Fallback jika produk tidak punya gambar --}}
                                            <div
                                                class="w-full h-full flex items-center justify-center bg-gray-100 text-gray-400">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                    </path>
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-gray-900 uppercase tracking-wide text-sm md:text-base">
                                            {{ $item['product_name'] }}</h3>
                                        <p class="text-gray-500 text-xs mt-1">ID Variant: {{ $item['variant_id'] }}</p>
                                        <p class="text-gray-900 font-medium mt-2">Rp {{ number_format($item['price']) }}</p>

                                        {{-- Remove Button (Mobile only) --}}
                                        <form action="{{ route('cart.remove', $item['variant_id']) }}" method="POST"
                                            class="md:hidden mt-3">
                                            @csrf @method('DELETE')
                                            <button
                                                class="text-xs text-gray-400 underline hover:text-red-600 uppercase tracking-wider">Hapus</button>
                                        </form>
                                    </div>
                                </div>

                                {{-- Quantity Selector --}}
                                <div class="md:col-span-3 flex justify-start md:justify-center">
                                    <form action="{{ route('cart.update') }}" method="POST"
                                        class="flex items-center border border-gray-300">
                                        @csrf
                                        <input type="hidden" name="variant_id" value="{{ $item['variant_id'] }}">
                                        <button name="qty" value="{{ $item['qty'] - 1 }}"
                                            class="w-10 h-10 flex items-center justify-center text-gray-600 hover:bg-gray-100 transition text-xl font-light">−</button>
                                        <span
                                            class="w-12 h-10 flex items-center justify-center font-bold text-sm border-x border-gray-300">{{ $item['qty'] }}</span>
                                        <button name="qty" value="{{ $item['qty'] + 1 }}"
                                            class="w-10 h-10 flex items-center justify-center text-gray-600 hover:bg-gray-100 transition text-xl font-light">+</button>
                                    </form>
                                </div>

                                {{-- Subtotal & Desktop Remove --}}
                                <div class="md:col-span-3 text-right">
                                    <p class="font-bold text-gray-900 text-lg">Rp
                                        {{ number_format($item['price'] * $item['qty']) }}</p>
                                    <form action="{{ route('cart.remove', $item['variant_id']) }}" method="POST"
                                        class="hidden md:block mt-2">
                                        @csrf @method('DELETE')
                                        <button
                                            class="text-xs text-gray-400 underline hover:text-red-600 uppercase tracking-wider">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="py-16 text-center bg-gray-50 border border-gray-100">
                            <p class="text-gray-500 mb-4 text-sm uppercase tracking-wide">Keranjang Anda saat ini kosong.
                            </p>
                            <a href="{{ route('home') }}"
                                class="inline-block bg-black text-white px-8 py-3 text-sm font-bold uppercase tracking-widest hover:opacity-80 transition">
                                Lanjut Belanja
                            </a>
                        </div>
                    @endforelse
                </div>

                {{-- Back to shop link --}}
                @if (count($cart) > 0)
                    <div class="mt-8">
                        <a href="{{ route('home') }}"
                            class="text-sm font-bold underline hover:text-gray-600 uppercase tracking-wide">← Kembali
                            Berbelanja</a>
                    </div>
                @endif
            </div>


            {{-- RIGHT COLUMN: SUMMARY --}}
            <div class="lg:col-span-4">
                <div class="bg-gray-50 p-6 sticky top-6 border border-gray-100">
                    <h2 class="font-bold text-lg uppercase tracking-widest mb-6 border-b border-gray-300 pb-2">Ringkasan
                        Pesanan</h2>

                    {{-- PILIH ALAMAT --}}
                    <div class="mb-6">
                        <label class="block text-xs font-bold text-gray-600 mb-2 uppercase tracking-wide">Alamat
                            Pengiriman</label>
                        <div class="relative">
                            <select id="addressSelector"
                                class="w-full appearance-none bg-white border border-gray-300 text-gray-900 text-sm p-3 pr-8 focus:outline-none focus:border-black rounded-none">
                                <option value="">-- PILIH ALAMAT --</option>
                                @foreach ($addresses as $addr)
                                    <option value="{{ $addr->id }}">
                                        {{ $addr->name }} ({{ $addr->city }})
                                    </option>
                                @endforeach
                            </select>
                            <div
                                class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                </svg>
                            </div>
                        </div>

                        <div class="mt-3 text-right">
                            @php
                                $routeAdd = auth()->user()->hasRole('admin')
                                    ? route('admin.addresses.create')
                                    : route('user.addresses.create');
                            @endphp
                            <a href="{{ $routeAdd }}"
                                class="text-xs font-bold text-black underline hover:text-gray-600 uppercase tracking-wide">
                                + Alamat Baru
                            </a>
                        </div>
                    </div>

                    {{-- Summary Details --}}
                    <div class="space-y-3 mb-8 text-sm">
                        <div class="flex justify-between text-gray-600">
                            <span>Subtotal Barang</span>
                            <span>{{ collect($cart)->sum('qty') }} items</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Biaya Pengiriman</span>
                            <span class="text-xs italic">Dihitung saat checkout</span>
                        </div>
                        <div
                            class="flex justify-between text-xl font-bold text-gray-900 pt-4 border-t border-gray-300 mt-4">
                            <span class="uppercase">Total</span>
                            <span class="text-red-600">Rp
                                {{ number_format(collect($cart)->sum(fn($i) => $i['price'] * $i['qty'])) }}</span>
                        </div>
                    </div>

                    {{-- Checkout Button --}}
                    {{-- Checkout Button --}}
                    <button id="payButton" type="button"
                        class="w-full bg-red-600 hover:bg-red-700 text-white py-4 font-bold text-sm uppercase tracking-widest transition-colors disabled:opacity-50 disabled:cursor-not-allowed rounded-none"
                        {{ empty($cart) ? 'disabled' : '' }}>
                        Bayar Sekarang
                    </button>

                    {{-- Trust Badges / Info --}}
                    <div class="mt-6 border-t border-gray-200 pt-4">
                        <p class="text-xs text-gray-500 leading-relaxed">
                            * Pajak sudah termasuk dalam harga yang ditampilkan.<br>
                            * Pengembalian barang maksimal 30 hari.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- MIDTRANS SNAP JS --}}
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('services.midtrans.clientKey') }}">
    </script>

    <script>
        document.getElementById('payButton')?.addEventListener('click', function(e) {
            e.preventDefault();
            const addressId = document.getElementById('addressSelector').value;

            if (!addressId) {
                alert('Mohon pilih alamat pengiriman terlebih dahulu!');
                return;
            }

            const btn = this;
            const originalText = btn.innerHTML;
            btn.innerHTML = `MEMPROSES...`;
            btn.disabled = true;
            btn.classList.add('opacity-75');

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
                            alert("Menunggu pembayaran...");
                            location.reload();
                        },
                        onError: function(result) {
                            alert("Pembayaran gagal!");
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
                btn.innerHTML = originalText;
                btn.disabled = false;
                btn.classList.remove('opacity-75');
            }
        });
    </script>
@endsection
