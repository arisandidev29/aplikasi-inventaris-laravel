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
    <!-- Header & Action Section -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div>
            <h2 class="text-3xl font-black text-white italic tracking-tighter uppercase">Rekapitulasi Stok</h2>
            <p class="text-slate-500 text-sm font-medium">Laporan mutasi barang dan posisi stok akhir secara periodik.</p>
        </div>
        <div class="flex flex-wrap items-center gap-3">
            <button class="flex items-center gap-2 px-6 py-3 bg-slate-900 border border-slate-800 text-slate-300 text-[10px] font-black rounded-2xl hover:bg-slate-800 transition-all uppercase tracking-widest italic">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                Export PDF
            </button>
            <button class="flex items-center gap-2 px-6 py-3 bg-blue-600 hover:bg-blue-500 text-white text-[10px] font-black rounded-2xl shadow-lg shadow-blue-600/20 transition-all uppercase tracking-widest italic">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                Cetak Laporan
            </button>
        </div>
    </div>

    <!-- Filter Bar -->
    <div class="p-6 bg-slate-900 border border-slate-800 rounded-[2.5rem] flex flex-wrap items-center gap-4">
        <div class="flex flex-col gap-1 flex-1 min-w-[200px]">
            <label class="text-[9px] font-black text-slate-600 uppercase tracking-widest ml-2 italic">Periode Laporan</label>
            <div class="flex items-center gap-2">
                <input type="date" class="flex-1 bg-slate-950 border border-slate-800 rounded-xl py-2 px-4 text-xs text-white focus:border-blue-600 outline-none">
                <span class="text-slate-600 text-xs">-</span>
                <input type="date" class="flex-1 bg-slate-950 border border-slate-800 rounded-xl py-2 px-4 text-xs text-white focus:border-blue-600 outline-none">
            </div>
        </div>
        <div class="flex flex-col gap-1 w-full md:w-auto">
            <label class="text-[9px] font-black text-slate-600 uppercase tracking-widest ml-2 italic">Kategori</label>
            <select class="bg-slate-950 border border-slate-800 rounded-xl py-2 px-6 text-xs text-white outline-none focus:border-blue-600 uppercase italic font-bold">
                <option>Semua Kategori</option>
                <option>Barang IT</option>
                <option>Barang Publikasi</option>
            </select>
        </div>
        <div class="flex flex-col gap-1 w-full md:w-auto self-end">
            <button class="bg-slate-800 hover:bg-slate-700 text-white px-6 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all italic">
                Filter Data
            </button>
        </div>
    </div>

    <!-- Summary Stats -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="p-6 bg-slate-900 border border-slate-800 rounded-[2rem]">
            <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1 italic">Total Item Terdaftar</p>
            <h3 class="text-3xl font-black text-white italic tracking-tighter">1,420</h3>
        </div>
        <div class="p-6 bg-slate-900 border border-slate-800 rounded-[2rem] border-l-4 border-l-emerald-500">
            <p class="text-[10px] font-black text-emerald-500 uppercase tracking-widest mb-1 italic">Barang Masuk (Periode)</p>
            <h3 class="text-3xl font-black text-white italic tracking-tighter">+245</h3>
        </div>
        <div class="p-6 bg-slate-900 border border-slate-800 rounded-[2rem] border-l-4 border-l-red-500">
            <p class="text-[10px] font-black text-red-500 uppercase tracking-widest mb-1 italic">Barang Keluar (Periode)</p>
            <h3 class="text-3xl font-black text-white italic tracking-tighter">-112</h3>
        </div>
        <div class="p-6 bg-slate-900 border border-slate-800 rounded-[2rem] border-l-4 border-l-blue-500">
            <p class="text-[10px] font-black text-blue-500 uppercase tracking-widest mb-1 italic">Valuasi Stok Aktif</p>
            <h3 class="text-3xl font-black text-white italic tracking-tighter">88%</h3>
        </div>
    </div>

    <!-- Main Report Table -->
    <div class="bg-slate-900 border border-slate-800 rounded-[3rem] overflow-hidden shadow-2xl">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-slate-950/50 text-[10px] font-black text-slate-500 uppercase tracking-[0.2em] italic">
                    <tr>
                        <th class="px-8 py-6 border-b border-slate-800">Nama Barang / SKU</th>
                        <th class="px-8 py-6 border-b border-slate-800 text-center">Stok Awal</th>
                        <th class="px-8 py-6 border-b border-slate-800 text-center text-emerald-500">Masuk (+)</th>
                        <th class="px-8 py-6 border-b border-slate-800 text-center text-red-500">Keluar (-)</th>
                        <th class="px-8 py-6 border-b border-slate-800 text-center">Stok Akhir</th>
                        <th class="px-8 py-6 border-b border-slate-800 text-right">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800/50 font-medium">
                    <!-- Row 1 -->
                    <tr class="group hover:bg-white/[0.02] transition-all">
                        <td class="px-8 py-6">
                            <p class="text-sm font-bold text-white tracking-tight italic">MacBook Pro M3 14"</p>
                            <p class="text-[9px] text-slate-600 uppercase font-black">SKU: IT-LAP-001</p>
                        </td>
                        <td class="px-8 py-6 text-center text-slate-400 font-mono text-sm">12</td>
                        <td class="px-8 py-6 text-center text-emerald-500 font-black text-sm">+2</td>
                        <td class="px-8 py-6 text-center text-red-500 font-black text-sm">-1</td>
                        <td class="px-8 py-6 text-center text-white font-black text-lg italic">13</td>
                        <td class="px-8 py-6 text-right">
                            <span class="px-3 py-1 bg-emerald-500/10 text-emerald-500 text-[9px] font-black rounded-lg border border-emerald-500/20 uppercase italic">Aman</span>
                        </td>
                    </tr>
                    <!-- Row 2 -->
                    <tr class="group hover:bg-white/[0.02] transition-all">
                        <td class="px-8 py-6">
                            <p class="text-sm font-bold text-white tracking-tight italic">Kertas A4 PaperOne 80gr</p>
                            <p class="text-[9px] text-slate-600 uppercase font-black">SKU: PB-KRT-042</p>
                        </td>
                        <td class="px-8 py-6 text-center text-slate-400 font-mono text-sm">450</td>
                        <td class="px-8 py-6 text-center text-emerald-500 font-black text-sm">+100</td>
                        <td class="px-8 py-6 text-center text-red-500 font-black text-sm">-520</td>
                        <td class="px-8 py-6 text-center text-white font-black text-lg italic">30</td>
                        <td class="px-8 py-6 text-right">
                            <span class="px-3 py-1 bg-red-500/10 text-red-500 text-[9px] font-black rounded-lg border border-red-500/20 uppercase italic animate-pulse">Low Stock</span>
                        </td>
                    </tr>
                    <!-- Row 3 -->
                    <tr class="group hover:bg-white/[0.02] transition-all">
                        <td class="px-8 py-6">
                            <p class="text-sm font-bold text-white tracking-tight italic">Toner HP Laserjet CF283A</p>
                            <p class="text-[9px] text-slate-600 uppercase font-black">SKU: IT-TNR-088</p>
                        </td>
                        <td class="px-8 py-6 text-center text-slate-400 font-mono text-sm">15</td>
                        <td class="px-8 py-6 text-center text-emerald-500 font-black text-sm">+0</td>
                        <td class="px-8 py-6 text-center text-red-500 font-black text-sm">-15</td>
                        <td class="px-8 py-6 text-center text-red-600 font-black text-lg italic">0</td>
                        <td class="px-8 py-6 text-right">
                            <span class="px-3 py-1 bg-red-600 text-white text-[9px] font-black rounded-lg uppercase italic shadow-lg shadow-red-600/20">Kosong</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Table Footer Info -->
        <div class="p-8 bg-slate-950/30 border-t border-slate-800 flex flex-col md:flex-row justify-between items-center gap-4">
            <div class="flex items-center gap-4">
                <div class="flex items-center gap-2">
                    <span class="w-3 h-3 rounded-full bg-emerald-500"></span>
                    <span class="text-[9px] font-black text-slate-500 uppercase italic">Aman</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="w-3 h-3 rounded-full bg-red-500 animate-pulse"></span>
                    <span class="text-[9px] font-black text-slate-500 uppercase italic">Stok Rendah</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="w-3 h-3 rounded bg-red-600"></span>
                    <span class="text-[9px] font-black text-slate-500 uppercase italic">Habis</span>
                </div>
            </div>
            <p class="text-[10px] font-black text-slate-600 uppercase tracking-widest italic">Laporan dibuat secara otomatis oleh StockHub System</p>
        </div>
    </div>
</div>
@endsection