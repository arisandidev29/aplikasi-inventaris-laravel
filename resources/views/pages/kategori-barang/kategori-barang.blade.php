@extends('layout')

@section('page_title', 'Ringkasan Statistik')

@section('content')
    {{-- <div class="space-y-8">
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
    </div> --}}
    <div class="space-y-8">

        {{-- Flash Messages --}}
        @if (session('success'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3500)"
                x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 translate-y-0"
                x-transition:leave-end="opacity-0 -translate-y-2"
                class="flex items-center gap-3 p-4 bg-emerald-500/10 border border-emerald-500/30 rounded-2xl text-emerald-400 text-sm font-bold">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
                x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 translate-y-0"
                x-transition:leave-end="opacity-0 -translate-y-2"
                class="flex items-center gap-3 p-4 bg-red-500/10 border border-red-500/30 rounded-2xl text-red-400 text-sm font-bold">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                {{ session('error') }}
            </div>
        @endif

        <!-- Header Section -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="text-3xl font-black text-white italic tracking-tighter uppercase">Manajemen Kategori</h2>
                <p class="text-slate-500 text-sm font-medium">Klasifikasikan aset IT dan logistik publikasi Anda.</p>
            </div>
            <button wire:click="openCreateModal"
                class="flex items-center justify-center gap-3 px-6 py-3 bg-blue-600 hover:bg-blue-500 text-white text-xs font-black rounded-2xl transition-all shadow-lg shadow-blue-600/20 uppercase tracking-widest italic">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Kategori
            </button>
        </div>

        <!-- Quick Stats -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div
                class="p-6 bg-slate-900 border border-slate-800 rounded-[2rem] flex items-center gap-4 hover:border-blue-500/50 transition-all">
                <div
                    class="w-12 h-12 rounded-2xl bg-blue-600/10 flex items-center justify-center text-blue-500 font-black italic text-sm">
                    KAT</div>
                <div>
                    <p class="text-2xl font-black text-white italic">{{ $totalKategori }}</p>
                    <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Total Kategori</p>
                </div>
            </div>
            <div
                class="p-6 bg-slate-900 border border-slate-800 rounded-[2rem] flex items-center gap-4 hover:border-emerald-500/50 transition-all">
                <div
                    class="w-12 h-12 rounded-2xl bg-emerald-600/10 flex items-center justify-center text-emerald-500 font-black italic text-sm">
                    AS</div>
                <div>
                    <p class="text-2xl font-black text-white italic">{{ $totalItems }}</p>
                    <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Total Aset Terdaftar</p>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="bg-slate-900 border border-slate-800 rounded-[3rem] overflow-hidden shadow-2xl">
            <!-- Toolbar -->
            <div class="p-8 border-b border-slate-800">
                <div class="relative w-full md:w-96">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-500">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </span>
                    <input wire:model.live.debounce.300ms="search" type="text" placeholder="Cari nama kategori..."
                        class="w-full bg-slate-950 border border-slate-800 rounded-2xl py-3 pl-12 pr-4 text-sm text-white focus:border-blue-500 outline-none transition-all italic">
                </div>
            </div>

            <!-- Category Grid -->
            <div class="p-8 grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                @forelse ($kategori as $item)
                    <div
                        class="p-6 bg-slate-950/50 border border-slate-800 rounded-3xl hover:bg-slate-800/30 transition-all group">
                        <div class="flex justify-between items-start mb-6">
                            <span
                                class="px-3 py-1 bg-blue-600/10 text-blue-500 text-[10px] font-black rounded-lg uppercase italic tracking-tighter border border-blue-600/20">
                                {{ $item->items_count }} Item
                            </span>
                            <div class="flex gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                <button wire:click="openEditModal({{ $item->id }})"
                                    class="p-2 text-slate-500 hover:text-white bg-slate-800 rounded-lg transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                    </svg>
                                </button>
                                <button wire:click="confirmDelete({{ $item->id }})"
                                    class="p-2 text-slate-500 hover:text-red-500 bg-slate-800 rounded-lg transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <h4 class="text-xl font-black text-white italic tracking-tighter uppercase mb-2">{{ $item->name }}
                        </h4>
                        <div class="flex items-center justify-between pt-4 border-t border-slate-800/50">
                            <span
                                class="text-[10px] font-black text-slate-600 uppercase tracking-widest italic">Dibuat</span>
                            <span class="text-xs font-bold text-slate-500">{{ $item->created_at->format('d M Y') }}</span>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 flex flex-col items-center justify-center py-20 text-center">
                        <div
                            class="w-16 h-16 rounded-full bg-slate-800 flex items-center justify-center text-slate-600 mb-4">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <p class="text-sm font-black text-slate-600 uppercase tracking-widest italic">
                            @if ($search)
                                Tidak ada hasil untuk "{{ $search }}"
                            @else
                                Belum ada kategori
                            @endif
                        </p>
                    </div>
                @endforelse

                {{-- Card Tambah Baru --}}
                @if ($kategori->count() > 0)
                    <div wire:click="openCreateModal"
                        class="p-6 border-2 border-dashed border-slate-800 rounded-3xl flex flex-col items-center justify-center text-center group hover:border-blue-600/30 transition-all cursor-pointer">
                        <div
                            class="w-12 h-12 rounded-full bg-slate-900 flex items-center justify-center text-slate-700 mb-4 group-hover:text-blue-500 transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                        </div>
                        <p class="text-xs font-black text-slate-600 uppercase tracking-widest italic">Buat Kategori Baru
                        </p>
                    </div>
                @endif
            </div>

            <!-- Pagination Footer -->
            <div class="p-8 bg-slate-950/30 border-t border-slate-800">
                <div class="flex items-center justify-between">
                    <p class="text-[10px] font-bold text-slate-600 uppercase tracking-widest italic">
                        Menampilkan {{ $kategori->firstItem() ?? 0 }}–{{ $kategori->lastItem() ?? 0 }} dari
                        {{ $kategori->total() }} Kategori
                    </p>
                    <div class="flex gap-2">
                        <button wire:click="previousPage" @disabled(!$kategori->onFirstPage())
                            class="px-4 py-2 bg-slate-800 text-slate-400 text-[10px] font-black uppercase rounded-lg disabled:opacity-30 hover:bg-slate-700 transition-colors">Prev</button>
                        <button wire:click="nextPage" @disabled(!$kategori->hasMorePages())
                            class="px-4 py-2 bg-slate-800 text-white text-[10px] font-black uppercase rounded-lg disabled:opacity-30 hover:bg-slate-700 transition-colors">Next</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- ============================================ --}}
        {{-- MODAL TAMBAH / EDIT KATEGORI --}}
        {{-- ============================================ --}}
        @if ($showModal)
            <div class="fixed inset-0 z-50 flex items-center justify-center p-4" x-data x-init="$el.querySelector('[data-modal]').focus()">
                {{-- Backdrop --}}
                <div class="absolute inset-0 bg-slate-950/80 backdrop-blur-sm" wire:click="closeModal"></div>

                {{-- Panel --}}
                <div data-modal tabindex="-1"
                    class="relative w-full max-w-md bg-[#111827] border border-slate-800 rounded-[2rem] shadow-2xl p-8"
                    x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95"
                    x-transition:enter-end="opacity-100 scale-100">

                    <div class="flex items-center justify-between mb-8">
                        <h3 class="text-lg font-black text-white italic uppercase tracking-tighter">
                            {{ $editingId ? 'Edit Kategori' : 'Tambah Kategori' }}
                        </h3>
                        <button wire:click="closeModal"
                            class="p-2 text-slate-500 hover:text-white bg-slate-800 rounded-xl transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <label
                                class="block text-[10px] font-black text-slate-500 uppercase tracking-widest italic mb-2">Nama
                                Kategori</label>
                            <input wire:model="name" type="text" placeholder="Contoh: Komputer & Laptop"
                                class="w-full bg-slate-950 border @error('name') border-red-500 @else border-slate-800 @enderror rounded-2xl py-3 px-5 text-sm text-white focus:border-blue-500 outline-none transition-all italic"
                                wire:keydown.enter="save">
                            @error('name')
                                <p class="mt-2 text-xs text-red-400 font-bold">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex gap-3 mt-8">
                        <button wire:click="closeModal"
                            class="flex-1 px-6 py-3 bg-slate-800 hover:bg-slate-700 text-slate-300 text-xs font-black rounded-2xl transition-all uppercase tracking-widest italic">
                            Batal
                        </button>
                        <button wire:click="save" wire:loading.attr="disabled"
                            class="flex-1 px-6 py-3 bg-blue-600 hover:bg-blue-500 disabled:opacity-50 text-white text-xs font-black rounded-2xl transition-all uppercase tracking-widest italic shadow-lg shadow-blue-600/20">
                            <span wire:loading.remove
                                wire:target="save">{{ $editingId ? 'Simpan Perubahan' : 'Tambah' }}</span>
                            <span wire:loading wire:target="save">Menyimpan...</span>
                        </button>
                    </div>
                </div>
            </div>
        @endif

        {{-- ============================================ --}}
        {{-- MODAL KONFIRMASI DELETE --}}
        {{-- ============================================ --}}
        @if ($showDeleteModal)
            <div class="fixed inset-0 z-50 flex items-center justify-center p-4">
                <div class="absolute inset-0 bg-slate-950/80 backdrop-blur-sm"
                    wire:click="$set('showDeleteModal', false)"></div>
                <div class="relative w-full max-w-sm bg-[#111827] border border-slate-800 rounded-[2rem] shadow-2xl p-8 text-center"
                    x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95"
                    x-transition:enter-end="opacity-100 scale-100">
                    <div
                        class="w-16 h-16 rounded-full bg-red-500/10 border border-red-500/20 flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-black text-white italic uppercase tracking-tighter mb-2">Hapus Kategori?</h3>
                    <p class="text-sm text-slate-500 font-medium mb-8">Tindakan ini tidak bisa dibatalkan. Pastikan
                        kategori tidak memiliki barang terdaftar.</p>
                    <div class="flex gap-3">
                        <button wire:click="$set('showDeleteModal', false)"
                            class="flex-1 px-6 py-3 bg-slate-800 hover:bg-slate-700 text-slate-300 text-xs font-black rounded-2xl transition-all uppercase tracking-widest italic">
                            Batal
                        </button>
                        <button wire:click="delete" wire:loading.attr="disabled"
                            class="flex-1 px-6 py-3 bg-red-600 hover:bg-red-500 disabled:opacity-50 text-white text-xs font-black rounded-2xl transition-all uppercase tracking-widest italic">
                            <span wire:loading.remove wire:target="delete">Ya, Hapus</span>
                            <span wire:loading wire:target="delete">Menghapus...</span>
                        </button>
                    </div>
                </div>
            </div>
        @endif

    </div>
@endsection
