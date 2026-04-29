@extends('layout')

@section('page_title', 'Ringkasan Statistik')

@section('content')
    {{-- <div class="space-y-8">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="text-3xl font-black text-white italic tracking-tighter uppercase">Kemasukan Stok Baru</h2>
                <p class="text-slate-500 text-sm font-medium">Rekod setiap penerimaan barang dari vendor atau pembekal.</p>
            </div>
            <div class="flex items-center gap-3">
                <div class="flex -space-x-2">
                    <div
                        class="w-8 h-8 rounded-full border-2 border-[#0a0f1d] bg-blue-600 flex items-center justify-center text-[10px] font-black text-white">
                        1</div>
                    <div
                        class="w-8 h-8 rounded-full border-2 border-[#0a0f1d] bg-slate-800 flex items-center justify-center text-[10px] font-black text-slate-500">
                        2</div>
                </div>
                <span class="text-[10px] font-black text-slate-500 uppercase tracking-widest italic">Langkah 1: Maklumat
                    Asas</span>
            </div>
        </div>

        <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
            <!-- Form Input -->
            <div class="xl:col-span-2 space-y-8">
                <div class="p-8 bg-slate-900 border border-slate-800 rounded-[2.5rem] shadow-2xl">
                    <form class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label
                                    class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2 px-2 italic">Tarikh
                                    Terima</label>
                                <input type="date"
                                    class="w-full bg-slate-950 border border-slate-800 rounded-2xl py-3 px-5 text-sm text-white focus:border-blue-600 outline-none transition-all">
                            </div>
                            <div>
                                <label
                                    class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2 px-2 italic">No.
                                    Pesanan / PO</label>
                                <input type="text" placeholder="PO-2024-XXX"
                                    class="w-full bg-slate-950 border border-slate-800 rounded-2xl py-3 px-5 text-sm text-white focus:border-blue-600 outline-none transition-all">
                            </div>
                        </div>

                        <div>
                            <label
                                class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2 px-2 italic">Pilih
                                Barang</label>
                            <select
                                class="w-full bg-slate-950 border border-slate-800 rounded-2xl py-3 px-5 text-sm text-white focus:border-blue-600 outline-none appearance-none">
                                <option>Sila pilih barang dari inventori...</option>
                                <option>MacBook Pro M3 (IT)</option>
                                <option>Kertas A4 PaperOne (Publikasi)</option>
                            </select>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="md:col-span-1">
                                <label
                                    class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2 px-2 italic">Kuantiti</label>
                                <input type="number" placeholder="0"
                                    class="w-full bg-slate-950 border border-slate-800 rounded-2xl py-3 px-5 text-xl font-black text-white focus:border-blue-600 outline-none transition-all">
                            </div>
                            <div class="md:col-span-2">
                                <label
                                    class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2 px-2 italic">Pembekal
                                    / Vendor</label>
                                <input type="text" placeholder="Nama Syarikat Pembekal"
                                    class="w-full bg-slate-950 border border-slate-800 rounded-2xl py-3 px-5 text-sm text-white focus:border-blue-600 outline-none transition-all">
                            </div>
                        </div>

                        <div class="pt-6 border-t border-slate-800 flex justify-end">
                            <button
                                class="px-10 py-4 bg-blue-600 hover:bg-blue-500 text-white text-xs font-black rounded-2xl shadow-lg shadow-blue-600/20 uppercase tracking-[0.2em] transition-all italic">
                                Simpan Rekod Masuk
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Sidebar Info -->
            <div class="space-y-6">
                <div class="p-6 bg-emerald-600/10 border border-emerald-500/20 rounded-[2rem]">
                    <h4 class="text-[10px] font-black text-emerald-500 uppercase tracking-widest mb-4 italic">Kemasukan Hari
                        Ini</h4>
                    <div class="flex items-end gap-2">
                        <span class="text-4xl font-black text-white italic">12</span>
                        <span class="text-[10px] font-bold text-slate-500 uppercase mb-2">Transaksi</span>
                    </div>
                </div>

                <div class="p-6 bg-slate-900 border border-slate-800 rounded-[2rem]">
                    <h4 class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-6 italic">Item Terakhir
                        Masuk</h4>
                    <div class="space-y-4">
                        <div class="flex items-center gap-3">
                            <div class="w-2 h-2 rounded-full bg-blue-600"></div>
                            <div>
                                <p class="text-xs font-bold text-white uppercase italic">Mouse Logitech MX</p>
                                <p class="text-[9px] text-slate-600 uppercase font-black">+5 Unit • 2 Jam Lepas</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-2 h-2 rounded-full bg-blue-600"></div>
                            <div>
                                <p class="text-xs font-bold text-white uppercase italic">Toner HP Laserjet</p>
                                <p class="text-[9px] text-slate-600 uppercase font-black">+20 Unit • 5 Jam Lepas</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <div class="space-y-8">

        {{-- Flash Message --}}
        @if (session('success'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
                x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 translate-y-0"
                x-transition:leave-end="opacity-0 -translate-y-2"
                class="flex items-center gap-3 p-4 bg-emerald-500/10 border border-emerald-500/30 rounded-2xl text-emerald-400 text-sm font-bold">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                {{ session('success') }}
            </div>
        @endif

        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="text-3xl font-black text-white italic tracking-tighter uppercase">Kemasukan Stok Baru</h2>
                <p class="text-slate-500 text-sm font-medium">Rekam setiap penerimaan barang masuk ke gudang.</p>
            </div>
            <div class="flex items-center gap-3">
                <div class="px-4 py-2 bg-emerald-600/10 border border-emerald-500/20 rounded-xl">
                    <p class="text-[10px] font-black text-emerald-500 uppercase tracking-widest">Hari Ini</p>
                    <p class="text-sm font-black text-white italic">{{ $todayCount }} Transaksi · {{ $todayQty }} Unit
                    </p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">

            {{-- ======================= --}}
            {{-- FORM INPUT --}}
            {{-- ======================= --}}
            <div class="xl:col-span-2">
                <div class="p-8 bg-slate-900 border border-slate-800 rounded-[2.5rem] shadow-2xl space-y-6">

                    {{-- Tanggal --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label
                                class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2 px-2 italic">
                                Tanggal Terima
                            </label>
                            <input wire:model="tanggal_transaksi" type="date"
                                class="w-full bg-slate-950 border @error('tanggal_transaksi') border-red-500 @else border-slate-800 @enderror rounded-2xl py-3 px-5 text-sm text-white focus:border-blue-600 outline-none transition-all">
                            @error('tanggal_transaksi')
                                <p class="mt-1 text-xs text-red-400 font-bold px-2">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Jumlah --}}
                        <div>
                            <label
                                class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2 px-2 italic">
                                Kuantiti
                            </label>
                            <input wire:model="quantity" type="number" min="1" placeholder="0"
                                class="w-full bg-slate-950 border @error('quantity') border-red-500 @else border-slate-800 @enderror rounded-2xl py-3 px-5 text-xl font-black text-white focus:border-blue-600 outline-none transition-all">
                            @error('quantity')
                                <p class="mt-1 text-xs text-red-400 font-bold px-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Pilih Barang --}}
                    <div>
                        <label
                            class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2 px-2 italic">
                            Pilih Barang
                        </label>
                        {{-- Search Filter --}}
                        <div class="relative mb-2">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-600">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </span>
                            <input wire:model.live.debounce.300ms="searchItem" type="text"
                                placeholder="Cari nama atau kode barang..."
                                class="w-full bg-slate-950 border border-slate-800 rounded-2xl py-2 pl-10 pr-4 text-xs text-white focus:border-blue-500 outline-none transition-all italic">
                        </div>
                        <select wire:model.live="item_id"
                            class="w-full bg-slate-950 border @error('item_id') border-red-500 @else border-slate-800 @enderror rounded-2xl py-3 px-5 text-sm text-white focus:border-blue-600 outline-none appearance-none transition-all">
                            <option value="">-- Pilih barang dari inventori --</option>
                            @foreach ($items as $item)
                                <option value="{{ $item->id }}">
                                    [{{ $item->kode_barang }}] {{ $item->nama_barang }} — Stok: {{ $item->stok }}
                                </option>
                            @endforeach
                        </select>
                        @error('item_id')
                            <p class="mt-1 text-xs text-red-400 font-bold px-2">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Info barang terpilih --}}
                    @if ($selectedItem)
                        <div
                            class="p-4 bg-blue-600/5 border border-blue-600/20 rounded-2xl grid grid-cols-2 md:grid-cols-4 gap-4">
                            <div>
                                <p class="text-[9px] font-black text-slate-600 uppercase tracking-widest italic">Kode</p>
                                <p class="text-xs font-black text-white italic">{{ $selectedItem['kode_barang'] }}</p>
                            </div>
                            <div>
                                <p class="text-[9px] font-black text-slate-600 uppercase tracking-widest italic">Kategori
                                </p>
                                <p class="text-xs font-black text-white italic">{{ $selectedItem['kategori'] }}</p>
                            </div>
                            <div>
                                <p class="text-[9px] font-black text-slate-600 uppercase tracking-widest italic">Stok Saat
                                    Ini</p>
                                <p class="text-xs font-black text-emerald-400 italic">{{ $selectedItem['stok'] }} Unit</p>
                            </div>
                            <div>
                                <p class="text-[9px] font-black text-slate-600 uppercase tracking-widest italic">Kondisi</p>
                                <p class="text-xs font-black text-white italic capitalize">{{ $selectedItem['kondisi'] }}
                                </p>
                            </div>
                            @if ($quantity > 0)
                                <div class="col-span-2 md:col-span-4 pt-2 border-t border-blue-600/10">
                                    <p class="text-[9px] font-black text-slate-600 uppercase tracking-widest italic">Stok
                                        Setelah Masuk</p>
                                    <p class="text-base font-black text-blue-400 italic">
                                        {{ $selectedItem['stok'] + $quantity }} Unit</p>
                                </div>
                            @endif
                        </div>
                    @endif

                    {{-- Keterangan --}}
                    <div>
                        <label
                            class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2 px-2 italic">
                            Keterangan <span class="text-slate-700 normal-case">(opsional)</span>
                        </label>
                        <textarea wire:model="keterangan" rows="3" placeholder="Contoh: Pembelian dari vendor PT. ABC, PO-2025-001..."
                            class="w-full bg-slate-950 border border-slate-800 rounded-2xl py-3 px-5 text-sm text-white focus:border-blue-600 outline-none transition-all resize-none italic"></textarea>
                    </div>

                    {{-- Submit --}}
                    <div class="pt-4 border-t border-slate-800 flex justify-end">
                        <button wire:click="save" wire:loading.attr="disabled"
                            class="flex items-center gap-3 px-10 py-4 bg-blue-600 hover:bg-blue-500 disabled:opacity-50 text-white text-xs font-black rounded-2xl shadow-lg shadow-blue-600/20 uppercase tracking-[0.2em] transition-all italic">
                            <svg wire:loading.remove wire:target="save" class="w-5 h-5" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <svg wire:loading wire:target="save" class="w-5 h-5 animate-spin" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                            <span wire:loading.remove wire:target="save">Simpan Rekod Masuk</span>
                            <span wire:loading wire:target="save">Menyimpan...</span>
                        </button>
                    </div>
                </div>
            </div>

            {{-- ======================= --}}
            {{-- SIDEBAR INFO --}}
            {{-- ======================= --}}
            <div class="space-y-6">
                {{-- Stat hari ini --}}
                <div class="p-6 bg-emerald-600/10 border border-emerald-500/20 rounded-[2rem]">
                    <h4 class="text-[10px] font-black text-emerald-500 uppercase tracking-widest mb-4 italic">Kemasukan Hari
                        Ini</h4>
                    <div class="flex items-end gap-2 mb-1">
                        <span class="text-4xl font-black text-white italic">{{ $todayCount }}</span>
                        <span class="text-[10px] font-bold text-slate-500 uppercase mb-2">Transaksi</span>
                    </div>
                    <p class="text-[10px] font-bold text-emerald-600 uppercase tracking-widest">+{{ $todayQty }} Unit
                        Total</p>
                </div>

                {{-- Item terakhir masuk --}}
                <div class="p-6 bg-slate-900 border border-slate-800 rounded-[2rem]">
                    <h4 class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-6 italic">Terakhir Masuk
                    </h4>
                    <div class="space-y-4">
                        @forelse ($lastEntries as $entry)
                            <div class="flex items-start gap-3">
                                <div class="w-2 h-2 rounded-full bg-blue-600 mt-1.5 shrink-0"></div>
                                <div>
                                    <p class="text-xs font-bold text-white uppercase italic leading-tight">
                                        {{ $entry->item?->nama_barang ?? '-' }}</p>
                                    <p class="text-[9px] text-slate-600 uppercase font-black mt-0.5">
                                        +{{ $entry->quantity }} Unit &bull;
                                        {{ $entry->tanggal_transaksi instanceof \Carbon\Carbon ? $entry->tanggal_transaksi->diffForHumans() : \Carbon\Carbon::parse($entry->tanggal_transaksi)->diffForHumans() }}
                                    </p>
                                </div>
                            </div>
                        @empty
                            <p class="text-xs text-slate-600 italic">Belum ada transaksi.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        {{-- ======================= --}}
        {{-- TABEL RIWAYAT --}}
        {{-- ======================= --}}
        <div class="bg-slate-900 border border-slate-800 rounded-[2.5rem] overflow-hidden shadow-2xl">
            <div class="p-8 border-b border-slate-800">
                <h3 class="text-sm font-black text-white italic uppercase tracking-tighter">Riwayat Barang Masuk</h3>
                <p class="text-[10px] font-bold text-slate-600 uppercase tracking-widest mt-1">Semua rekod penerimaan stok
                </p>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-slate-800">
                            <th
                                class="px-8 py-4 text-left text-[10px] font-black text-slate-600 uppercase tracking-widest">
                                Tanggal</th>
                            <th
                                class="px-8 py-4 text-left text-[10px] font-black text-slate-600 uppercase tracking-widest">
                                Barang</th>
                            <th
                                class="px-8 py-4 text-left text-[10px] font-black text-slate-600 uppercase tracking-widest">
                                Kategori</th>
                            <th
                                class="px-8 py-4 text-center text-[10px] font-black text-slate-600 uppercase tracking-widest">
                                Qty</th>
                            <th
                                class="px-8 py-4 text-left text-[10px] font-black text-slate-600 uppercase tracking-widest">
                                Keterangan</th>
                            <th
                                class="px-8 py-4 text-left text-[10px] font-black text-slate-600 uppercase tracking-widest">
                                Direkam Oleh</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800/50">
                        @forelse ($riwayat as $row)
                            <tr class="hover:bg-slate-800/20 transition-colors">
                                <td class="px-8 py-4 text-xs font-bold text-slate-300 whitespace-nowrap">
                                    {{ \Carbon\Carbon::parse($row->tanggal_transaksi)->format('d M Y') }}
                                </td>
                                <td class="px-8 py-4">
                                    <p class="text-xs font-black text-white italic uppercase">
                                        {{ $row->item?->nama_barang ?? '-' }}</p>
                                    <p class="text-[9px] font-bold text-slate-600 uppercase">
                                        {{ $row->item?->kode_barang ?? '' }}</p>
                                </td>
                                <td class="px-8 py-4 text-xs text-slate-500 font-bold">
                                    {{ $row->item?->category?->name ?? '-' }}
                                </td>
                                <td class="px-8 py-4 text-center">
                                    <span
                                        class="px-3 py-1 bg-emerald-600/10 text-emerald-400 text-xs font-black rounded-lg border border-emerald-600/20">
                                        +{{ $row->quantity }}
                                    </span>
                                </td>
                                <td class="px-8 py-4 text-xs text-slate-500 max-w-[200px] truncate">
                                    {{ $row->keterangan ?: '—' }}
                                </td>
                                <td class="px-8 py-4 text-xs font-bold text-slate-400 italic">
                                    {{ $row->user?->name ?? 'System' }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6"
                                    class="px-8 py-16 text-center text-slate-600 text-xs font-black uppercase tracking-widest italic">
                                    Belum ada riwayat barang masuk.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="p-6 bg-slate-950/30 border-t border-slate-800 flex items-center justify-between">
                <p class="text-[10px] font-bold text-slate-600 uppercase tracking-widest italic">
                    Menampilkan {{ $riwayat->firstItem() ?? 0 }}–{{ $riwayat->lastItem() ?? 0 }} dari
                    {{ $riwayat->total() }} Rekod
                </p>
                <div class="flex gap-2">
                    <button wire:click="previousPage" @disabled(!$riwayat->onFirstPage())
                        class="px-4 py-2 bg-slate-800 text-slate-400 text-[10px] font-black uppercase rounded-lg disabled:opacity-30 hover:bg-slate-700 transition-colors">Prev</button>
                    <button wire:click="nextPage" @disabled(!$riwayat->hasMorePages())
                        class="px-4 py-2 bg-slate-800 text-white text-[10px] font-black uppercase rounded-lg disabled:opacity-30 hover:bg-slate-700 transition-colors">Next</button>
                </div>
            </div>
        </div>

    </div>
@endsection
