@extends('layout')

@section('page_title', 'Sirkulasi Peminjaman')

@section("content")
<div class="space-y-8">

    {{-- Flash Message --}}
    @if (session('success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-2"
            class="flex items-center gap-3 p-4 bg-emerald-500/10 border border-emerald-500/30 rounded-2xl text-emerald-400 text-sm font-bold">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            {{ session('success') }}
        </div>
    @endif

    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h2 class="text-3xl font-black text-amber-500 italic tracking-tighter uppercase">Sirkulasi Peminjaman</h2>
            <p class="text-slate-500 text-sm font-medium">Lacak aset yang sedang digunakan sementara oleh staff.</p>
        </div>
        <button wire:click="$set('activeTab', 'form')"
            class="flex items-center justify-center gap-3 px-6 py-3 bg-amber-600 hover:bg-amber-500 text-white text-xs font-black rounded-2xl transition-all shadow-lg shadow-amber-600/20 uppercase tracking-widest italic">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Buat Peminjaman Baru
        </button>
    </div>

    <!-- Loan Analytics -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="p-6 bg-slate-900 border border-slate-800 rounded-[2rem] shadow-xl">
            <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1 italic">Sedang Dipinjam</p>
            <div class="flex items-center gap-3">
                <h3 class="text-4xl font-black text-white italic tracking-tighter">{{ $totalDipinjam }}</h3>
                <span class="text-[10px] font-bold text-amber-500 bg-amber-500/10 px-2 py-1 rounded-lg">Active</span>
            </div>
        </div>
        <div class="p-6 bg-slate-900 border border-slate-800 rounded-[2rem] shadow-xl border-l-4 border-l-red-600">
            <p class="text-[10px] font-black text-red-500 uppercase tracking-widest mb-1 italic">Terlambat Kembali</p>
            <div class="flex items-center gap-3">
                <h3 class="text-4xl font-black text-white italic tracking-tighter">{{ str_pad($terlambat, 2, '0', STR_PAD_LEFT) }}</h3>
                <span class="text-[10px] font-bold text-red-500 bg-red-500/10 px-2 py-1 rounded-lg {{ $terlambat > 0 ? 'animate-pulse' : '' }}">Overdue</span>
            </div>
        </div>
        <div class="p-6 bg-slate-900 border border-slate-800 rounded-[2rem] shadow-xl">
            <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1 italic">Total Dikembalikan</p>
            <div class="flex items-center gap-3">
                <h3 class="text-4xl font-black text-white italic tracking-tighter">{{ str_pad($totalDikembalikan, 2, '0', STR_PAD_LEFT) }}</h3>
                <span class="text-[10px] font-bold text-emerald-500 bg-emerald-500/10 px-2 py-1 rounded-lg">Selesai</span>
            </div>
        </div>
    </div>

    {{-- ======================= --}}
    {{-- TAB NAVIGATION --}}
    {{-- ======================= --}}
    <div class="flex gap-2 border-b border-slate-800 pb-0">
        <button wire:click="$set('activeTab', 'riwayat')"
            class="px-6 py-3 text-[10px] font-black uppercase tracking-widest italic transition-all
                {{ $activeTab === 'riwayat' ? 'text-amber-500 border-b-2 border-amber-500' : 'text-slate-500 hover:text-white' }}">
            Riwayat Peminjaman
        </button>
        <button wire:click="$set('activeTab', 'form')"
            class="px-6 py-3 text-[10px] font-black uppercase tracking-widest italic transition-all
                {{ $activeTab === 'form' ? 'text-amber-500 border-b-2 border-amber-500' : 'text-slate-500 hover:text-white' }}">
            + Peminjaman Baru
        </button>
    </div>

    {{-- ======================= --}}
    {{-- FORM PEMINJAMAN BARU --}}
    {{-- ======================= --}}
    @if ($activeTab === 'form')
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">

        <div class="xl:col-span-2">
            <div class="p-8 bg-slate-900 border border-slate-800 rounded-[2.5rem] shadow-2xl space-y-6">

                {{-- Nama Peminjam & Tanggal Pinjam --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2 px-2 italic">
                            Nama Peminjam
                        </label>
                        <input wire:model="nama_peminjam" type="text" placeholder="Nama lengkap staff..."
                            class="w-full bg-slate-950 border @error('nama_peminjam') border-red-500 @else border-slate-800 @enderror rounded-2xl py-3 px-5 text-sm text-white focus:border-amber-500 outline-none transition-all">
                        @error('nama_peminjam')
                            <p class="mt-1 text-xs text-red-400 font-bold px-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2 px-2 italic">
                            Tanggal Pinjam
                        </label>
                        <input wire:model="tanggal_pinjam" type="date"
                            class="w-full bg-slate-950 border @error('tanggal_pinjam') border-red-500 @else border-slate-800 @enderror rounded-2xl py-3 px-5 text-sm text-white focus:border-amber-500 outline-none transition-all">
                        @error('tanggal_pinjam')
                            <p class="mt-1 text-xs text-red-400 font-bold px-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Pilih Barang --}}
                <div>
                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2 px-2 italic">
                        Pilih Barang
                    </label>
                    <div class="relative mb-2">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-600">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </span>
                        <input wire:model.live.debounce.300ms="searchItem" type="text"
                            placeholder="Cari nama atau kode barang..."
                            class="w-full bg-slate-950 border border-slate-800 rounded-2xl py-2 pl-10 pr-4 text-xs text-white focus:border-amber-500 outline-none transition-all italic">
                    </div>
                    <select wire:model.live="item_id"
                        class="w-full bg-slate-950 border @error('item_id') border-red-500 @else border-slate-800 @enderror rounded-2xl py-3 px-5 text-sm text-white focus:border-amber-500 outline-none appearance-none transition-all">
                        <option value="">-- Pilih barang dari inventori --</option>
                        @foreach ($itemList as $item)
                            <option value="{{ $item->id }}" @disabled($item->stok <= 0)>
                                [{{ $item->kode_barang }}] {{ $item->nama_barang }}
                                — Stok: {{ $item->stok }}{{ $item->stok <= 0 ? ' (Habis)' : '' }}
                            </option>
                        @endforeach
                    </select>
                    @error('item_id')
                        <p class="mt-1 text-xs text-red-400 font-bold px-2">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Info barang terpilih --}}
                @if ($selectedItem)
                    <div class="p-4 bg-amber-600/5 border border-amber-600/20 rounded-2xl grid grid-cols-2 md:grid-cols-4 gap-4">
                        <div>
                            <p class="text-[9px] font-black text-slate-600 uppercase tracking-widest italic">Kode</p>
                            <p class="text-xs font-black text-white italic">{{ $selectedItem['kode_barang'] }}</p>
                        </div>
                        <div>
                            <p class="text-[9px] font-black text-slate-600 uppercase tracking-widest italic">Kategori</p>
                            <p class="text-xs font-black text-white italic">{{ $selectedItem['kategori'] }}</p>
                        </div>
                        <div>
                            <p class="text-[9px] font-black text-slate-600 uppercase tracking-widest italic">Stok Tersedia</p>
                            <p class="text-xs font-black {{ $selectedItem['stok'] <= 5 ? 'text-red-400' : 'text-emerald-400' }} italic">
                                {{ $selectedItem['stok'] }} Unit
                            </p>
                        </div>
                        <div>
                            <p class="text-[9px] font-black text-slate-600 uppercase tracking-widest italic">Kondisi</p>
                            <p class="text-xs font-black text-white italic capitalize">{{ $selectedItem['kondisi'] }}</p>
                        </div>
                    </div>
                @endif

                {{-- Jumlah & Tanggal Rencana Kembali --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2 px-2 italic">
                            Jumlah Dipinjam
                        </label>
                        <input wire:model.live="jumlah" type="number" min="1" placeholder="0"
                            class="w-full bg-slate-950 border @error('jumlah') border-red-500 @else border-slate-800 @enderror rounded-2xl py-3 px-5 text-xl font-black text-amber-400 focus:border-amber-500 outline-none transition-all">
                        @error('jumlah')
                            <p class="mt-1 text-xs text-red-400 font-bold px-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2 px-2 italic">
                            Rencana Tanggal Kembali
                        </label>
                        <input wire:model="tanggal_kembali_rencana" type="date"
                            class="w-full bg-slate-950 border @error('tanggal_kembali_rencana') border-red-500 @else border-slate-800 @enderror rounded-2xl py-3 px-5 text-sm text-white focus:border-amber-500 outline-none transition-all">
                        @error('tanggal_kembali_rencana')
                            <p class="mt-1 text-xs text-red-400 font-bold px-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Submit --}}
                <div class="pt-4 border-t border-slate-800 flex justify-end">
                    <button wire:click="save" wire:loading.attr="disabled"
                        class="flex items-center gap-3 px-10 py-4 bg-amber-600 hover:bg-amber-500 disabled:opacity-50 text-white text-xs font-black rounded-2xl shadow-lg shadow-amber-600/20 uppercase tracking-[0.2em] transition-all italic">
                        <svg wire:loading.remove wire:target="save" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <svg wire:loading wire:target="save" class="w-5 h-5 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                        </svg>
                        <span wire:loading.remove wire:target="save">Konfirmasi Peminjaman</span>
                        <span wire:loading wire:target="save">Menyimpan...</span>
                    </button>
                </div>
            </div>
        </div>

        {{-- Sidebar: Peminjaman Aktif --}}
        <div class="space-y-6">
            <div class="p-6 bg-slate-900 border border-slate-800 rounded-[2rem]">
                <h4 class="text-[10px] font-black text-amber-500 uppercase tracking-widest mb-4 italic flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Sedang Dipinjam
                </h4>
                <div class="space-y-3">
                    @forelse ($peminjamanAktif as $aktif)
                        @php $overdue = \Carbon\Carbon::parse($aktif->tanggal_kembali_rencana)->isPast(); @endphp
                        <div class="p-3 bg-slate-950 rounded-xl border {{ $overdue ? 'border-red-800' : 'border-slate-800' }}">
                            <p class="text-xs font-bold text-white italic leading-tight">{{ $aktif->item?->nama_barang ?? '-' }}</p>
                            <div class="flex justify-between items-center mt-1.5">
                                <span class="text-[9px] font-black text-slate-500 uppercase">{{ $aktif->nama_peminjam }}</span>
                                <span class="text-[9px] font-black {{ $overdue ? 'text-red-500' : 'text-amber-500' }} uppercase">
                                    {{ $overdue ? 'Terlambat' : \Carbon\Carbon::parse($aktif->tanggal_kembali_rencana)->format('d M') }}
                                </span>
                            </div>
                        </div>
                    @empty
                        <p class="text-xs text-slate-600 italic text-center py-4">✅ Tidak ada peminjaman aktif.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- ======================= --}}
    {{-- TABEL RIWAYAT --}}
    {{-- ======================= --}}
    @if ($activeTab === 'riwayat')
    <div class="bg-slate-900 border border-slate-800 rounded-[3rem] overflow-hidden shadow-2xl">
        <div class="p-8 border-b border-slate-800 flex flex-col md:flex-row justify-between items-center gap-6">
            <div class="relative w-full md:w-96">
                <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-500">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </span>
                <input wire:model.live.debounce.300ms="searchRiwayat" type="text"
                    placeholder="Cari nama staff atau barang..."
                    class="w-full bg-slate-950 border border-slate-800 rounded-2xl py-3 pl-12 pr-4 text-sm text-white focus:border-amber-500 outline-none transition-all italic">
            </div>
            <div class="flex gap-2 w-full md:w-auto">
                <select wire:model.live="filterStatus"
                    class="flex-1 md:flex-none px-6 py-3 bg-slate-950 border border-slate-800 text-[10px] font-black text-slate-400 uppercase tracking-widest rounded-xl outline-none appearance-none hover:text-white transition-all italic">
                    <option value="">Semua Status</option>
                    <option value="dipinjam">Dipinjam</option>
                    <option value="dikembalikan">Dikembalikan</option>
                </select>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-slate-950/50 text-[10px] font-black text-slate-500 uppercase tracking-[0.2em] italic">
                    <tr>
                        <th class="px-8 py-5">Peminjam</th>
                        <th class="px-8 py-5">Barang</th>
                        <th class="px-8 py-5">Tgl Pinjam</th>
                        <th class="px-8 py-5">Estimasi Kembali</th>
                        <th class="px-8 py-5 text-center">Jml</th>
                        <th class="px-8 py-5 text-center">Status</th>
                        <th class="px-8 py-5 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800/50">
                    @forelse ($riwayat as $row)
                        @php
                            $overdue = $row->status === 'dipinjam' && \Carbon\Carbon::parse($row->tanggal_kembali_rencana)->isPast();
                        @endphp
                        <tr class="group hover:bg-amber-600/[0.02] transition-colors {{ $overdue ? 'bg-red-600/[0.02]' : '' }}">
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center font-black text-slate-500 text-xs">
                                        {{ strtoupper(substr($row->nama_peminjam, 0, 2)) }}
                                    </div>
                                    <p class="text-sm font-bold text-white tracking-tight">{{ $row->nama_peminjam }}</p>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <p class="text-sm font-bold text-slate-300 italic">{{ $row->item?->nama_barang ?? '-' }}</p>
                                <p class="text-[9px] text-slate-600 uppercase font-black">{{ $row->item?->kode_barang ?? '' }}</p>
                            </td>
                            <td class="px-8 py-6 text-xs text-slate-500 font-mono">
                                {{ \Carbon\Carbon::parse($row->tanggal_pinjam)->format('d M Y') }}
                            </td>
                            <td class="px-8 py-6">
                                @if ($row->status === 'dikembalikan')
                                    <span class="text-xs text-emerald-400 font-bold italic">
                                        {{ \Carbon\Carbon::parse($row->tanggal_kembali_realisasi)->format('d M Y') }}
                                    </span>
                                    <p class="text-[9px] text-emerald-600 uppercase font-black">Realisasi</p>
                                @elseif ($overdue)
                                    <span class="text-xs text-red-500 font-bold italic">
                                        {{ \Carbon\Carbon::parse($row->tanggal_kembali_rencana)->format('d M Y') }}
                                    </span>
                                    <p class="text-[9px] text-red-600 uppercase font-black">
                                        Terlambat {{ \Carbon\Carbon::parse($row->tanggal_kembali_rencana)->diffForHumans(null, true) }}
                                    </p>
                                @else
                                    <span class="text-xs text-slate-400 font-bold italic">
                                        {{ \Carbon\Carbon::parse($row->tanggal_kembali_rencana)->format('d M Y') }}
                                    </span>
                                @endif
                            </td>
                            <td class="px-8 py-6 text-center">
                                <span class="px-3 py-1 bg-amber-600/10 text-amber-400 text-xs font-black rounded-lg border border-amber-600/20">
                                    {{ $row->jumlah }}
                                </span>
                            </td>
                            <td class="px-8 py-6 text-center">
                                @if ($row->status === 'dikembalikan')
                                    <span class="px-3 py-1 bg-emerald-600/10 text-emerald-400 text-[10px] font-black rounded-lg border border-emerald-600/20 uppercase">
                                        Dikembalikan
                                    </span>
                                @elseif ($overdue)
                                    <span class="px-3 py-1 bg-red-600/10 text-red-400 text-[10px] font-black rounded-lg border border-red-600/20 uppercase animate-pulse">
                                        Terlambat
                                    </span>
                                @else
                                    <span class="px-3 py-1 bg-amber-600/10 text-amber-400 text-[10px] font-black rounded-lg border border-amber-600/20 uppercase">
                                        Dipinjam
                                    </span>
                                @endif
                            </td>
                            <td class="px-8 py-6 text-right">
                                @if ($row->status === 'dipinjam')
                                    <button wire:click="openReturnModal({{ $row->id }})"
                                        class="px-4 py-2 bg-emerald-600/10 text-emerald-500 text-[10px] font-black rounded-xl uppercase italic border border-emerald-500/20 hover:bg-emerald-600 hover:text-white transition-all">
                                        Kembalikan
                                    </button>
                                @else
                                    <span class="text-[10px] text-slate-600 font-black uppercase italic">—</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-8 py-16 text-center text-slate-600 text-xs font-black uppercase tracking-widest italic">
                                Belum ada riwayat peminjaman.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="p-8 bg-slate-950/30 border-t border-slate-800 flex items-center justify-between">
            <p class="text-[10px] font-bold text-slate-600 uppercase tracking-widest italic">
                Menampilkan {{ $riwayat->firstItem() ?? 0 }}–{{ $riwayat->lastItem() ?? 0 }} dari {{ $riwayat->total() }} Rekod
            </p>
            <div class="flex gap-2">
                <button wire:click="previousPage" @disabled(!$riwayat->onFirstPage())
                    class="px-4 py-2 bg-slate-800 text-slate-400 text-[10px] font-black uppercase rounded-lg disabled:opacity-30 hover:bg-slate-700 transition-colors">Prev</button>
                <button wire:click="nextPage" @disabled(!$riwayat->hasMorePages())
                    class="px-4 py-2 bg-slate-800 text-white text-[10px] font-black uppercase rounded-lg disabled:opacity-30 hover:bg-slate-700 transition-colors">Next</button>
            </div>
        </div>
    </div>
    @endif

</div>

{{-- ======================= --}}
{{-- MODAL PENGEMBALIAN --}}
{{-- ======================= --}}
@if ($showReturnModal)
    <div class="fixed inset-0 z-50 flex items-center justify-center p-4"
        x-data x-init="$el.querySelector('.modal-box').classList.add('scale-100', 'opacity-100')">

        {{-- Backdrop --}}
        <div wire:click="closeReturnModal" class="absolute inset-0 bg-black/70 backdrop-blur-sm"></div>

        {{-- Modal Box --}}
        <div class="modal-box relative z-10 w-full max-w-md bg-slate-900 border border-slate-700 rounded-[2.5rem] p-8 shadow-2xl scale-95 opacity-0 transition-all duration-200 space-y-6">

            <div class="flex items-center justify-between">
                <h3 class="text-sm font-black text-white italic uppercase tracking-tighter">Konfirmasi Pengembalian</h3>
                <button wire:click="closeReturnModal" class="text-slate-500 hover:text-white transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <div>
                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2 px-2 italic">
                    Tanggal Pengembalian Realisasi
                </label>
                <input wire:model="tanggal_kembali_realisasi" type="date"
                    class="w-full bg-slate-950 border @error('tanggal_kembali_realisasi') border-red-500 @else border-slate-700 @enderror rounded-2xl py-3 px-5 text-sm text-white focus:border-emerald-500 outline-none transition-all">
                @error('tanggal_kembali_realisasi')
                    <p class="mt-1 text-xs text-red-400 font-bold px-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-3 pt-2">
                <button wire:click="closeReturnModal"
                    class="flex-1 py-3 bg-slate-800 hover:bg-slate-700 text-slate-400 text-xs font-black rounded-2xl uppercase tracking-widest transition-all italic">
                    Batal
                </button>
                <button wire:click="confirmReturn" wire:loading.attr="disabled"
                    class="flex-1 py-3 bg-emerald-600 hover:bg-emerald-500 disabled:opacity-50 text-white text-xs font-black rounded-2xl uppercase tracking-widest transition-all italic shadow-lg shadow-emerald-600/20">
                    <span wire:loading.remove wire:target="confirmReturn">✓ Konfirmasi</span>
                    <span wire:loading wire:target="confirmReturn">Menyimpan...</span>
                </button>
            </div>
        </div>
    </div>
@endif

@endsection