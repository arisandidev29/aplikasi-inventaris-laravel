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
    </div>
@endsection
