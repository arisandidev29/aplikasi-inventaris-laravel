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
            <h2 class="text-3xl font-black text-white italic tracking-tighter uppercase text-amber-500">Sirkulasi Peminjaman</h2>
            <p class="text-slate-500 text-sm font-medium">Lacak aset yang sedang digunakan sementara oleh staff.</p>
        </div>
        <button class="flex items-center justify-center gap-3 px-6 py-3 bg-amber-600 hover:bg-amber-500 text-white text-xs font-black rounded-2xl transition-all shadow-lg shadow-amber-600/20 uppercase tracking-widest italic">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Buat Peminjaman Baru
        </button>
    </div>

    <!-- Loan Analytics -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="p-6 bg-slate-900 border border-slate-800 rounded-[2rem] shadow-xl">
            <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1 italic">Sedang Dipinjam</p>
            <div class="flex items-center gap-3">
                <h3 class="text-4xl font-black text-white italic tracking-tighter">14</h3>
                <span class="text-[10px] font-bold text-amber-500 bg-amber-500/10 px-2 py-1 rounded-lg">Active</span>
            </div>
        </div>
        <div class="p-6 bg-slate-900 border border-slate-800 rounded-[2rem] shadow-xl border-l-4 border-l-red-600">
            <p class="text-[10px] font-black text-red-500 uppercase tracking-widest mb-1 italic">Terlambat Kembali</p>
            <div class="flex items-center gap-3">
                <h3 class="text-4xl font-black text-white italic tracking-tighter">03</h3>
                <span class="text-[10px] font-bold text-red-500 bg-red-500/10 px-2 py-1 rounded-lg animate-pulse">Overdue</span>
            </div>
        </div>
        <div class="p-6 bg-slate-900 border border-slate-800 rounded-[2rem] shadow-xl">
            <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1 italic">Kembali Hari Ini</p>
            <div class="flex items-center gap-3">
                <h3 class="text-4xl font-black text-white italic tracking-tighter">05</h3>
                <span class="text-[10px] font-bold text-emerald-500 bg-emerald-500/10 px-2 py-1 rounded-lg">Pending</span>
            </div>
        </div>
    </div>

    <!-- Active Loans Table -->
    <div class="bg-slate-900 border border-slate-800 rounded-[3rem] overflow-hidden shadow-2xl">
        <div class="p-8 border-b border-slate-800 flex flex-col md:flex-row justify-between items-center gap-6">
            <div class="relative w-full md:w-96">
                <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-500">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </span>
                <input type="text" placeholder="Cari nama staff atau barang..." class="w-full bg-slate-950 border border-slate-800 rounded-2xl py-3 pl-12 pr-4 text-sm text-white focus:border-amber-500 outline-none transition-all italic">
            </div>
            <div class="flex gap-2 w-full md:w-auto">
                <button class="flex-1 md:flex-none px-6 py-3 bg-slate-950 border border-slate-800 text-[10px] font-black text-slate-400 uppercase tracking-widest rounded-xl hover:text-white transition-all italic">
                    Filter Status
                </button>
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
                        <th class="px-8 py-5 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800/50">
                    <!-- Overdue Item -->
                    <tr class="group hover:bg-red-600/[0.02] transition-colors">
                        <td class="px-8 py-6">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center font-black text-slate-500 text-xs">RS</div>
                                <div>
                                    <p class="text-sm font-bold text-white tracking-tight">Rian Septiadi</p>
                                    <p class="text-[9px] text-slate-500 uppercase font-black tracking-widest">Divisi Kreatif</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-8 py-6">
                            <p class="text-sm font-bold text-slate-300 italic">Kamera Sony A7III + Lensa</p>
                            <p class="text-[9px] text-slate-600 uppercase font-black">ID: CAM-001-IT</p>
                        </td>
                        <td class="px-8 py-6 text-xs text-slate-500 font-mono">12 Apr 2024</td>
                        <td class="px-8 py-6">
                            <div class="flex flex-col">
                                <span class="text-xs text-red-500 font-bold italic">19 Apr 2024</span>
                                <span class="text-[9px] text-red-600 uppercase font-black">Terlambat 3 Hari</span>
                            </div>
                        </td>
                        <td class="px-8 py-6 text-right">
                            <button class="px-4 py-2 bg-emerald-600/10 text-emerald-500 text-[10px] font-black rounded-xl uppercase italic border border-emerald-500/20 hover:bg-emerald-600 hover:text-white transition-all">
                                Kembalikan
                            </button>
                        </td>
                    </tr>

                    <!-- Normal Item -->
                    <tr class="group hover:bg-amber-600/[0.02] transition-colors">
                        <td class="px-8 py-6">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center font-black text-slate-500 text-xs">AN</div>
                                <div>
                                    <p class="text-sm font-bold text-white tracking-tight">Anisa Nurul</p>
                                    <p class="text-[9px] text-slate-500 uppercase font-black tracking-widest">Sekretariat</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-8 py-6">
                            <p class="text-sm font-bold text-slate-300 italic">Projector Epson EB-X400</p>
                            <p class="text-[9px] text-slate-600 uppercase font-black">ID: PRJ-042-IT</p>
                        </td>
                        <td class="px-8 py-6 text-xs text-slate-500 font-mono">22 Apr 2024</td>
                        <td class="px-8 py-6">
                            <span class="text-xs text-slate-400 font-bold italic">25 Apr 2024</span>
                        </td>
                        <td class="px-8 py-6 text-right">
                            <button class="px-4 py-2 bg-emerald-600/10 text-emerald-500 text-[10px] font-black rounded-xl uppercase italic border border-emerald-500/20 hover:bg-emerald-600 hover:text-white transition-all">
                                Kembalikan
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Pagination / Info -->
        <div class="p-8 bg-slate-950/30 border-t border-slate-800 flex justify-between items-center">
            <p class="text-[10px] font-black text-slate-600 uppercase tracking-widest italic">Menampilkan sirkulasi aktif</p>
            <div class="flex gap-2">
                <button class="p-2 text-slate-500 hover:text-white"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg></button>
                <button class="p-2 text-slate-500 hover:text-white"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg></button>
            </div>
        </div>
    </div>
</div>
@endsection