@extends('layout')

@section('page_title', 'Inventaris Barang Publikasi')

@section('content')

<main class="flex-1 flex flex-col min-w-0 overflow-hidden bg-[#0a0f1d]">

    {{-- ═══ HEADER ═══ --}}
    <header class="flex items-center justify-between h-16 sm:h-20 px-4 sm:px-8 bg-[#111827] border-b border-slate-800 shrink-0 gap-3">
        <div class="flex items-center gap-3 min-w-0">
            <button @click="sidebarOpen = !sidebarOpen"
                class="text-slate-400 lg:hidden font-bold shrink-0 p-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
            <h2 class="text-sm sm:text-xl font-bold text-white truncate">Inventaris Barang Publikasi</h2>
        </div>
        <button wire:click='openCreate'
            class="shrink-0 px-3 sm:px-5 py-2 sm:py-2.5 bg-blue-600 hover:bg-blue-500 text-white text-[10px] sm:text-xs font-bold rounded-xl shadow-lg shadow-blue-600/20 uppercase tracking-widest transition-all whitespace-nowrap">
            + Tambah
        </button>
    </header>

    <div class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8 custom-scrollbar space-y-5 sm:space-y-8">

        {{-- ═══ SEARCH & FILTER ═══ --}}
        <div class="p-4 sm:p-6 bg-slate-900 border border-slate-800 rounded-2xl sm:rounded-3xl flex flex-col sm:flex-row gap-3 items-stretch sm:items-center">
            <div class="relative flex-1">
                <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z"/>
                </svg>
                <input type="text" wire:model.live.debounce.400ms='search'
                    placeholder="Cari kode atau nama barang..."
                    class="w-full bg-slate-950 border border-slate-800 rounded-xl py-3 pl-11 pr-4 text-sm text-white placeholder-slate-600 focus:border-blue-500 outline-none transition-colors">
            </div>
            <select wire:model.live='kategori'
                class="bg-slate-950 border border-slate-800 rounded-xl py-3 px-4 text-sm text-slate-400 outline-none focus:border-blue-500 transition-colors sm:w-52">
                <option value="">Semua Kategori</option>
                @foreach ($this->kategoris as $kat)
                    <option value="{{ $kat->id }}">{{ $kat->name }}</option>
                @endforeach
            </select>
        </div>

        {{-- ═══ TABLE (Desktop) / CARDS (Mobile) ═══ --}}
        <div class="bg-slate-900 border border-slate-800 rounded-2xl sm:rounded-[2.5rem] overflow-hidden shadow-2xl">

            {{-- Desktop Table (hidden on mobile) --}}
            <div class="hidden md:block overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-slate-800/50 text-[10px] sm:text-[11px] uppercase tracking-[0.15em] sm:tracking-[0.2em] text-slate-500 font-black">
                            <th class="px-6 lg:px-8 py-4 sm:py-5">Detail Produk</th>
                            <th class="px-6 lg:px-8 py-4 sm:py-5">Kategori</th>
                            <th class="px-6 lg:px-8 py-4 sm:py-5">Stok Aktif</th>
                            <th class="px-6 lg:px-8 py-4 sm:py-5 text-center">Kondisi</th>
                            <th class="px-6 lg:px-8 py-4 sm:py-5 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800/50">
                        @forelse($items as $item)
                            @php
                                $kondisiClass = match ($item->kondisi) {
                                    'Baik'  => 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20',
                                    'Rusak' => 'bg-red-500/10 text-red-400 border-red-500/20',
                                    default => 'bg-amber-500/10 text-amber-400 border-amber-500/20',
                                };
                                $initials = strtoupper(substr($item->category->name ?? 'XX', 0, 2));
                            @endphp
                            <tr class="group hover:bg-blue-600/[0.03] transition-all">
                                <td class="px-6 lg:px-8 py-5">
                                    <div class="flex items-center gap-4">
                                        <div class="w-10 h-10 lg:w-12 lg:h-12 rounded-xl lg:rounded-2xl bg-blue-600/10 flex items-center justify-center text-blue-400 text-xs font-black italic shrink-0">
                                            {{ $initials }}
                                        </div>
                                        <div class="min-w-0">
                                            <p class="font-bold text-white text-sm lg:text-base truncate">{{ $item->nama_barang }}</p>
                                            <p class="text-[10px] lg:text-[11px] text-slate-500 font-mono tracking-tighter">{{ $item->kode_barang }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 lg:px-8 py-5 text-xs font-medium text-slate-400 uppercase tracking-tighter whitespace-nowrap">
                                    {{ $item->category->name ?? '-' }}
                                </td>
                                <td class="px-6 lg:px-8 py-5 italic font-black text-white text-base lg:text-lg whitespace-nowrap">
                                    {{ sprintf('%02d', $item->stok) }}
                                    <span class="text-[9px] lg:text-[10px] text-slate-500 not-italic font-medium uppercase ml-1">Unit</span>
                                </td>
                                <td class="px-6 lg:px-8 py-5 text-center whitespace-nowrap">
                                    <span class="px-2.5 py-1 {{ $kondisiClass }} text-[9px] lg:text-[10px] font-black rounded-full uppercase border">
                                        {{ $item->kondisi }}
                                    </span>
                                </td>
                                <td class="px-6 lg:px-8 py-5 text-right whitespace-nowrap">
                                    <div class="flex justify-end gap-2">
                                        <button wire:click="openEdit({{ $item->id }})"
                                            class="px-3 py-2 bg-slate-800 text-slate-400 text-[10px] font-bold rounded-lg hover:text-blue-400 hover:bg-slate-700 transition-all uppercase tracking-wider">
                                            Edit
                                        </button>
                                        <button wire:click="delete({{ $item->id }})"
                                            wire:confirm="Yakin hapus barang ini?"
                                            class="px-3 py-2 bg-slate-800 text-slate-400 text-[10px] font-bold rounded-lg hover:text-red-400 hover:bg-slate-700 transition-all uppercase tracking-wider">
                                            Hapus
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-8 py-16 text-center">
                                    <div class="flex flex-col items-center gap-3 text-slate-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                                        </svg>
                                        <p class="font-black uppercase text-xs tracking-widest italic">Tidak ada barang ditemukan</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Mobile Cards (hidden on desktop) --}}
            <div class="md:hidden divide-y divide-slate-800/50">
                @forelse($items as $item)
                    @php
                        $kondisiClass = match ($item->kondisi) {
                            'Bagus'  => 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20',
                            'Rusak' => 'bg-red-500/10 text-red-400 border-red-500/20',
                            default => 'bg-amber-500/10 text-amber-400 border-amber-500/20',
                        };
                        $initials = strtoupper(substr($item->category->name ?? 'XX', 0, 2));
                    @endphp
                    <div class="p-4 hover:bg-blue-600/[0.03] transition-all">
                        <div class="flex items-start gap-3">
                            {{-- Icon --}}
                            <div class="w-10 h-10 rounded-xl bg-blue-600/10 flex items-center justify-center text-blue-400 text-xs font-black italic shrink-0 mt-0.5">
                                {{ $initials }}
                            </div>
                            {{-- Info --}}
                            <div class="flex-1 min-w-0">
                                <div class="flex items-start justify-between gap-2 mb-1">
                                    <p class="font-bold text-white text-sm leading-tight">{{ $item->nama_barang }}</p>
                                    <span class="px-2 py-0.5 {{ $kondisiClass }} text-[9px] font-black rounded-full uppercase border shrink-0">
                                        {{ $item->kondisi }}
                                    </span>
                                </div>
                                <p class="text-[10px] text-slate-500 font-mono mb-2">{{ $item->kode_barang }}</p>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-3 text-[10px] text-slate-500 uppercase tracking-wider font-medium">
                                        <span>{{ $item->category->name ?? '-' }}</span>
                                        <span class="text-slate-700">•</span>
                                        <span class="text-white font-black text-sm italic not-italic">
                                            {{ sprintf('%02d', $item->stok) }}
                                            <span class="text-slate-500 text-[9px] not-italic font-medium">Unit</span>
                                        </span>
                                    </div>
                                    <div class="flex gap-1.5">
                                        <button wire:click="openEdit({{ $item->id }})"
                                            class="px-2.5 py-1.5 bg-slate-800 text-slate-400 text-[9px] font-bold rounded-lg hover:text-blue-400 transition-all uppercase tracking-wider">
                                            Edit
                                        </button>
                                        <button wire:click="delete({{ $item->id }})"
                                            wire:confirm="Yakin hapus barang ini?"
                                            class="px-2.5 py-1.5 bg-slate-800 text-slate-400 text-[9px] font-bold rounded-lg hover:text-red-400 transition-all uppercase tracking-wider">
                                            Hapus
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="py-16 text-center">
                        <div class="flex flex-col items-center gap-3 text-slate-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                            </svg>
                            <p class="font-black uppercase text-xs tracking-widest italic">Tidak ada barang ditemukan</p>
                        </div>
                    </div>
                @endforelse
            </div>

            {{-- Pagination --}}
            <div class="px-4 sm:px-6 py-4 border-t border-slate-800">
                {{ $items->links() }}
            </div>
        </div>
    </div>

    {{-- ═══ MODAL ═══ --}}
    @if ($showModal)
        <div class="fixed inset-0 bg-black/70 backdrop-blur-sm z-50 flex items-end sm:items-center justify-center p-0 sm:p-4"
             wire:click.self="$set('showModal', false)">
            <div class="bg-slate-900 border border-slate-800 rounded-t-3xl sm:rounded-3xl p-6 sm:p-8 w-full sm:max-w-lg max-h-[90vh] overflow-y-auto">

                {{-- Modal Header --}}
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-white font-black text-base uppercase italic">
                        {{ $isEditing ? 'Edit Barang' : 'Tambah Barang Baru' }}
                    </h3>
                    <button wire:click="$set('showModal', false)"
                        class="w-8 h-8 flex items-center justify-center rounded-lg bg-slate-800 text-slate-500 hover:text-white transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                {{-- Validation Errors --}}
                @if ($errors->any())
                    <div class="bg-red-500/10 border border-red-500/20 rounded-xl p-4 mb-5">
                        @foreach ($errors->all() as $error)
                            <p class="text-red-400 text-xs flex items-center gap-2">
                                <span class="w-1 h-1 bg-red-400 rounded-full shrink-0"></span>
                                {{ $error }}
                            </p>
                        @endforeach
                    </div>
                @endif

                {{-- Form Fields --}}
                <div class="space-y-3">
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="text-[10px] text-slate-500 uppercase tracking-wider font-bold mb-1.5 block">Kode Barang</label>
                            <input wire:model="kode_barang" placeholder="SN-XXXX-0000"
                                class="w-full bg-slate-950 border border-slate-800 rounded-xl py-2.5 px-3.5 text-sm text-white placeholder-slate-700 outline-none focus:border-blue-500 transition-colors">
                        </div>
                        <div>
                            <label class="text-[10px] text-slate-500 uppercase tracking-wider font-bold mb-1.5 block">Stok</label>
                            <input wire:model="stok" type="number" placeholder="0" min="0"
                                class="w-full bg-slate-950 border border-slate-800 rounded-xl py-2.5 px-3.5 text-sm text-white placeholder-slate-700 outline-none focus:border-blue-500 transition-colors">
                        </div>
                    </div>
                    <div>
                        <label class="text-[10px] text-slate-500 uppercase tracking-wider font-bold mb-1.5 block">Nama Barang</label>
                        <input wire:model="nama_barang" placeholder="Nama lengkap barang..."
                            class="w-full bg-slate-950 border border-slate-800 rounded-xl py-2.5 px-3.5 text-sm text-white placeholder-slate-700 outline-none focus:border-blue-500 transition-colors">
                    </div>
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="text-[10px] text-slate-500 uppercase tracking-wider font-bold mb-1.5 block">Merk</label>
                            <input wire:model="merk" placeholder="Apple, Logitech..."
                                class="w-full bg-slate-950 border border-slate-800 rounded-xl py-2.5 px-3.5 text-sm text-white placeholder-slate-700 outline-none focus:border-blue-500 transition-colors">
                        </div>
                        <div>
                            <label class="text-[10px] text-slate-500 uppercase tracking-wider font-bold mb-1.5 block">Lokasi</label>
                            <input wire:model="lokasi" placeholder="Gudang A..."
                                class="w-full bg-slate-950 border border-slate-800 rounded-xl py-2.5 px-3.5 text-sm text-white placeholder-slate-700 outline-none focus:border-blue-500 transition-colors">
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="text-[10px] text-slate-500 uppercase tracking-wider font-bold mb-1.5 block">Kondisi</label>
                            <select wire:model="kondisi"
                                class="w-full bg-slate-950 border border-slate-800 rounded-xl py-2.5 px-3.5 text-sm text-slate-300 outline-none focus:border-blue-500 transition-colors">
                                <option value="Bagus">Bagus</option>
                                <option value="Rusak">Rusak</option>
                                <option value="Diperbaiki">Diperbaiki</option>
                            </select>
                        </div>
                        <div>
                            <label class="text-[10px] text-slate-500 uppercase tracking-wider font-bold mb-1.5 block">Kategori</label>
                            <select wire:model="category_id"
                                class="w-full bg-slate-950 border border-slate-800 rounded-xl py-2.5 px-3.5 text-sm text-slate-300 outline-none focus:border-blue-500 transition-colors">
                                <option value="">Pilih...</option>
                                @foreach ($this->kategoris as $kat)
                                    <option value="{{ $kat->id }}">{{ $kat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div>
                        <label class="text-[10px] text-slate-500 uppercase tracking-wider font-bold mb-1.5 block">Deskripsi</label>
                        <textarea wire:model="deskripsi" placeholder="Catatan tambahan..." rows="3"
                            class="w-full bg-slate-950 border border-slate-800 rounded-xl py-2.5 px-3.5 text-sm text-white placeholder-slate-700 outline-none focus:border-blue-500 transition-colors resize-none"></textarea>
                    </div>
                </div>

                {{-- Actions --}}
                <div class="flex gap-3 mt-6">
                    <button wire:click="save"
                        class="flex-1 py-3 bg-blue-600 hover:bg-blue-500 text-white text-xs font-black rounded-xl uppercase tracking-widest transition-all">
                        Simpan
                    </button>
                    <button wire:click="$set('showModal', false)"
                        class="px-6 py-3 bg-slate-800 hover:bg-slate-700 text-slate-300 text-xs font-black rounded-xl uppercase tracking-wider transition-all">
                        Batal
                    </button>
                </div>
            </div>
        </div>
    @endif

</main>

{{-- ═══ TOAST NOTIFICATION ═══ --}}
<div
    x-data="{
        toasts: [],
        add(msg, type = 'success') {
            const id = Date.now();
            this.toasts.push({ id, msg, type });
            setTimeout(() => this.remove(id), 3500);
        },
        remove(id) {
            this.toasts = this.toasts.filter(t => t.id !== id);
        }
    }"
    x-on:notify.window="add($event.detail.msg, $event.detail.type ?? 'success')"
    class="fixed top-5 right-4 sm:right-6 z-[999] flex flex-col gap-2.5 pointer-events-none"
    style="max-width: calc(100vw - 2rem);"
>
    <template x-for="toast in toasts" :key="toast.id">
        <div
            x-show="true"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-x-8 scale-95"
            x-transition:enter-end="opacity-100 translate-x-0 scale-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-x-0 scale-100"
            x-transition:leave-end="opacity-0 translate-x-8 scale-95"
            class="pointer-events-auto flex items-center gap-3 px-4 py-3 rounded-2xl border shadow-2xl min-w-[220px] sm:min-w-[280px]"
            :class="{
                'bg-slate-900 border-emerald-500/30 shadow-emerald-900/30': toast.type === 'success',
                'bg-slate-900 border-red-500/30 shadow-red-900/30': toast.type === 'error',
                'bg-slate-900 border-amber-500/30 shadow-amber-900/30': toast.type === 'warning',
            }"
        >
            {{-- Icon --}}
            <div class="shrink-0 w-8 h-8 rounded-xl flex items-center justify-center"
                :class="{
                    'bg-emerald-500/10': toast.type === 'success',
                    'bg-red-500/10': toast.type === 'error',
                    'bg-amber-500/10': toast.type === 'warning',
                }"
            >
                {{-- Success --}}
                <svg x-show="toast.type === 'success'" class="w-4 h-4 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                </svg>
                {{-- Error --}}
                <svg x-show="toast.type === 'error'" class="w-4 h-4 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                </svg>
                {{-- Warning --}}
                <svg x-show="toast.type === 'warning'" class="w-4 h-4 text-amber-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v4m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
                </svg>
            </div>

            {{-- Message --}}
            <p class="text-xs font-bold text-white flex-1" x-text="toast.msg"></p>

            {{-- Progress bar --}}
            <div class="absolute bottom-0 left-0 h-[2px] rounded-b-2xl w-full overflow-hidden">
                <div class="h-full animate-shrink"
                    :class="{
                        'bg-emerald-500': toast.type === 'success',
                        'bg-red-500': toast.type === 'error',
                        'bg-amber-500': toast.type === 'warning',
                    }"
                ></div>
            </div>

            {{-- Close --}}
            <button @click="remove(toast.id)" class="shrink-0 text-slate-600 hover:text-slate-400 transition-colors">
                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </template>
</div>

<style>
    @keyframes shrink {
        from { width: 100%; }
        to   { width: 0%; }
    }
    .animate-shrink {
        animation: shrink 3.5s linear forwards;
    }
</style>

@endsection