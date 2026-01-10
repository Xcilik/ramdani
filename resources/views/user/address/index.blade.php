@extends('layouts.app')

@section('content')
    <div class="max-w-5xl mx-auto px-4 py-12 font-sans text-[#1a1a1a]">

        {{-- HEADER SECTION --}}
        <div
            class="flex flex-col md:flex-row justify-between items-start md:items-end mb-10 border-b-2 border-[#1a1a1a] pb-6 gap-4">
            <div>
                <span class="font-mono text-xs text-gray-400 block mb-1">USER // ACCOUNT_SETTINGS</span>
                <h1 class="text-3xl md:text-4xl font-black uppercase tracking-tighter leading-none">
                    Buku Alamat
                </h1>
            </div>

            <a href="{{ route('user.addresses.create') }}"
                class="group relative inline-flex items-center justify-center px-6 py-3 text-xs font-bold text-white transition-all duration-200 bg-[#1a1a1a] font-mono uppercase tracking-widest hover:bg-[#EB0000] hover:text-white focus:outline-none ring-offset-2 focus:ring-2 ring-black">
                + Tambah Alamat
            </a>
        </div>

        {{-- NOTIFICATION --}}
        @if (session('success'))
            <div class="mb-8 p-4 bg-gray-50 border-l-4 border-[#1a1a1a] flex items-center justify-between">
                <span class="text-sm font-bold uppercase tracking-wide text-gray-800">
                    {{ session('success') }}
                </span>
                <button onclick="this.parentElement.remove()"
                    class="text-xs font-bold text-gray-400 hover:text-black">X</button>
            </div>
        @endif

        {{-- ADDRESS GRID --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @forelse($addresses as $address)
                <div
                    class="group border border-gray-300 bg-white p-6 relative hover:border-[#1a1a1a] transition-all duration-300">

                    {{-- Decorative Corner (Industrial Look) --}}
                    <div
                        class="absolute top-0 right-0 w-3 h-3 border-t border-r border-transparent group-hover:border-[#EB0000] transition-colors">
                    </div>

                    <div class="flex justify-between items-start mb-4">
                        <h3 class="text-lg font-black uppercase tracking-wide text-[#1a1a1a]">
                            {{ $address->name }}
                        </h3>
                        <span class="font-mono text-[10px] text-gray-400 border border-gray-200 px-2 py-0.5">
                            ID: {{ substr(md5($address->id), 0, 4) }}
                        </span>
                    </div>

                    {{-- Address Details --}}
                    <div class="space-y-1 mb-8">
                        <p class="font-mono text-xs text-gray-500 uppercase tracking-wider mb-1">Phone Contact</p>
                        <p class="text-sm font-bold text-gray-900 mb-3">{{ $address->phone }}</p>

                        <p class="font-mono text-xs text-gray-500 uppercase tracking-wider mb-1">Shipping Address</p>
                        <p class="text-sm text-gray-800 leading-relaxed">
                            {{ $address->address }}<br>
                            {{ $address->city }}, {{ $address->province }}<br>
                            <span class="font-bold">Postal Code: {{ $address->postal_code }}</span>
                        </p>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="pt-4 border-t border-gray-100 flex items-center gap-6">
                        <a href="{{ route('user.addresses.edit', $address->id) }}"
                            class="text-xs font-bold uppercase tracking-widest text-[#1a1a1a] hover:text-gray-500 underline decoration-2 underline-offset-4">
                            Edit Data
                        </a>

                        <form action="{{ route('user.addresses.destroy', $address->id) }}" method="POST"
                            onsubmit="return confirm('Hapus alamat ini permanen?')">
                            @csrf @method('DELETE')
                            <button type="submit"
                                class="text-xs font-bold uppercase tracking-widest text-gray-400 hover:text-[#EB0000] underline decoration-2 underline-offset-4">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                {{-- Empty State --}}
                <div class="col-span-1 md:col-span-2 py-20 text-center border-2 border-dashed border-gray-200 bg-gray-50">
                    <p class="font-mono text-xs text-gray-400 mb-4">NO DATA FOUND</p>
                    <h3 class="text-xl font-bold text-gray-800 uppercase tracking-tight mb-2">Belum ada alamat tersimpan
                    </h3>
                    <p class="text-gray-500 text-sm mb-6">Tambahkan alamat pengiriman untuk mempercepat proses checkout.</p>

                    <a href="{{ route('user.addresses.create') }}"
                        class="inline-block border-b-2 border-[#1a1a1a] pb-0.5 text-sm font-bold uppercase tracking-widest hover:text-[#EB0000] hover:border-[#EB0000] transition-colors">
                        Buat Alamat Baru &rarr;
                    </a>
                </div>
            @endforelse
        </div>

        {{-- Back Link --}}
        <div class="mt-12">
            <a href="{{ route('home') }}"
                class="text-[10px] font-bold uppercase tracking-widest text-gray-400 hover:text-[#1a1a1a]">
                &larr; Kembali ke Beranda
            </a>
        </div>

    </div>
@endsection
