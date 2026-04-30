@extends('layout')

@section('page_title', 'Dashboard')

@section('content')
    <div class="space-y-8" wire:poll.30s="loadData">

        <!-- Header Welcome -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-3xl font-black text-white italic tracking-tighter uppercase">Statistik Gudang</h1>
                <p class="text-slate-500 text-sm font-medium">Pantau pergerakan stok IT dan Publikasi secara real-time.</p>
            </div>
            <div class="flex items-center gap-3">
                <span
                    class="flex items-center gap-2 px-4 py-2 bg-slate-900 border border-slate-800 rounded-xl text-[10px] font-black text-slate-400 uppercase tracking-widest italic">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    Sistem Online
                </span>
            </div>
        </div>

        <!-- Row 1: Quick Stats Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Card 1: Total IT -->
            <div
                class="group p-6 bg-slate-900 border border-slate-800 rounded-[2.5rem] hover:border-blue-600/50 transition-all duration-500 shadow-xl">
                <div class="flex justify-between items-start mb-4">
                    <div class="p-3 bg-blue-600/10 rounded-2xl text-blue-500">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                </div>
                <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1 italic">Barang IT Aktif</p>
                <h3 class="text-4xl font-black text-white italic tracking-tighter">
                    {{ number_format($totalIt) }}
                    <span class="text-sm font-normal text-slate-600 not-italic uppercase ml-1 tracking-normal">Unit</span>
                </h3>
            </div>

            <!-- Card 2: Stok Publikasi -->
            <div
                class="group p-6 bg-slate-900 border border-slate-800 rounded-[2.5rem] hover:border-purple-600/50 transition-all duration-500 shadow-xl">
                <div class="flex justify-between items-start mb-4">
                    <div class="p-3 bg-purple-600/10 rounded-2xl text-purple-500">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
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
            <div
                class="group p-6 bg-slate-900 border border-slate-800 rounded-[2.5rem] hover:border-amber-600/50 transition-all duration-500 shadow-xl">
                <div class="flex justify-between items-start mb-4">
                    <div class="p-3 bg-amber-600/10 rounded-2xl text-amber-500">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <span
                        class="text-[10px] font-black text-amber-500 bg-amber-500/10 px-2 py-1 rounded-lg">{{ $activeLoans }}
                        Aktif</span>
                </div>
                <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1 italic">Peminjaman</p>
                <h3 class="text-4xl font-black text-white italic tracking-tighter">
                    {{ sprintf('%02d', $activeLoans) }}
                    <span class="text-sm font-normal text-slate-600 not-italic uppercase ml-1 tracking-normal">Items</span>
                </h3>
            </div>

            <!-- Card 4: Kondisi Rusak -->
            <div
                class="group p-6 bg-slate-900 border border-slate-800 rounded-[2.5rem] hover:border-red-600/50 transition-all duration-500 shadow-xl">
                <div class="flex justify-between items-start mb-4">
                    <div class="p-3 bg-red-600/10 rounded-2xl text-red-500">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
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

        <!-- Row 2: Chart Alur Keluar Masuk -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div
                class="lg:col-span-2 p-8 bg-slate-900 border border-slate-800 rounded-[3rem] shadow-2xl relative overflow-hidden">

                {{-- Header chart --}}
                <div class="flex items-start justify-between mb-8 gap-4 flex-wrap">
                    <div>
                        <h3 class="text-lg font-black text-white italic uppercase tracking-tighter">Alur Keluar Masuk Barang
                        </h3>
                        <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Jumlah unit · 7 Hari
                            Terakhir</p>
                    </div>
                    {{-- Legend --}}
                    <div class="flex items-center gap-5 shrink-0">
                        <div class="flex items-center gap-2">
                            <span class="w-3 h-3 rounded-sm bg-emerald-500 shadow-[0_0_8px_rgba(16,185,129,0.5)]"></span>
                            <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Masuk</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="w-3 h-3 rounded-sm bg-red-500 shadow-[0_0_8px_rgba(239,68,68,0.5)]"></span>
                            <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Keluar</span>
                        </div>
                    </div>
                </div>

                {{-- Bar Chart --}}
                @php
                    $days = ['H-6', 'H-5', 'H-4', 'H-3', 'H-2', 'H-1', 'Hari Ini'];
                @endphp

                <div class="h-56 flex items-end gap-2 sm:gap-3 px-1">
                    @foreach ($chartMasuk as $i => $masuk)
                        @php
                            $keluar = $chartKeluar[$i] ?? 0;
                            // Skala proporsional terhadap nilai tertinggi, max tinggi 100%
                            $pctMasuk = $chartMax > 0 ? round(($masuk / $chartMax) * 100) : 0;
                            $pctKeluar = $chartMax > 0 ? round(($keluar / $chartMax) * 100) : 0;
                            // Bar minimal 4px agar tetap terlihat saat ada data
                            $minPx = $masuk > 0 || $keluar > 0 ? 4 : 0;
                        @endphp
                        <div class="flex-1 flex flex-col h-full">
                            {{-- Spacer atas --}}
                            <div class="flex-1"></div>

                            {{-- Pasangan bar --}}
                            <div class="flex items-end gap-0.5 sm:gap-1">

                                {{-- Bar Masuk (hijau) --}}
                                <div class="relative flex-1 group/bar flex flex-col justify-end"
                                    style="height: {{ max($pctMasuk, $masuk > 0 ? 2 : 0) }}%">
                                    {{-- Tooltip --}}
                                    <div
                                        class="absolute -top-8 left-1/2 -translate-x-1/2 opacity-0 group-hover/bar:opacity-100 transition-opacity z-10 whitespace-nowrap">
                                        <span
                                            class="bg-slate-800 text-emerald-400 text-[10px] font-black px-2 py-1 rounded shadow-lg border border-emerald-500/20">
                                            +{{ $masuk }} unit
                                        </span>
                                    </div>
                                    <div class="w-full rounded-t-lg transition-all duration-500
                                            bg-emerald-500 group-hover/bar:bg-emerald-400
                                            shadow-[0_0_10px_rgba(16,185,129,0.3)]"
                                        style="min-height: {{ $masuk > 0 ? '4px' : '0' }}; height: 100%">
                                    </div>
                                </div>

                                {{-- Bar Keluar (merah) --}}
                                <div class="relative flex-1 group/bar2 flex flex-col justify-end"
                                    style="height: {{ max($pctKeluar, $keluar > 0 ? 2 : 0) }}%">
                                    {{-- Tooltip --}}
                                    <div
                                        class="absolute -top-8 left-1/2 -translate-x-1/2 opacity-0 group-hover/bar2:opacity-100 transition-opacity z-10 whitespace-nowrap">
                                        <span
                                            class="bg-slate-800 text-red-400 text-[10px] font-black px-2 py-1 rounded shadow-lg border border-red-500/20">
                                            -{{ $keluar }} unit
                                        </span>
                                    </div>
                                    <div class="w-full rounded-t-lg transition-all duration-500
                                            bg-red-500 group-hover/bar2:bg-red-400
                                            shadow-[0_0_10px_rgba(239,68,68,0.25)]"
                                        style="min-height: {{ $keluar > 0 ? '4px' : '0' }}; height: 100%">
                                    </div>
                                </div>

                            </div>

                            {{-- Label hari --}}
                            <p
                                class="text-center text-[9px] font-black text-slate-600 uppercase tracking-widest italic mt-2">
                                {{ $days[$i] }}
                            </p>
                        </div>
                    @endforeach
                </div>

                {{-- Ringkasan total --}}
                @php
                    $totalMasukWeek = array_sum($chartMasuk);
                    $totalKeluarWeek = array_sum($chartKeluar);
                @endphp
                <div class="mt-6 pt-5 border-t border-slate-800 flex justify-between items-center">
                    <div class="text-center">
                        <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1">Total Masuk</p>
                        <p class="text-xl font-black text-emerald-400 italic">+{{ number_format($totalMasukWeek) }} <span
                                class="text-xs text-slate-500 not-italic font-medium">unit</span></p>
                    </div>
                    <div class="w-px h-8 bg-slate-800"></div>
                    <div class="text-center">
                        <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1">Total Keluar</p>
                        <p class="text-xl font-black text-red-400 italic">-{{ number_format($totalKeluarWeek) }} <span
                                class="text-xs text-slate-500 not-italic font-medium">unit</span></p>
                    </div>
                    <div class="w-px h-8 bg-slate-800"></div>
                    <div class="text-center">
                        <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1">Nett Pergerakan</p>
                        @php $nett = $totalMasukWeek - $totalKeluarWeek; @endphp
                        <p class="text-xl font-black italic {{ $nett >= 0 ? 'text-blue-400' : 'text-amber-400' }}">
                            {{ $nett >= 0 ? '+' : '' }}{{ number_format($nett) }}
                            <span class="text-xs text-slate-500 not-italic font-medium">unit</span>
                        </p>
                    </div>
                </div>
            </div>

            {{-- Card Ringkasan Kondisi (kolom kanan) --}}
            <div class="p-8 bg-slate-900 border border-slate-800 rounded-[3rem] shadow-2xl flex flex-col gap-6">
                <div>
                    <h3 class="text-lg font-black text-white italic uppercase tracking-tighter">Kondisi Barang</h3>
                    <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Rekap status seluruh item</p>
                </div>
                @php
                    $bagus = \App\Models\items::where('kondisi', 'Bagus')->count();
                    $rusak = \App\Models\items::where('kondisi', 'Rusak')->count();
                    $diperbaiki = \App\Models\items::where('kondisi', 'Diperbaiki')->count();
                    $totalKondisi = max($bagus + $rusak + $diperbaiki, 1);
                @endphp
                <div class="space-y-4 flex-1">
                    {{-- Bagus --}}
                    <div>
                        <div class="flex justify-between mb-1.5">
                            <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Bagus</span>
                            <span class="text-[10px] font-black text-emerald-400">{{ $bagus }} unit</span>
                        </div>
                        <div class="h-2 bg-slate-800 rounded-full overflow-hidden">
                            <div class="h-full bg-emerald-500 rounded-full transition-all duration-700"
                                style="width: {{ round(($bagus / $totalKondisi) * 100) }}%"></div>
                        </div>
                    </div>
                    {{-- Diperbaiki --}}
                    <div>
                        <div class="flex justify-between mb-1.5">
                            <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Diperbaiki</span>
                            <span class="text-[10px] font-black text-amber-400">{{ $diperbaiki }} unit</span>
                        </div>
                        <div class="h-2 bg-slate-800 rounded-full overflow-hidden">
                            <div class="h-full bg-amber-500 rounded-full transition-all duration-700"
                                style="width: {{ round(($diperbaiki / $totalKondisi) * 100) }}%"></div>
                        </div>
                    </div>
                    {{-- Rusak --}}
                    <div>
                        <div class="flex justify-between mb-1.5">
                            <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Rusak</span>
                            <span class="text-[10px] font-black text-red-400">{{ $rusak }} unit</span>
                        </div>
                        <div class="h-2 bg-slate-800 rounded-full overflow-hidden">
                            <div class="h-full bg-red-500 rounded-full transition-all duration-700"
                                style="width: {{ round(($rusak / $totalKondisi) * 100) }}%"></div>
                        </div>
                    </div>
                </div>
                {{-- Total --}}
                <div class="pt-5 border-t border-slate-800 text-center">
                    <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1">Total Semua Item</p>
                    <p class="text-3xl font-black text-white italic">{{ $bagus + $rusak + $diperbaiki }}
                        <span class="text-sm font-normal text-slate-600 not-italic tracking-normal">unit</span>
                    </p>
                </div>
            </div>
        </div>

        <!-- Row 3: Recent Activity Table -->
        <div class="bg-slate-900 border border-slate-800 rounded-[3rem] overflow-hidden shadow-2xl">
            <div class="p-8 border-b border-slate-800 flex flex-col sm:flex-row justify-between items-center gap-4">
                <div>
                    <h3 class="text-xl font-black text-white italic uppercase tracking-tighter">Aktivitas Terkini</h3>
                    <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Log harian pergerakan barang
                    </p>
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
                            @php
                                $isMasuk = $activity->type === 'masuk';
                            @endphp
                            <tr class="group hover:bg-blue-600/[0.02] transition-colors">
                                <td class="px-8 py-6">
                                    <div class="flex items-center gap-4">
                                        {{-- FIX: badge masuk hijau / keluar merah --}}
                                        <div
                                            class="w-10 h-10 rounded-xl flex items-center justify-center font-black italic text-[10px]
                                    {{ $isMasuk
                                        ? 'bg-emerald-500/10 text-emerald-400 border border-emerald-500/20'
                                        : 'bg-red-500/10 text-red-400 border border-red-500/20' }}">
                                            {{ $isMasuk ? '▲' : '▼' }}
                                        </div>
                                        <div>
                                            {{-- FIX: kolom yang benar adalah nama_barang --}}
                                            <p class="text-sm font-bold text-white tracking-tight">
                                                {{ $activity->item->nama_barang ?? '-' }}
                                            </p>
                                            <p class="text-[10px] text-slate-500 uppercase font-medium">
                                                {{ $activity->item->category->name ?? 'Tanpa Kategori' }}
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-6">
                                    <div class="flex flex-col gap-0.5">
                                        <span
                                            class="text-xs font-black uppercase tracking-widest {{ $isMasuk ? 'text-emerald-400' : 'text-red-400' }}">
                                            {{ $isMasuk ? 'Barang Masuk' : 'Barang Keluar' }}
                                        </span>
                                        {{-- FIX: kolom keterangan, bukan description --}}
                                        <span class="text-[10px] text-slate-500 font-medium italic">
                                            {{ $activity->keterangan ?? '-' }}
                                            · <span
                                                class="font-black {{ $isMasuk ? 'text-emerald-400' : 'text-red-400' }}">
                                                {{ $isMasuk ? '+' : '-' }}{{ $activity->quantity }} unit
                                            </span>
                                        </span>
                                    </div>
                                </td>
                                <td class="px-8 py-6 italic font-bold text-xs text-slate-500">
                                    {{ $activity->user->name ?? 'Sistem' }}
                                </td>
                                <td
                                    class="px-8 py-6 text-xs text-slate-500 font-mono tracking-tighter uppercase text-center">
                                    {{ $activity->created_at->diffForHumans() }}
                                </td>
                                <td class="px-8 py-6 text-right">
                                    <span
                                        class="px-3 py-1 text-[10px] font-black rounded-full uppercase italic tracking-tighter border
                                {{ $isMasuk
                                    ? 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20'
                                    : 'bg-red-500/10 text-red-400 border-red-500/20' }}">
                                        {{ $isMasuk ? 'Masuk' : 'Keluar' }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5"
                                    class="px-8 py-12 text-center text-slate-600 italic font-black uppercase text-xs tracking-widest">
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
