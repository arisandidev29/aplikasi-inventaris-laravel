<?php

use Livewire\Component;

new class extends Component {
    //
};
?>


@extends('layout')

@section('page_title', 'Ringkasan Statistik')

@section('content')
    <div class="space-y-8">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="text-3xl font-black text-white italic tracking-tighter uppercase">Manajemen Kategori</h2>
                <p class="text-slate-500 text-sm font-medium">Klasifikasikan aset IT dan logistik publikasi Anda.</p>
            </div>
            <button
                class="flex items-center justify-center gap-3 px-6 py-3 bg-blue-600 hover:bg-blue-500 text-white text-xs font-black rounded-2xl transition-all shadow-lg shadow-blue-600/20 uppercase tracking-widest italic">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Kategori
            </button>
        </div>

        <!-- Quick Filter Stats -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
            <div
                class="p-6 bg-slate-900 border border-slate-800 rounded-[2rem] flex items-center gap-4 group hover:border-blue-500/50 transition-all cursor-pointer">
                <div
                    class="w-12 h-12 rounded-2xl bg-blue-600/10 flex items-center justify-center text-blue-500 font-black italic">
                    IT</div>
                <div>
                    <p class="text-2xl font-black text-white italic">12</p>
                    <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Kategori IT</p>
                </div>
            </div>
            <div
                class="p-6 bg-slate-900 border border-slate-800 rounded-[2rem] flex items-center gap-4 group hover:border-purple-500/50 transition-all cursor-pointer">
                <div
                    class="w-12 h-12 rounded-2xl bg-purple-600/10 flex items-center justify-center text-purple-500 font-black italic">
                    PB</div>
                <div>
                    <p class="text-2xl font-black text-white italic">08</p>
                    <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Kategori Publikasi</p>
                </div>
            </div>
            <div
                class="p-6 bg-slate-900 border border-slate-800 rounded-[2rem] flex items-center gap-4 group hover:border-emerald-500/50 transition-all cursor-pointer">
                <div
                    class="w-12 h-12 rounded-2xl bg-emerald-600/10 flex items-center justify-center text-emerald-500 font-black italic">
                    AS</div>
                <div>
                    <p class="text-2xl font-black text-white italic">450</p>
                    <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Total Aset Terdaftar</p>
                </div>
            </div>
        </div>

        <!-- Main Content: Category List -->
        <div class="bg-slate-900 border border-slate-800 rounded-[3rem] overflow-hidden shadow-2xl">
            <!-- Toolbar Table -->
            <div class="p-8 border-b border-slate-800 flex flex-col md:flex-row justify-between items-center gap-4">
                <div class="relative w-full md:w-96">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-500">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </span>
                    <input type="text" placeholder="Cari nama kategori..."
                        class="w-full bg-slate-950 border border-slate-800 rounded-2xl py-3 pl-12 pr-4 text-sm text-white focus:border-blue-500 outline-none transition-all italic">
                </div>
                <div class="flex items-center gap-3 w-full md:w-auto">
                    <select
                        class="bg-slate-950 border border-slate-800 rounded-xl py-3 px-6 text-xs font-bold text-slate-400 outline-none focus:border-blue-500 uppercase tracking-widest italic">
                        <option>Semua Induk</option>
                        <option>Barang IT</option>
                        <option>Barang Publikasi</option>
                    </select>
                </div>
            </div>

            <!-- Category Grid -->
            <div class="p-8 grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                <!-- Item Kategori 1 -->
                <div
                    class="p-6 bg-slate-950/50 border border-slate-800 rounded-3xl hover:bg-slate-800/30 transition-all group">
                    <div class="flex justify-between items-start mb-6">
                        <span
                            class="px-3 py-1 bg-blue-600/10 text-blue-500 text-[10px] font-black rounded-lg uppercase italic tracking-tighter border border-blue-600/20">Aset
                            IT</span>
                        <div class="flex gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                            <button class="p-2 text-slate-500 hover:text-white bg-slate-800 rounded-lg"><svg class="w-4 h-4"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                </svg></button>
                            <button class="p-2 text-slate-500 hover:text-red-500 bg-slate-800 rounded-lg"><svg
                                    class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg></button>
                        </div>
                    </div>
                    <h4 class="text-xl font-black text-white italic tracking-tighter uppercase mb-2">Komputer & Laptop</h4>
                    <p class="text-xs text-slate-500 font-medium leading-relaxed mb-6">Mencakup laptop staff, PC
                        workstation, dan server internal perusahaan.</p>
                    <div class="flex items-center justify-between pt-4 border-t border-slate-800/50">
                        <span class="text-[10px] font-black text-slate-600 uppercase tracking-widest italic">Total
                            Item</span>
                        <span class="text-sm font-black text-white italic">142 Unit</span>
                    </div>
                </div>

                <!-- Item Kategori 2 -->
                <div
                    class="p-6 bg-slate-950/50 border border-slate-800 rounded-3xl hover:bg-slate-800/30 transition-all group">
                    <div class="flex justify-between items-start mb-6">
                        <span
                            class="px-3 py-1 bg-purple-600/10 text-purple-500 text-[10px] font-black rounded-lg uppercase italic tracking-tighter border border-purple-600/20">Publikasi</span>
                        <div class="flex gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                            <button class="p-2 text-slate-500 hover:text-white bg-slate-800 rounded-lg"><svg class="w-4 h-4"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                </svg></button>
                            <button class="p-2 text-slate-500 hover:text-red-500 bg-slate-800 rounded-lg"><svg
                                    class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg></button>
                        </div>
                    </div>
                    <h4 class="text-xl font-black text-white italic tracking-tighter uppercase mb-2">Alat Tulis Kantor</h4>
                    <p class="text-xs text-slate-500 font-medium leading-relaxed mb-6">Kertas, tinta printer, banner, dan
                        kebutuhan administrasi cetak.</p>
                    <div class="flex items-center justify-between pt-4 border-t border-slate-800/50">
                        <span class="text-[10px] font-black text-slate-600 uppercase tracking-widest italic">Total
                            Item</span>
                        <span class="text-sm font-black text-white italic">2,401 Pcs</span>
                    </div>
                </div>

                <!-- Item Kategori 3 (Empty State Style) -->
                <div
                    class="p-6 border-2 border-dashed border-slate-800 rounded-3xl flex flex-col items-center justify-center text-center group hover:border-blue-600/30 transition-all cursor-pointer">
                    <div
                        class="w-12 h-12 rounded-full bg-slate-900 flex items-center justify-center text-slate-700 mb-4 group-hover:text-blue-500 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                    </div>
                    <p class="text-xs font-black text-slate-600 uppercase tracking-widest italic">Buat Kategori Baru</p>
                </div>
            </div>

            <!-- Footer Page -->
            <div class="p-8 bg-slate-950/30 border-t border-slate-800">
                <div class="flex items-center justify-between">
                    <p class="text-[10px] font-bold text-slate-600 uppercase tracking-widest italic">Menampilkan 2 dari 20
                        Kategori</p>
                    <div class="flex gap-2">
                        <button
                            class="px-4 py-2 bg-slate-800 text-slate-400 text-[10px] font-black uppercase rounded-lg">Prev</button>
                        <button
                            class="px-4 py-2 bg-slate-800 text-white text-[10px] font-black uppercase rounded-lg">Next</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
