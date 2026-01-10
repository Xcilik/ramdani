@extends('layouts.app')

@section('content')
    {{-- CONTAINER: Menggunakan max-w-7xl dan px-4 md:px-6 agar SEJAJAR dengan Header --}}
    <div class="max-w-7xl mx-auto px-4 md:px-6 py-10 text-[#1a1a1a] font-sans">

        {{-- GRID LAYOUT: Kiri (Info/Action) - Kanan (Tabel) --}}
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">

            {{-- KOLOM KIRI: JUDUL, STATS, & TOMBOL TAMBAH (Sticky) --}}
            <div class="lg:col-span-3">
                <div class="sticky top-24 border-t-4 border-[#1a1a1a] pt-4">
                    <span class="font-mono text-xs text-gray-400 block mb-2 uppercase tracking-widest">
                        Database // List
                    </span>

                    <h1 class="text-3xl md:text-4xl font-black uppercase tracking-tighter leading-none mb-4">
                        Manajemen <br>Alamat
                    </h1>

                    {{-- Stats Badge --}}
                    <div class="mb-8 inline-block bg-gray-100 border border-gray-200 px-3 py-1">
                        <p class="font-mono text-[10px] uppercase text-gray-600">
                            Total Entries: <span class="font-bold text-black">{{ count($addresses) }}</span>
                        </p>
                    </div>

                    {{-- Primary Action Button (Moved to Left) --}}
                    <a href="{{ route('admin.addresses.create') }}"
                        class="block w-full text-center py-4 bg-[#1a1a1a] text-white text-xs font-bold uppercase tracking-widest hover:bg-[#EB0000] transition-all ring-offset-2 focus:ring-2 ring-black">
                        + Input Data Baru
                    </a>

                    <p class="text-[10px] text-gray-400 mt-4 leading-relaxed font-mono">
                        * Kelola data pengiriman user dari panel ini. Pastikan menghapus data yang duplikat.
                    </p>
                </div>
            </div>

            {{-- KOLOM KANAN: TABEL DATA --}}
            <div class="lg:col-span-9">

                {{-- ALERT NOTIFICATION --}}
                @if (session('success'))
                    <div class="mb-6 p-4 bg-gray-50 border-l-4 border-[#1a1a1a] flex items-center justify-between">
                        <div>
                            <span class="font-mono text-[10px] text-gray-400 block uppercase">System Message</span>
                            <span class="text-sm font-bold uppercase tracking-wide text-gray-900">
                                {{ session('success') }}
                            </span>
                        </div>
                        <button onclick="this.parentElement.remove()"
                            class="text-xs font-bold text-gray-400 hover:text-black">CLOSE</button>
                    </div>
                @endif

                {{-- TABLE CONTAINER --}}
                <div class="border border-gray-200 bg-white">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">

                            {{-- Table Head --}}
                            <thead>
                                <tr class="bg-[#1a1a1a] text-white">
                                    <th class="p-5 text-[10px] font-mono font-bold uppercase tracking-widest w-1/4">Label /
                                        Penerima</th>
                                    <th class="p-5 text-[10px] font-mono font-bold uppercase tracking-widest w-1/5">Kontak
                                    </th>
                                    <th class="p-5 text-[10px] font-mono font-bold uppercase tracking-widest w-1/3">Detail
                                        Lokasi</th>
                                    <th class="p-5 text-[10px] font-mono font-bold uppercase tracking-widest text-right">
                                        Opsi</th>
                                </tr>
                            </thead>

                            {{-- Table Body --}}
                            <tbody class="divide-y divide-gray-200">
                                @forelse($addresses as $address)
                                    <tr class="group hover:bg-gray-50 transition-colors duration-150">

                                        {{-- Name --}}
                                        <td class="p-5 align-top">
                                            <span class="block font-black text-sm uppercase text-[#1a1a1a] mb-1">
                                                {{ $address->name }}
                                            </span>
                                            <span
                                                class="font-mono text-[10px] text-gray-400 bg-gray-100 px-1 py-0.5 border border-gray-200">
                                                ID: {{ $address->id }}
                                            </span>
                                        </td>

                                        {{-- Phone --}}
                                        <td class="p-5 align-top">
                                            <span class="font-mono text-xs text-gray-600 block">
                                                {{ $address->phone }}
                                            </span>
                                        </td>

                                        {{-- Address --}}
                                        <td class="p-5 align-top">
                                            <p
                                                class="text-xs font-medium text-gray-800 leading-relaxed uppercase line-clamp-2">
                                                {{ $address->address }}
                                            </p>
                                            <div class="mt-2 flex gap-2 font-mono text-[10px] text-gray-500 flex-wrap">
                                                <span>{{ $address->city }}</span>
                                                <span class="text-gray-300">//</span>
                                                <span>{{ $address->province }}</span>
                                            </div>
                                            <div class="mt-1 font-mono text-[10px] font-bold text-black">
                                                Postal: {{ $address->postal_code }}
                                            </div>
                                        </td>

                                        {{-- Actions --}}
                                        <td class="p-5 align-top text-right">
                                            <div class="flex flex-col items-end gap-3">
                                                <a href="{{ route('admin.addresses.edit', $address->id) }}"
                                                    class="text-[10px] font-bold uppercase tracking-widest text-black hover:text-blue-600 underline decoration-2 underline-offset-4">
                                                    Edit
                                                </a>

                                                <form action="{{ route('admin.addresses.destroy', $address->id) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('KONFIRMASI: Hapus data permanen?')">
                                                    @csrf @method('DELETE')
                                                    <button type="submit"
                                                        class="text-[10px] font-bold uppercase tracking-widest text-gray-400 hover:text-[#EB0000] underline decoration-2 underline-offset-4">
                                                        Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="p-16 text-center bg-gray-50">
                                            <div
                                                class="flex flex-col items-center justify-center border-2 border-dashed border-gray-300 p-8 max-w-sm mx-auto">
                                                <span class="font-mono text-xs text-gray-400 mb-2">DATABASE_STATUS:
                                                    EMPTY</span>
                                                <h3 class="text-lg font-bold uppercase text-gray-800">Tidak ada data</h3>
                                                <p class="text-xs text-gray-500 mt-1 mb-6">Database alamat saat ini kosong.
                                                </p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Footer Info --}}
                <div
                    class="mt-4 flex justify-between items-center text-[10px] font-mono text-gray-400 uppercase border-t border-gray-200 pt-4">
                    <span>System v1.0</span>
                    <span>Rendered: {{ now()->format('H:i:s') }}</span>
                </div>
            </div>

        </div>
    </div>
@endsection
