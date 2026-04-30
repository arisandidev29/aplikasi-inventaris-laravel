@extends('layout')

@section('page_title', 'Kelola Pengguna')

@section('content')
<div>
    {{-- ── FLASH SUCCESS ───────────────────────────────── --}}
    <div
        x-data="{ show: false, message: '' }"
        x-show="show"
        x-cloak
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-2"
        @notify-success.window="message = $event.detail.message; show = true; setTimeout(() => show = false, 4000)"
        class="fixed top-6 right-6 z-[99] flex items-center gap-3 rounded-2xl border border-emerald-500/30 bg-emerald-500/10 px-5 py-4 text-sm text-emerald-400 shadow-xl backdrop-blur">
        <svg class="h-5 w-5 shrink-0" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
        </svg>
        <span x-text="message"></span>
    </div>

    {{-- ── PAGE HEADER ──────────────────────────────────── --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-black tracking-tighter text-white uppercase italic">Kelola Pengguna</h1>
            <p class="mt-1 text-sm text-slate-500">Manajemen akun pengguna sistem inventaris</p>
        </div>
        <button wire:click="bukaTambah"
            class="inline-flex items-center gap-2 rounded-2xl bg-blue-600 px-5 py-3 text-sm font-black text-white uppercase tracking-wider shadow-lg shadow-blue-600/20 transition hover:bg-blue-500 active:scale-95">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Pengguna
        </button>
    </div>

    {{-- ── STATS CARDS ──────────────────────────────────── --}}
    <div class="grid grid-cols-2 gap-4 lg:grid-cols-4 mt-6">
        @php
            $total      = \App\Models\User::count();
            $superadmin = \App\Models\User::where('role','superadmin')->count();
            $admin      = \App\Models\User::where('role','admin')->count();
        @endphp
        <div class="rounded-2xl border border-slate-800 bg-[#111827] p-5">
            <p class="text-xs font-black uppercase tracking-widest text-slate-500">Total Pengguna</p>
            <p class="mt-2 text-3xl font-black text-white italic">{{ $total }}</p>
        </div>
        <div class="rounded-2xl border border-slate-800 bg-[#111827] p-5">
            <p class="text-xs font-black uppercase tracking-widest text-slate-500">Super Admin</p>
            <p class="mt-2 text-3xl font-black text-blue-400 italic">{{ $superadmin }}</p>
        </div>
        <div class="rounded-2xl border border-slate-800 bg-[#111827] p-5">
            <p class="text-xs font-black uppercase tracking-widest text-slate-500">Admin</p>
            <p class="mt-2 text-3xl font-black text-slate-300 italic">{{ $admin }}</p>
        </div>
        <div class="rounded-2xl border border-blue-600/20 bg-blue-600/5 p-5">
            <p class="text-xs font-black uppercase tracking-widest text-blue-500/70">Login Sebagai</p>
            <p class="mt-2 text-sm font-black text-blue-400 italic truncate">{{ auth()->user()->name }}</p>
            <span class="mt-1 inline-block rounded-lg bg-blue-600/20 px-2 py-0.5 text-[10px] font-black uppercase tracking-widest text-blue-400">
                {{ auth()->user()->role }}
            </span>
        </div>
    </div>

    {{-- ── SEARCH & FILTER ─────────────────────────────── --}}
    <div class="mt-6 flex flex-col gap-3 sm:flex-row sm:items-center">
        <div class="relative flex-1">
            <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-500">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0"/>
                </svg>
            </span>
            <input wire:model.live.debounce.300ms="search" type="text"
                placeholder="Cari nama atau email pengguna..."
                class="w-full rounded-2xl border border-slate-700 bg-slate-900/50 py-3 pl-11 pr-4 text-sm text-white placeholder-slate-500 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
        </div>
        <select wire:model.live="filterRole"
            class="rounded-2xl border border-slate-700 bg-slate-900/50 px-4 py-3 text-sm text-slate-300 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
            <option value="">Semua Role</option>
            <option value="superadmin">Super Admin</option>
            <option value="admin">Admin</option>
        </select>
    </div>

    {{-- ── TABLE ────────────────────────────────────────── --}}
    <div class="mt-4 overflow-hidden rounded-2xl border border-slate-800 bg-[#111827]">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-slate-800 bg-slate-900/50">
                        <th class="px-6 py-4 text-left text-[10px] font-black uppercase tracking-widest text-slate-500">#</th>
                        <th class="px-6 py-4 text-left text-[10px] font-black uppercase tracking-widest text-slate-500">Pengguna</th>
                        <th class="px-6 py-4 text-left text-[10px] font-black uppercase tracking-widest text-slate-500">Email</th>
                        <th class="px-6 py-4 text-left text-[10px] font-black uppercase tracking-widest text-slate-500">Role</th>
                        <th class="px-6 py-4 text-left text-[10px] font-black uppercase tracking-widest text-slate-500">Bergabung</th>
                        <th class="px-6 py-4 text-right text-[10px] font-black uppercase tracking-widest text-slate-500">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800/50">
                    @forelse ($users as $user)
                        <tr class="transition hover:bg-slate-800/30 {{ $user->id === auth()->id() ? 'bg-blue-600/5' : '' }}">
                            <td class="px-6 py-4 text-slate-600 font-mono text-xs">{{ $users->firstItem() + $loop->index }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="flex h-9 w-9 flex-shrink-0 items-center justify-center rounded-xl
                                        {{ $user->role === 'superadmin' ? 'bg-blue-600/20 text-blue-400 border border-blue-600/30' : 'bg-slate-800 text-slate-400' }}
                                        text-sm font-black italic">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <p class="font-bold text-white">{{ $user->name }}</p>
                                        @if ($user->id === auth()->id())
                                            <span class="text-[10px] text-blue-400 font-bold">(Anda)</span>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-slate-400">{{ $user->email }}</td>
                            <td class="px-6 py-4">
                                @if ($user->role === 'superadmin')
                                    <span class="inline-flex items-center gap-1 rounded-lg bg-blue-600/15 px-2.5 py-1 text-[10px] font-black uppercase tracking-wider text-blue-400 border border-blue-600/20">
                                        <svg class="h-3 w-3" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M9.383 3.076A1 1 0 0110 4v12a1 1 0 01-1.707.707L4.586 13H2a1 1 0 01-1-1V8a1 1 0 011-1h2.586l3.707-3.707a1 1 0 011.09-.217zM14.657 2.929a1 1 0 011.414 0A9.972 9.972 0 0119 10a9.972 9.972 0 01-2.929 7.071 1 1 0 01-1.414-1.414A7.971 7.971 0 0017 10c0-2.21-.894-4.208-2.343-5.657a1 1 0 010-1.414zm-2.829 2.828a1 1 0 011.415 0A5.983 5.983 0 0115 10a5.984 5.984 0 01-1.757 4.243 1 1 0 01-1.415-1.415A3.984 3.984 0 0013 10a3.983 3.983 0 00-1.172-2.828 1 1 0 010-1.415z" clip-rule="evenodd"/></svg>
                                        Super Admin
                                    </span>
                                @else
                                    <span class="inline-flex rounded-lg bg-slate-800 px-2.5 py-1 text-[10px] font-black uppercase tracking-wider text-slate-400">
                                        Admin
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-slate-500 text-xs">{{ $user->created_at->format('d M Y') }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end gap-2">
                                    {{-- Reset Password --}}
                                    <button wire:click="bukaReset({{ $user->id }})"
                                        title="Kirim Reset Password"
                                        class="rounded-xl p-2 text-slate-500 transition hover:bg-amber-500/10 hover:text-amber-400">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                                        </svg>
                                    </button>
                                    {{-- Edit --}}
                                    <button wire:click="bukaEdit({{ $user->id }})"
                                        title="Edit Pengguna"
                                        class="rounded-xl p-2 text-slate-500 transition hover:bg-blue-500/10 hover:text-blue-400">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </button>
                                    {{-- Hapus --}}
                                    @if ($user->id !== auth()->id())
                                        <button wire:click="bukaHapus({{ $user->id }})"
                                            title="Hapus Pengguna"
                                            class="rounded-xl p-2 text-slate-500 transition hover:bg-red-500/10 hover:text-red-400">
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-16 text-center">
                                <div class="flex flex-col items-center gap-3">
                                    <svg class="h-12 w-12 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    <p class="text-sm font-bold text-slate-600">Tidak ada pengguna ditemukan</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if ($users->hasPages())
            <div class="border-t border-slate-800 px-6 py-4">
                {{ $users->links() }}
            </div>
        @endif
    </div>


    {{-- ══════════════════════════════════════════════════
         MODAL TAMBAH
    ══════════════════════════════════════════════════ --}}
    <div x-show="$wire.modalTambah" x-cloak
         x-transition:enter="ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
         x-transition:leave="ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm">
        <div @click.outside="$wire.tutupModal()"
             x-transition:enter="ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
             class="w-full max-w-md rounded-3xl border border-slate-800 bg-[#111827] shadow-2xl">

            <div class="flex items-center justify-between border-b border-slate-800 px-6 py-5">
                <h3 class="font-black text-white uppercase tracking-tighter italic">Tambah Pengguna Baru</h3>
                <button wire:click="tutupModal" class="rounded-xl p-1.5 text-slate-500 hover:bg-slate-800 hover:text-white transition">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <div class="p-6 space-y-5">
                <div>
                    <label class="mb-1.5 block text-xs font-black uppercase tracking-widest text-slate-400">Nama Lengkap</label>
                    <input wire:model="name" type="text" placeholder="Masukkan nama lengkap"
                        class="w-full rounded-xl border border-slate-700 bg-slate-900/50 px-4 py-3 text-sm text-white placeholder-slate-500 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
                    @error('name') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="mb-1.5 block text-xs font-black uppercase tracking-widest text-slate-400">Alamat Email</label>
                    <input wire:model="email" type="email" placeholder="nama@perusahaan.com"
                        class="w-full rounded-xl border border-slate-700 bg-slate-900/50 px-4 py-3 text-sm text-white placeholder-slate-500 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
                    @error('email') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="mb-1.5 block text-xs font-black uppercase tracking-widest text-slate-400">Password</label>
                    <input wire:model="password" type="password" placeholder="Min. 8 karakter"
                        class="w-full rounded-xl border border-slate-700 bg-slate-900/50 px-4 py-3 text-sm text-white placeholder-slate-500 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
                    @error('password') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="mb-1.5 block text-xs font-black uppercase tracking-widest text-slate-400">Role</label>
                    <select wire:model.live="role"
                        class="w-full rounded-xl border border-slate-700 bg-slate-900/50 px-4 py-3 text-sm text-white focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
                        <option value="admin" @selected($role === 'admin')>Admin</option>
                        <option value="superadmin" @selected($role === 'superadmin')>Super Admin</option>
                    </select>
                    @error('role') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="flex gap-3 border-t border-slate-800 px-6 py-4">
                <button wire:click="tutupModal"
                    class="flex-1 rounded-xl border border-slate-700 bg-transparent px-4 py-3 text-sm font-black uppercase tracking-wider text-slate-400 transition hover:bg-slate-800">
                    Batal
                </button>
                <button wire:click="simpanTambah" wire:loading.attr="disabled"
                    class="flex-1 rounded-xl bg-blue-600 px-4 py-3 text-sm font-black uppercase tracking-wider text-white shadow-lg shadow-blue-600/20 transition hover:bg-blue-500 disabled:opacity-60">
                    <span wire:loading.remove wire:target="simpanTambah">Simpan</span>
                    <span wire:loading wire:target="simpanTambah">Menyimpan...</span>
                </button>
            </div>
        </div>
    </div>

    {{-- ══════════════════════════════════════════════════
         MODAL EDIT
    ══════════════════════════════════════════════════ --}}
    <div x-show="$wire.modalEdit" x-cloak
         x-transition:enter="ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
         x-transition:leave="ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm">
        <div @click.outside="$wire.tutupModal()"
             x-transition:enter="ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
             class="w-full max-w-md rounded-3xl border border-slate-800 bg-[#111827] shadow-2xl">

            <div class="flex items-center justify-between border-b border-slate-800 px-6 py-5">
                <h3 class="font-black text-white uppercase tracking-tighter italic">Edit Data Pengguna</h3>
                <button wire:click="tutupModal" class="rounded-xl p-1.5 text-slate-500 hover:bg-slate-800 hover:text-white transition">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <div class="p-6 space-y-5">
                <div>
                    <label class="mb-1.5 block text-xs font-black uppercase tracking-widest text-slate-400">Nama Lengkap</label>
                    <input wire:model="name" type="text" placeholder="Masukkan nama lengkap"
                        class="w-full rounded-xl border border-slate-700 bg-slate-900/50 px-4 py-3 text-sm text-white placeholder-slate-500 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
                    @error('name') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="mb-1.5 block text-xs font-black uppercase tracking-widest text-slate-400">Alamat Email</label>
                    <input wire:model="email" type="email" placeholder="nama@perusahaan.com"
                        class="w-full rounded-xl border border-slate-700 bg-slate-900/50 px-4 py-3 text-sm text-white placeholder-slate-500 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
                    @error('email') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="mb-1.5 block text-xs font-black uppercase tracking-widest text-slate-400">
                        Password
                        <span class="ml-1 font-medium normal-case tracking-normal text-slate-600">(kosongkan jika tidak diubah)</span>
                    </label>
                    <input wire:model="password" type="password" placeholder="Min. 8 karakter"
                        class="w-full rounded-xl border border-slate-700 bg-slate-900/50 px-4 py-3 text-sm text-white placeholder-slate-500 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
                    @error('password') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="mb-1.5 block text-xs font-black uppercase tracking-widest text-slate-400">Role</label>
                    <select wire:model.live="role"
                        class="w-full rounded-xl border border-slate-700 bg-slate-900/50 px-4 py-3 text-sm text-white focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
                        <option value="admin" @selected($role === 'admin')>Admin</option>
                        <option value="superadmin" @selected($role === 'superadmin')>Super Admin</option>
                    </select>
                    @error('role') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="flex gap-3 border-t border-slate-800 px-6 py-4">
                <button wire:click="tutupModal"
                    class="flex-1 rounded-xl border border-slate-700 bg-transparent px-4 py-3 text-sm font-black uppercase tracking-wider text-slate-400 transition hover:bg-slate-800">
                    Batal
                </button>
                <button wire:click="simpanEdit" wire:loading.attr="disabled"
                    class="flex-1 rounded-xl bg-blue-600 px-4 py-3 text-sm font-black uppercase tracking-wider text-white shadow-lg shadow-blue-600/20 transition hover:bg-blue-500 disabled:opacity-60">
                    <span wire:loading.remove wire:target="simpanEdit">Perbarui</span>
                    <span wire:loading wire:target="simpanEdit">Menyimpan...</span>
                </button>
            </div>
        </div>
    </div>


    {{-- ══════════════════════════════════════════════════
         MODAL HAPUS
    ══════════════════════════════════════════════════ --}}
    <div x-show="$wire.modalHapus" x-cloak
         x-transition:enter="ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm">
        <div @click.outside="$wire.tutupModal()"
             x-transition:enter="ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
             class="w-full max-w-sm rounded-3xl border border-slate-800 bg-[#111827] shadow-2xl">
            <div class="p-6 text-center">
                <div class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-2xl bg-red-500/10 border border-red-500/20">
                    <svg class="h-7 w-7 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                </div>
                <h3 class="text-lg font-black text-white uppercase italic tracking-tight">Hapus Pengguna?</h3>
                <p class="mt-2 text-sm text-slate-400">
                    Akun <span class="font-bold text-white">{{ $userName }}</span> akan dihapus permanen dan tidak dapat dikembalikan.
                </p>
            </div>
            <div class="flex gap-3 border-t border-slate-800 px-6 py-4">
                <button wire:click="tutupModal"
                    class="flex-1 rounded-xl border border-slate-700 px-4 py-3 text-sm font-black uppercase tracking-wider text-slate-400 transition hover:bg-slate-800">
                    Batal
                </button>
                <button wire:click="hapus" wire:loading.attr="disabled"
                    class="flex-1 rounded-xl bg-red-600 px-4 py-3 text-sm font-black uppercase tracking-wider text-white transition hover:bg-red-500 disabled:opacity-60">
                    <span wire:loading.remove wire:target="hapus">Ya, Hapus</span>
                    <span wire:loading wire:target="hapus">Menghapus...</span>
                </button>
            </div>
        </div>
    </div>


    {{-- ══════════════════════════════════════════════════
         MODAL RESET PASSWORD
    ══════════════════════════════════════════════════ --}}
    <div x-show="$wire.modalReset" x-cloak
         x-transition:enter="ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm">
        <div @click.outside="$wire.tutupModal()"
             x-transition:enter="ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
             class="w-full max-w-sm rounded-3xl border border-slate-800 bg-[#111827] shadow-2xl">
            <div class="p-6 text-center">
                <div class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-2xl bg-amber-500/10 border border-amber-500/20">
                    <svg class="h-7 w-7 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-black text-white uppercase italic tracking-tight">Kirim Reset Password?</h3>
                <p class="mt-2 text-sm text-slate-400">
                    Link reset password akan dikirim ke email milik <span class="font-bold text-white">{{ $userName }}</span>.
                </p>
            </div>
            <div class="flex gap-3 border-t border-slate-800 px-6 py-4">
                <button wire:click="tutupModal"
                    class="flex-1 rounded-xl border border-slate-700 px-4 py-3 text-sm font-black uppercase tracking-wider text-slate-400 transition hover:bg-slate-800">
                    Batal
                </button>
                <button wire:click="kirimReset" wire:loading.attr="disabled"
                    class="flex-1 rounded-xl bg-amber-500 px-4 py-3 text-sm font-black uppercase tracking-wider text-white transition hover:bg-amber-400 disabled:opacity-60">
                    <span wire:loading.remove wire:target="kirimReset">Kirim Link</span>
                    <span wire:loading wire:target="kirimReset">Mengirim...</span>
                </button>
            </div>
        </div>
    </div>

</div>
@endsection