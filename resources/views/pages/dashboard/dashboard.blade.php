@extends('layout')

@section('page_title', 'Ringkasan Statistik')

@section('content')
<div class="space-y-8" wire:poll.30s>
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
                <span class="text-[10px] font-black text-emerald-500 bg-emerald-500/10 px-2 py-1 rounded-lg">+{{ rand(2,8) }}%</span>
            </div>
            <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1 italic">Barang IT Aktif</p>
            <h3 class="text-4xl font-black text-white italic tracking-tighter">
                {{ number_format($totalIt) }} 
                <span class="text-sm font-normal text-slate-600 not-italic uppercase ml-1 tracking-normal">Unit</span>
            </h3>
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
            <h3 class="text-4xl font-black text-white italic tracking-tighter">
                {{ number_format($totalPublikasi) }} 
                <span class="text-sm font-normal text-slate-600 not-italic uppercase ml-1 tracking-normal">Pcs</span>
            </h3>
        </div>

        <!-- Card 3: Sedang Dipinjam -->
        <div class="group p-6 bg-slate-900 border border-slate-800 rounded-[2.5rem] hover:border-amber-600/50 transition-all duration-500 shadow-xl">
            <div class="flex justify-between items-start mb-4">
                <div class="p-3 bg-amber-600/10 rounded-2xl text-amber-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                </div>
                <span class="text-[10px] font-black text-amber-500 bg-amber-500/10 px-2 py-1 rounded-lg">{{ $activeLoans }} Aktif</span>
            </div>
            <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1 italic">Peminjaman</p>
            <h3 class="text-4xl font-black text-white italic tracking-tighter">
                {{ sprintf('%02d', $activeLoans) }} 
                <span class="text-sm font-normal text-slate-600 not-italic uppercase ml-1 tracking-normal">Items</span>
            </h3>
        </div>

        <!-- Card 4: Kondisi Rusak -->
        <div class="group p-6 bg-slate-900 border border-slate-800 rounded-[2.5rem] hover:border-red-600/50 transition-all duration-500 shadow-xl">
            <div class="flex justify-between items-start mb-4">
                <div class="p-3 bg-red-600/10 rounded-2xl text-red-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                </div>
                <span class="text-[10px] font-black text-red-500 bg-red-500/10 px-2 py-1 rounded-lg">Peringatan</span>
            </div>
            <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1 italic">Barang Rusak</p>
            <h3 class="text-4xl font-black text-white italic tracking-tighter">
                {{ sprintf('%02d', $brokenItems) }} 
                <span class="text-sm font-normal text-slate-600 not-italic uppercase ml-1 tracking-normal">Unit</span>
            </h3>
        </div>
    </div>

    <!-- Row 2: Charts & Performance -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 p-8 bg-slate-900 border border-slate-800 rounded-[3rem] shadow-2xl relative overflow-hidden">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h3 class="text-lg font-black text-white italic uppercase tracking-tighter">Alur Keluar Masuk Barang</h3>
                    <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Aktivitas 7 Hari Terakhir</p>
                </div>
            </div>
            
            <div class="h-64 flex items-end justify-between gap-3 px-2">
                @foreach($chartBars as $count)
                    <div class="w-full group relative flex flex-col items-center">
                        <div class="w-full bg-blue-600/20 rounded-t-xl transition-all duration-500 group-hover:bg-blue-600/40" 
                             style="height: {{ max($count * 10, 5) }}%"></div>
                        <div class="w-full bg-blue-600 rounded-t-xl absolute bottom-0 transition-all duration-700 group-hover:h-3/4 shadow-[0_0_15px_rgba(37,99,235,0.4)]" 
                             style="height: {{ max($count * 5, 2) }}%"></div>
                        
                        <span class="absolute -top-8 opacity-0 group-hover:opacity-100 transition-opacity text-[10px] font-black text-white bg-slate-800 px-2 py-1 rounded shadow-lg">
                            {{ $count }}
                        </span>
                    </div>
                @endforeach
            </div>
            <div class="flex justify-between mt-6 text-[10px] font-black text-slate-600 uppercase tracking-widest italic px-4">
                <span>H-6</span><span>H-5</span><span>H-4</span><span>H-3</span><span>H-2</span><span>H-1</span><span>Hari Ini</span>
            </div>
        </div>

        
    </div>

    <!-- Row 3: Recent Activity Table -->
    <div class="bg-slate-900 border border-slate-800 rounded-[3rem] overflow-hidden shadow-2xl">
        <div class="p-8 border-b border-slate-800 flex flex-col sm:flex-row justify-between items-center gap-4">
            <div>
                <h3 class="text-xl font-black text-white italic uppercase tracking-tighter">Aktivitas Terkini</h3>
                <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Log harian pergerakan barang</p>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-slate-950/50 text-[10px] font-black text-slate-500 uppercase tracking-[0.2em] italic">
                    <tr>
                        <th class="px-8 py-5">Barang / Item</th>
                        <th class="px-8 py-5">Tipe Aktivitas</th>
                        <th class="px-8 py-5">User</th>
                        <th class="px-8 py-5 text-center">Waktu</th>
                        <th class="px-8 py-5 text-right">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800/50">
                    @forelse($recentActivities as $activity)
                    <tr class="group hover:bg-blue-600/[0.02] transition-colors">
                        <td class="px-8 py-6">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-xl {{ $activity->type == 'in' ? 'bg-emerald-500/10 text-emerald-500' : 'bg-blue-500/10 text-blue-500' }} flex items-center justify-center font-black italic text-[10px]">
                                    {{ strtoupper($activity->type) }}
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-white tracking-tight">{{ $activity->item->name }}</p>
                                    <p class="text-[10px] text-slate-500 uppercase font-medium">{{ $activity->item->category->name ?? 'Tanpa Kategori' }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-8 py-6">
                            <span class="text-xs font-bold text-slate-300 italic tracking-tighter">
                                {{ $activity->description }} ({{ $activity->quantity > 0 ? '+' : '' }}{{ $activity->quantity }})
                            </span>
                        </td>
                        <td class="px-8 py-6 italic font-bold text-xs text-slate-500">
                            {{ $activity->user->name ?? 'Sistem' }}
                        </td>
                        <td class="px-8 py-6 text-xs text-slate-500 font-mono tracking-tighter uppercase text-center">
                            {{ $activity->created_at->diffForHumans() }}
                        </td>
                        <td class="px-8 py-6 text-right">
                            <span class="px-3 py-1 bg-emerald-500/10 text-emerald-500 text-[10px] font-black rounded-full uppercase italic tracking-tighter border border-emerald-500/20">
                                Berhasil
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-8 py-12 text-center text-slate-600 italic font-black uppercase text-xs tracking-widest">
                            Belum ada aktivitas terekam
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection