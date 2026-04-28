@extends('layout')

@section('page_title', 'Ringkasan Statistik')

@section('content')

    <main class="flex-1 flex flex-col min-w-0 overflow-hidden bg-[#0a0f1d]">
        <header class="flex items-center justify-between h-20 px-8 bg-[#111827] border-b border-slate-800 shrink-0">
            <div class="flex items-center gap-4">
                <button @click="sidebarOpen = !sidebarOpen" class="text-slate-400 lg:hidden font-bold">MENU</button>
                <h2 class="text-xl font-bold text-white">Inventaris Barang Publikasi</h2>
            </div>
            <button wire:click='openCreate'
                class="px-5 py-2.5 bg-blue-600 hover:bg-blue-500 text-white text-xs font-bold rounded-xl shadow-lg shadow-blue-600/20 uppercase tracking-widest transition-all">
                + Tambah Barang
            </button>
        </header>

        <div class="flex-1 overflow-y-auto p-8 custom-scrollbar">
            <!-- Search & Filter Card -->
            <div class="mb-8 p-6 bg-slate-900 border border-slate-800 rounded-3xl flex flex-wrap gap-4 items-center">
                <div class="relative flex-1 min-w-[300px]">
                    <input type="text" wire:model.live.debaunce.400ms='search'
                        placeholder="Cari Serial Number atau Nama Barang..."
                        class="w-full bg-slate-950 border border-slate-800 rounded-2xl py-3 px-5 text-sm text-white focus:border-blue-500 outline-none">
                </div>
                <select wire:model.live='kategori'
                    class="bg-slate-950 border border-slate-800 rounded-2xl py-3 px-5 text-sm text-slate-400 outline-none focus:border-blue-500">
                    <option value="">Semua Kategori</option>
                    @foreach ($this->kategoris as $kat)
                        <option value="{{ $kat->id }}">{{ $kat->name }}</option>
                    @endforeach
                </select>
                <button
                    class="px-6 py-3 bg-slate-800 text-white text-sm font-bold rounded-2xl hover:bg-slate-700 transition-all">Filter</button>
            </div>

            <!-- Table Content -->
            <div class="bg-slate-900 border border-slate-800 rounded-[2.5rem] overflow-hidden shadow-2xl">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-slate-800/50 text-[11px] uppercase tracking-[0.2em] text-slate-500 font-black">
                            <th class="px-8 py-5">Detail Produk</th>
                            <th class="px-8 py-5">Kategori</th>
                            <th class="px-8 py-5">Stok Aktif</th>
                            <th class="px-8 py-5 text-center">Kondisi</th>
                            <th class="px-8 py-5 text-right">Aksi</th>
                        </tr>
                    </thead>
                    {{-- <tbody class="divide-y divide-slate-800/50">
                        <!-- Contoh Row -->
                        <tr class="group hover:bg-blue-600/[0.02] transition-all">
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-4">
                                    <div
                                        class="w-12 h-12 rounded-2xl bg-blue-600/10 flex items-center justify-center text-blue-500 font-bold italic">
                                        IT</div>
                                    <div>
                                        <p class="font-bold text-white text-base">MacBook Pro M3 Max</p>
                                        <p class="text-[11px] text-slate-500 font-mono tracking-tighter">SN-APPLE-2024-00192
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-6 text-sm font-medium text-slate-400 uppercase tracking-tighter">Workstation
                            </td>
                            <td class="px-8 py-6 italic font-black text-white text-lg">08 <span
                                    class="text-[10px] text-slate-500 not-italic font-medium uppercase ml-1">Unit</span>
                            </td>
                            <td class="px-8 py-6 text-center">
                                <span
                                    class="px-3 py-1 bg-emerald-500/10 text-emerald-500 text-[10px] font-black rounded-full uppercase border border-emerald-500/20">Sangat
                                    Baik</span>
                            </td>
                            <td class="px-8 py-6 text-right">
                                <div class="flex justify-end gap-2">
                                    <button
                                        class="p-2.5 bg-slate-800 text-slate-400 rounded-xl hover:text-blue-500">EDIT</button>
                                    <button
                                        class="p-2.5 bg-slate-800 text-slate-400 rounded-xl hover:text-red-500">HAPUS</button>
                                </div>
                            </td>
                        </tr>
                        <!-- Contoh Row 2 -->
                        <tr class="group hover:bg-blue-600/[0.02] transition-all">
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-4">
                                    <div
                                        class="w-12 h-12 rounded-2xl bg-slate-800 flex items-center justify-center text-slate-500 font-bold italic">
                                        PR</div>
                                    <div>
                                        <p class="font-bold text-white text-base">Logitech MX Master 3S</p>
                                        <p class="text-[11px] text-slate-500 font-mono tracking-tighter">SN-LOGI-8821-X1</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-6 text-sm font-medium text-slate-400 uppercase tracking-tighter">Aksesoris
                            </td>
                            <td class="px-8 py-6 italic font-black text-white text-lg">24 <span
                                    class="text-[10px] text-slate-500 not-italic font-medium uppercase ml-1">Unit</span>
                            </td>
                            <td class="px-8 py-6 text-center">
                                <span
                                    class="px-3 py-1 bg-amber-500/10 text-amber-500 text-[10px] font-black rounded-full uppercase border border-amber-500/20">Ada
                                    Lecet</span>
                            </td>
                            <td class="px-8 py-6 text-right">
                                <div class="flex justify-end gap-2">
                                    <button
                                        class="p-2.5 bg-slate-800 text-slate-400 rounded-xl hover:text-blue-500">EDIT</button>
                                    <button
                                        class="p-2.5 bg-slate-800 text-slate-400 rounded-xl hover:text-red-500">HAPUS</button>
                                </div>
                            </td>
                        </tr>
                    </tbody> --}}
                    <tbody class="divide-y divide-slate-800/50">
                        @forelse($items as $item)
                            <tr class="group hover:bg-blue-600/[0.02] transition-all">
                                <td class="px-8 py-6">
                                    <div class="flex items-center gap-4">
                                        <div
                                            class="w-12 h-12 rounded-2xl bg-blue-600/10 flex items-center justify-center text-blue-500 font-bold italic">
                                            {{ strtoupper(substr($item->category->name ?? 'IT', 0, 2)) }}
                                        </div>
                                        <div>
                                            <p class="font-bold text-white text-base">{{ $item->nama_barang }}</p>
                                            <p class="text-[11px] text-slate-500 font-mono tracking-tighter">
                                                {{ $item->kode_barang }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-6 text-sm font-medium text-slate-400 uppercase tracking-tighter">
                                    {{ $item->category->name ?? '-' }}
                                </td>
                                <td class="px-8 py-6 italic font-black text-white text-lg">
                                    {{ sprintf('%02d', $item->stok) }}
                                    <span
                                        class="text-[10px] text-slate-500 not-italic font-medium uppercase ml-1">Unit</span>
                                </td>
                                <td class="px-8 py-6 text-center">
                                    @php
                                        $kondisiClass = match ($item->kondisi) {
                                            'Baik' => 'bg-emerald-500/10 text-emerald-500 border-emerald-500/20',
                                            'Rusak' => 'bg-red-500/10 text-red-500 border-red-500/20',
                                            'Diperbaiki' => 'bg-amber-500/10 text-amber-500 border-amber-500/20',
                                            default => 'bg-slate-500/10 text-slate-500 border-slate-500/20',
                                        };
                                    @endphp
                                    <span
                                        class="px-3 py-1 {{ $kondisiClass }} text-[10px] font-black rounded-full uppercase border">
                                        {{ $item->kondisi }}
                                    </span>
                                </td>
                                <td class="px-8 py-6 text-right">
                                    <div class="flex justify-end gap-2">
                                        <button wire:click="openEdit({{ $item->id }})"
                                            class="p-2.5 bg-slate-800 text-slate-400 rounded-xl hover:text-blue-500">EDIT</button>
                                        <button wire:click="delete({{ $item->id }})"
                                            wire:confirm="Yakin hapus barang ini?"
                                            class="p-2.5 bg-slate-800 text-slate-400 rounded-xl hover:text-red-500">HAPUS</button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5"
                                    class="px-8 py-12 text-center text-slate-600 italic font-black uppercase text-xs tracking-widest">
                                    Tidak ada barang ditemukan
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="p-6 border-t border-slate-800">
                    {{ $items->links() }}
                </div>

                {{-- modal --}}
                @if ($showModal)
                    <div class="fixed inset-0 bg-black/60 z-50 flex items-center justify-center">
                        <div class="bg-slate-900 border border-slate-800 rounded-3xl p-8 w-full max-w-lg">
                            <h3 class="text-white font-black text-lg mb-6 uppercase italic">
                                {{ $isEditing ? 'Edit Barang' : 'Tambah Barang' }}
                            </h3>
                            @if ($errors->any())
                                <div class="bg-red-500/10 border border-red-500/20 rounded-xl p-4 mb-4">
                                    @foreach ($errors->all() as $error)
                                        <p class="text-red-400 text-xs">{{ $error }}</p>
                                    @endforeach
                                </div>
                            @endif
                            <div class="space-y-4">
                                <input wire:model="kode_barang" placeholder="Kode Barang"
                                    class="w-full bg-slate-950 border border-slate-800 rounded-xl py-3 px-4 text-sm text-white outline-none focus:border-blue-500">
                                <input wire:model="nama_barang" placeholder="Nama Barang"
                                    class="w-full bg-slate-950 border border-slate-800 rounded-xl py-3 px-4 text-sm text-white outline-none focus:border-blue-500">
                                <input wire:model="merk" placeholder="Merk"
                                    class="w-full bg-slate-950 border border-slate-800 rounded-xl py-3 px-4 text-sm text-white outline-none focus:border-blue-500">
                                <input wire:model="stok" type="number" placeholder="Stok"
                                    class="w-full bg-slate-950 border border-slate-800 rounded-xl py-3 px-4 text-sm text-white outline-none focus:border-blue-500">
                                <input wire:model="lokasi" placeholder="Lokasi"
                                    class="w-full bg-slate-950 border border-slate-800 rounded-xl py-3 px-4 text-sm text-white outline-none focus:border-blue-500">
                                <select wire:model="kondisi"
                                    class="w-full bg-slate-950 border border-slate-800 rounded-xl py-3 px-4 text-sm text-slate-400 outline-none focus:border-blue-500">
                                    <option value="Bagus">Bagus</option>
                                    <option value="Rusak">Rusak</option>
                                    <option value="Perlu Perbaikan">Perlu Perbaikan</option>
                                </select>
                                <select wire:model="category_id"
                                    class="w-full bg-slate-950 border border-slate-800 rounded-xl py-3 px-4 text-sm text-slate-400 outline-none focus:border-blue-500">
                                    <option value="">Pilih Kategori</option>
                                    @foreach ($this->kategoris as $kat)
                                        <option value="{{ $kat->id }}">{{ $kat->name }}</option>
                                    @endforeach
                                </select>
                                <textarea wire:model="deskripsi" placeholder="Deskripsi" rows="3"
                                    class="w-full bg-slate-950 border border-slate-800 rounded-xl py-3 px-4 text-sm text-white outline-none focus:border-blue-500"></textarea>
                            </div>
                            <div class="flex gap-3 mt-6">
                                <button wire:click="save"
                                    class="flex-1 py-3 bg-blue-600 hover:bg-blue-500 text-white text-xs font-black rounded-xl uppercase tracking-widest">Simpan</button>
                                <button wire:click="$set('showModal', false)"
                                    class="flex-1 py-3 bg-slate-800 text-white text-xs font-black rounded-xl uppercase">Batal</button>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </main>
@endsection
