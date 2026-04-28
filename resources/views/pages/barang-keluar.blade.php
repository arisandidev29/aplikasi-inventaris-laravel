<?php

use Livewire\Component;

new class extends Component {
    //
};
?>

@extends('layout')

@section('page_title', 'Ringkasan Statistik')

@section("content")
<div class="space-y-8">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h2 class="text-3xl font-black text-white italic tracking-tighter uppercase text-red-500">Pengeluaran Stok</h2>
            <p class="text-slate-500 text-sm font-medium">Catat pengeluaran barang untuk kegunaan staff atau pembuangan.</p>
        </div>
        <div class="flex items-center gap-3">
            <span class="px-4 py-2 bg-red-500/10 border border-red-500/20 rounded-xl text-[10px] font-black text-red-500 uppercase tracking-widest italic">
                Awas: Stok Akan Berkurang
            </span>
        </div>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
        <!-- Form Pengeluaran -->
        <div class="xl:col-span-2">
            <div class="p-8 bg-slate-900 border border-slate-800 rounded-[2.5rem] shadow-2xl">
                <form class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2 px-2 italic">Tarikh Keluar</label>
                            <input type="date" class="w-full bg-slate-950 border border-slate-800 rounded-2xl py-3 px-5 text-sm text-white focus:border-red-600 outline-none transition-all">
                        </div>
                        <div>
                            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2 px-2 italic">Tujuan / Projek</label>
                            <input type="text" placeholder="Cth: Projek Website 2024" class="w-full bg-slate-950 border border-slate-800 rounded-2xl py-3 px-5 text-sm text-white focus:border-red-600 outline-none transition-all">
                        </div>
                    </div>

                    <div>
                        <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2 px-2 italic">Cari Barang</label>
                        <div class="relative">
                            <input type="text" placeholder="Taip nama barang atau scan S/N..." class="w-full bg-slate-950 border border-slate-800 rounded-2xl py-3 px-5 text-sm text-white focus:border-red-600 outline-none transition-all italic">
                            <span class="absolute right-4 top-3 text-slate-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                            </span>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2 px-2 italic">Kuantiti Keluar</label>
                            <input type="number" placeholder="0" class="w-full bg-slate-950 border border-slate-800 rounded-2xl py-3 px-5 text-xl font-black text-red-500 focus:border-red-600 outline-none transition-all">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2 px-2 italic">Penerima / Staff</label>
                            <input type="text" placeholder="Nama Staff yang memohon" class="w-full bg-slate-950 border border-slate-800 rounded-2xl py-3 px-5 text-sm text-white focus:border-red-600 outline-none transition-all">
                        </div>
                    </div>

                    <div class="pt-6 border-t border-slate-800 flex justify-end">
                        <button class="px-10 py-4 bg-red-600 hover:bg-red-500 text-white text-xs font-black rounded-2xl shadow-lg shadow-red-600/20 uppercase tracking-[0.2em] transition-all italic">
                            Sahkan Pengeluaran
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Panel Stok Rendah (Alert) -->
        <div class="space-y-6">
            <div class="p-8 bg-red-600/5 border border-red-500/10 rounded-[2.5rem]">
                <h4 class="text-[10px] font-black text-red-500 uppercase tracking-[0.2em] mb-6 italic flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                    Awas: Stok Kritikal
                </h4>
                <div class="space-y-4">
                    <div class="p-4 bg-slate-950 rounded-2xl border border-slate-800">
                        <p class="text-xs font-bold text-white italic">Kabel HDMI 2.0</p>
                        <div class="flex justify-between items-center mt-2">
                            <span class="text-[9px] font-black text-slate-500 uppercase">Tinggal 2 Unit</span>
                            <span class="text-[9px] font-black text-red-500 uppercase">Beli Baru</span>
                        </div>
                    </div>
                    <div class="p-4 bg-slate-950 rounded-2xl border border-slate-800">
                        <p class="text-xs font-bold text-white italic">Bateri AA (Pack)</p>
                        <div class="flex justify-between items-center mt-2">
                            <span class="text-[9px] font-black text-slate-500 uppercase">Tinggal 5 Unit</span>
                            <span class="text-[9px] font-black text-red-500 uppercase">Kritikal</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection