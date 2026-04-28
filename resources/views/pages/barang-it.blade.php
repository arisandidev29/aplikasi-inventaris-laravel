<?php

use Livewire\Component;

new class extends Component {
    //
};
?>

@extends('layout')

@section('page_title', 'Ringkasan Statistik')

@section("content")

<main class="flex-1 flex flex-col min-w-0 overflow-hidden bg-[#0a0f1d]">
    <header class="flex items-center justify-between h-20 px-8 bg-[#111827] border-b border-slate-800 shrink-0">
        <div class="flex items-center gap-4">
            <button @click="sidebarOpen = !sidebarOpen" class="text-slate-400 lg:hidden font-bold">MENU</button>
            <h2 class="text-xl font-bold text-white">Inventaris Barang IT</h2>
        </div>
        <button
            class="px-5 py-2.5 bg-blue-600 hover:bg-blue-500 text-white text-xs font-bold rounded-xl shadow-lg shadow-blue-600/20 uppercase tracking-widest transition-all">
            + Tambah Barang
        </button>
    </header>

    <div class="flex-1 overflow-y-auto p-8 custom-scrollbar">
        <!-- Search & Filter Card -->
        <div class="mb-8 p-6 bg-slate-900 border border-slate-800 rounded-3xl flex flex-wrap gap-4 items-center">
            <div class="relative flex-1 min-w-[300px]">
                <input type="text" placeholder="Cari Serial Number atau Nama Barang..."
                    class="w-full bg-slate-950 border border-slate-800 rounded-2xl py-3 px-5 text-sm text-white focus:border-blue-500 outline-none">
            </div>
            <select
                class="bg-slate-950 border border-slate-800 rounded-2xl py-3 px-5 text-sm text-slate-400 outline-none focus:border-blue-500">
                <option>Semua Kategori</option>
                <option>Laptop</option>
                <option>Peripheral</option>
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
                <tbody class="divide-y divide-slate-800/50">
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
                </tbody>
            </table>
        </div>
    </div>
</main>
@endsection