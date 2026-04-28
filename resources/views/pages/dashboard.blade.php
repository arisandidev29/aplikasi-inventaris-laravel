<?php

use Livewire\Component;

new class extends Component
{
    //
};
?>


@extends('layout')

@section('page_title', 'Ringkasan Statistik')

@section('content')
<div class="space-y-8">
    <!-- Header Welcome -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl font-black text-white italic tracking-tighter uppercase">Statistik Gudang</h1>
            <p class="text-slate-500 text-sm font-medium">Pantau pergerakan stok IT dan Publikasi secara real-time.</p>
        </div>
        <div class="flex items-center gap-3">
            <span class="flex items-center gap-2 px-4 py-2 bg-slate-900 border border-slate-800 rounded-xl text-[10px] font-black text-slate-400 uppercase tracking-widest italic">
                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                Sistem Online
            </span>
        </div>
    </div>

    <!-- Row 1: Quick Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Card 1: Total IT -->
        <div class="group p-6 bg-slate-900 border border-slate-800 rounded-[2.5rem] hover:border-blue-600/50 transition-all duration-500 shadow-xl">
            <div class="flex justify-between items-start mb-4">
                <div class="p-3 bg-blue-600/10 rounded-2xl text-blue-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                </div>
                <span class="text-[10px] font-black text-emerald-500 bg-emerald-500/10 px-2 py-1 rounded-lg">+12.5%</span>
            </div>
            <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1 italic">Barang IT Aktif</p>
            <h3 class="text-4xl font-black text-white italic tracking-tighter">842 <span class="text-sm font-normal text-slate-600 not-italic uppercase ml-1 tracking-normal">Unit</span></h3>
        </div>

        <!-- Card 2: Stok Publikasi -->
        <div class="group p-6 bg-slate-900 border border-slate-800 rounded-[2.5rem] hover:border-blue-600/50 transition-all duration-500 shadow-xl">
            <div class="flex justify-between items-start mb-4">
                <div class="p-3 bg-purple-600/10 rounded-2xl text-purple-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                </div>
                <span class="text-[10px] font-black text-slate-500 bg-slate-800 px-2 py-1 rounded-lg">Stabil</span>
            </div>
            <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1 italic">Stok Publikasi</p>
            <h3 class="text-4xl font-black text-white italic tracking-tighter">3,120 <span class="text-sm font-normal text-slate-600 not-italic uppercase ml-1 tracking-normal">Pcs</span></h3>
        </div>

        <!-- Card 3: Sedang Dipinjam -->
        <div class="group p-6 bg-slate-900 border border-slate-800 rounded-[2.5rem] hover:border-amber-600/50 transition-all duration-500 shadow-xl">
            <div class="flex justify-between items-start mb-4">
                <div class="p-3 bg-amber-600/10 rounded-2xl text-amber-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                </div>
                <span class="text-[10px] font-black text-amber-500 bg-amber-500/10 px-2 py-1 rounded-lg">7 Pending</span>
            </div>
            <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1 italic">Peminjaman</p>
            <h3 class="text-4xl font-black text-white italic tracking-tighter">14 <span class="text-sm font-normal text-slate-600 not-italic uppercase ml-1 tracking-normal">Items</span></h3>
        </div>

        <!-- Card 4: Kondisi Rusak -->
        <div class="group p-6 bg-slate-900 border border-slate-800 rounded-[2.5rem] hover:border-red-600/50 transition-all duration-500 shadow-xl">
            <div class="flex justify-between items-start mb-4">
                <div class="p-3 bg-red-600/10 rounded-2xl text-red-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                </div>
                <span class="text-[10px] font-black text-red-500 bg-red-500/10 px-2 py-1 rounded-lg">Perlu Cek</span>
            </div>
            <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1 italic">Barang Rusak</p>
            <h3 class="text-4xl font-black text-white italic tracking-tighter">03 <span class="text-sm font-normal text-slate-600 not-italic uppercase ml-1 tracking-normal">Unit</span></h3>
        </div>
    </div>

    <!-- Row 2: Charts & Performance -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Visual Tren (Placeholder Grafik) -->
        <div class="lg:col-span-2 p-8 bg-slate-900 border border-slate-800 rounded-[3rem] shadow-2xl relative overflow-hidden">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h3 class="text-lg font-black text-white italic uppercase tracking-tighter">Alur Keluar Masuk Barang</h3>
                    <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Data 7 Hari Terakhir</p>
                </div>
                <select class="bg-slate-950 border border-slate-800 rounded-xl px-4 py-2 text-xs text-slate-400 focus:ring-1 focus:ring-blue-600 outline-none">
                    <option>Mingguan</option>
                    <option>Bulanan</option>
                </select>
            </div>
            
            <!-- Mock Chart Visualization -->
            <div class="h-64 flex items-end justify-between gap-2 px-2">
                @for($i=0; $i<14; $i++)
                    <div class="w-full group relative flex flex-col items-center">
                        <div class="w-full bg-blue-600/20 rounded-t-lg transition-all duration-500 group-hover:bg-blue-600/40" style="height: {{ rand(20, 90) }}%"></div>
                        <div class="w-full bg-blue-600 rounded-t-lg absolute bottom-0 transition-all duration-700 group-hover:h-1/2 shadow-[0_0_15px_rgba(37,99,235,0.4)]" style="height: {{ rand(10, 40) }}%"></div>
                    </div>
                @endfor
            </div>
            <div class="flex justify-between mt-6 text-[10px] font-black text-slate-600 uppercase tracking-widest italic px-2">
                <span>Sen</span><span>Sel</span><span>Rab</span><span>Kam</span><span>Jum</span><span>Sab</span><span>Min</span>
            </div>
        </div>

        <!-- Breakdown Kategori -->
        <div class="p-8 bg-slate-900 border border-slate-800 rounded-[3rem] shadow-2xl">
            <h3 class="text-lg font-black text-white italic uppercase tracking-tighter mb-8">Kapasitas Gudang</h3>
            <div class="space-y-8">
                <!-- IT -->
                <div class="space-y-3">
                    <div class="flex justify-between text-xs font-black uppercase tracking-widest italic">
                        <span class="text-slate-400">Rak Barang IT</span>
                        <span class="text-white">65%</span>
                    </div>
                    <div class="w-full bg-slate-950 h-3 rounded-full overflow-hidden border border-slate-800">
                        <div class="bg-blue-600 h-full rounded-full shadow-[0_0_10px_rgba(37,99,235,0.5)]" style="width: 65%"></div>
                    </div>
                </div>
                <!-- Publikasi -->
                <div class="space-y-3">
                    <div class="flex justify-between text-xs font-black uppercase tracking-widest italic">
                        <span class="text-slate-400">Area Publikasi</span>
                        <span class="text-white">88%</span>
                    </div>
                    <div class="w-full bg-slate-950 h-3 rounded-full overflow-hidden border border-slate-800">
                        <div class="bg-purple-600 h-full rounded-full shadow-[0_0_10px_rgba(147,51,234,0.5)]" style="width: 88%"></div>
                    </div>
                </div>
                <!-- Transit -->
                <div class="space-y-3">
                    <div class="flex justify-between text-xs font-black uppercase tracking-widest italic">
                        <span class="text-slate-400">Ruang Transit</span>
                        <span class="text-white">12%</span>
                    </div>
                    <div class="w-full bg-slate-950 h-3 rounded-full overflow-hidden border border-slate-800">
                        <div class="bg-emerald-600 h-full rounded-full shadow-[0_0_10px_rgba(16,185,129,0.5)]" style="width: 12%"></div>
                    </div>
                </div>
            </div>

            <button class="w-full mt-12 py-4 bg-slate-800 hover:bg-slate-700 text-white text-[10px] font-black uppercase tracking-[0.2em] rounded-2xl transition-all italic">
                Lihat Detail Denah
            </button>
        </div>
    </div>

    <!-- Row 3: Recent Activity Table -->
    <div class="bg-slate-900 border border-slate-800 rounded-[3rem] overflow-hidden shadow-2xl">
        <div class="p-8 border-b border-slate-800 flex flex-col sm:flex-row justify-between items-center gap-4">
            <div>
                <h3 class="text-xl font-black text-white italic uppercase tracking-tighter">Aktivitas Terkini</h3>
                <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Log harian pergerakan barang</p>
            </div>
            <div class="flex gap-2">
                <button class="p-2 bg-slate-950 border border-slate-800 rounded-xl text-slate-400 hover:text-white transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg>
                </button>
                <button class="px-6 py-2 bg-blue-600 hover:bg-blue-500 text-white text-[10px] font-black uppercase tracking-widest rounded-xl shadow-lg shadow-blue-600/20 transition-all italic">
                    Semua Log
                </button>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-slate-950/50 text-[10px] font-black text-slate-500 uppercase tracking-[0.2em] italic">
                    <tr>
                        <th class="px-8 py-5">Barang / Item</th>
                        <th class="px-8 py-5">Tipe Aktivitas</th>
                        <th class="px-8 py-5">User</th>
                        <th class="px-8 py-5">Waktu</th>
                        <th class="px-8 py-5 text-right">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800/50">
                    <tr class="group hover:bg-blue-600/[0.02] transition-colors cursor-default">
                        <td class="px-8 py-6">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-xl bg-emerald-500/10 flex items-center justify-center text-emerald-500 font-black italic text-xs">IN</div>
                                <div>
                                    <p class="text-sm font-bold text-white tracking-tight">Kertas A4 PaperOne 80gr</p>
                                    <p class="text-[10px] text-slate-500 uppercase font-medium">Kategori: Publikasi</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-8 py-6">
                            <span class="text-xs font-bold text-slate-300 italic tracking-tighter">Penerimaan Stok (+50 Rim)</span>
                        </td>
                        <td class="px-8 py-6 italic font-bold text-xs text-slate-500">Admin_Gudang</td>
                        <td class="px-8 py-6 text-xs text-slate-500 font-mono tracking-tighter uppercase">Hari ini, 14:20</td>
                        <td class="px-8 py-6 text-right">
                            <span class="px-3 py-1 bg-emerald-500/10 text-emerald-500 text-[10px] font-black rounded-full uppercase italic tracking-tighter border border-emerald-500/20">Success</span>
                        </td>
                    </tr>
                    <tr class="group hover:bg-blue-600/[0.02] transition-colors cursor-default">
                        <td class="px-8 py-6">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-xl bg-blue-500/10 flex items-center justify-center text-blue-500 font-black italic text-xs">OUT</div>
                                <div>
                                    <p class="text-sm font-bold text-white tracking-tight">Laptop Dell Latitude 5430</p>
                                    <p class="text-[10px] text-slate-500 uppercase font-medium">SN: DELL-X88-212</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-8 py-6">
                            <span class="text-xs font-bold text-slate-300 italic tracking-tighter">Peminjaman Staff (Marketing)</span>
                        </td>
                        <td class="px-8 py-6 italic font-bold text-xs text-slate-500">Superuser</td>
                        <td class="px-8 py-6 text-xs text-slate-500 font-mono tracking-tighter uppercase">Hari ini, 10:05</td>
                        <td class="px-8 py-6 text-right">
                            <span class="px-3 py-1 bg-blue-500/10 text-blue-500 text-[10px] font-black rounded-full uppercase italic tracking-tighter border border-blue-500/20">Dipinjam</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection