<div class="h-full font-sans antialiased text-slate-300" x-data="{ sidebarOpen: false }">

    <div class="flex h-screen overflow-hidden">

        <!-- 1. MOBILE SIDEBAR OVERLAY -->
        <div x-show="sidebarOpen" x-transition:enter="transition-opacity ease-linear duration-300"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0" @click="sidebarOpen = false"
            class="fixed inset-0 z-40 bg-navy-900/80 backdrop-blur-sm lg:hidden">
        </div>

        <!-- 2. SIDEBAR (Desktop & Mobile) -->
        <aside
            class="fixed inset-y-0 left-0 z-50 w-72 bg-[#111827] border-r border-slate-800 transition-transform duration-300 transform lg:static lg:inset-0 lg:translate-x-0"
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">
            <div class="flex flex-col h-full">
                <!-- Logo Section -->
                <div class="flex items-center justify-between h-20 px-6 bg-blue-600/5 border-b border-slate-800">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-blue-600 rounded-xl shadow-lg shadow-blue-600/20">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-14v4m0 0l8 4m-8-4l-8 4m8 4l8-4m8 4v10l-8 4m0-14v4" />
                            </svg>
                        </div>
                        <span class="text-xl font-black tracking-tighter text-white uppercase italic">StockHub</span>
                    </div>
                    <!-- Close button for mobile -->
                    <button @click="sidebarOpen = false" class="p-2 lg:hidden text-slate-400 hover:text-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Navigasi Menu -->
                <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto sidebar-scroll">
                    <p class="px-3 mb-2 text-[10px] font-black tracking-[0.2em] text-slate-600 uppercase italic">Main
                        Navigation</p>

                    <a wire:navigate href="{{ route('dashboard') }}"
                        class="flex items-center gap-3 px-4 py-3 text-sm font-bold rounded-2xl transition-all {{ request()->routeIs('dashboard') ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/20' : 'text-slate-400 hover:text-white hover:bg-slate-800' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        Dashboard
                    </a>

                    <!-- Dropdown Inventaris -->
                    <div x-data="{ open: {{ request()->is('inventory*') ? 'true' : 'false' }} }" class="pt-2">
                        <button @click="open = !open"
                            class="flex items-center justify-between w-full px-4 py-3 text-sm font-bold text-slate-400 hover:text-white hover:bg-slate-800 rounded-2xl transition-all">
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-14v4m0 0l8 4m-8-4l-8 4m8 4l8-4m8 4v10l-8 4m0-14v4" />
                                </svg>
                                Master Inventaris
                            </div>
                            <svg class="w-4 h-4 transition-transform duration-200" :class="open ? 'rotate-180' : ''"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="open" x-cloak x-collapse class="mt-1 ml-4 space-y-1">
                            <a wire:navigate href="{{ route('barang-it') }}"
                                class="block px-4 py-2 text-sm font-medium text-slate-500 hover:text-blue-400 transition-colors">Barang
                                IT</a>
                            <a wire:navigate href="{{ route('barang-publikasi') }}"
                                class="block px-4 py-2 text-sm font-medium text-slate-500 hover:text-blue-400 transition-colors">Barang
                                Publikasi</a>
                            <a wire:navigate href="{{ route('kategori') }}"
                                class="block px-4 py-2 text-sm font-medium text-slate-500 hover:text-blue-400 transition-colors">Kategori
                                Barang</a>
                        </div>
                    </div>

                    <!-- Menu Transaksi -->
                    <div x-data="{ open: {{ request()->is('transactions*') ? 'true' : 'false' }} }" class="pt-2">
                        <button @click="open = !open"
                            class="flex items-center justify-between w-full px-4 py-3 text-sm font-bold text-slate-400 hover:text-white hover:bg-slate-800 rounded-2xl transition-all">
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                                </svg>
                                Pergerakan Stok
                            </div>
                            <svg class="w-4 h-4 transition-transform duration-200" :class="open ? 'rotate-180' : ''"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="open" x-cloak x-collapse class="mt-1 ml-4 space-y-1">
                            <a wire:navigate href="{{ route('barang-masuk') }}"
                                class="block px-4 py-2 text-sm font-medium text-slate-500 hover:text-blue-400 transition-colors">Barang
                                Masuk</a>
                            <a wire:navigate href="{{ route('barang-keluar') }}"
                                class="block px-4 py-2 text-sm font-medium text-slate-500 hover:text-blue-400 transition-colors">Barang
                                Keluar</a>
                            <a wire:navigate href="{{ route('peminjaman') }}"
                                class="block px-4 py-2 text-sm font-medium text-slate-500 hover:text-blue-400 transition-colors">Peminjaman</a>
                        </div>
                    </div>

                    <p class="px-3 mt-8 mb-2 text-[10px] font-black tracking-[0.2em] text-slate-600 uppercase italic">
                        Reporting</p>
                    <a wire:navigate href="{{ route('rekapitulasi') }}"
                        class="flex items-center gap-3 px-4 py-3 text-sm font-bold text-slate-400 hover:text-white hover:bg-slate-800 rounded-2xl transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 17v-2m3 2v-4m3 2v-6m10 10V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2z" />
                        </svg>
                        Rekapitulasi Stok
                    </a>
                    {{-- ── SECTION SYSTEM (Superadmin Only) ── --}}
                    @if (auth()->user()->isSuperAdmin())
                        <p
                            class="px-3 mt-8 mb-2 text-[10px] font-black tracking-[0.2em] text-slate-600 uppercase italic">
                            System</p>

                        <a wire:navigate href="{{ route('kelola-pengguna') }}"
                            class="flex items-center gap-3 px-4 py-3 text-sm font-bold rounded-2xl transition-all
                                  {{ request()->routeIs('kelola-pengguna')
                                      ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/20'
                                      : 'text-slate-400 hover:text-white hover:bg-slate-800' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Kelola Pengguna
                            {{-- Badge jumlah user --}}
                            <span
                                class="ml-auto rounded-lg bg-blue-600/20 px-2 py-0.5 text-[10px] font-black text-blue-400">
                                {{ \App\Models\User::count() }}
                            </span>
                        </a>
                    @endif

                </nav>

                <!-- Profile Footer Section -->
                <div class="p-4 bg-slate-900/50 border-t border-slate-800">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="flex items-center justify-center w-full gap-2 px-4 py-3 text-xs font-black text-red-500 bg-red-500/5 hover:bg-red-500/10 border border-red-500/20 rounded-2xl transition-all uppercase tracking-widest">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            Log Out
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- 3. KONTEN UTAMA WRAPPER -->
        <div class="flex-1 flex flex-col min-w-0 overflow-hidden">

            <!-- NAVBAR ATAS (Header) -->
            <header
                class="flex items-center justify-between h-20 px-4 bg-[#111827] border-b border-slate-800 shrink-0 lg:px-8">
                <div class="flex items-center">
                    <!-- Hamburger Menu Mobile -->
                    <button @click="sidebarOpen = true"
                        class="p-2 mr-4 text-slate-400 rounded-xl lg:hidden hover:bg-slate-800 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                    <!-- Page Breadcrumb / Title -->
                    <div class="hidden md:block">
                        <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest italic">Sistem
                            Manajemen Gudang</p>
                        <h2 class="text-sm font-bold text-white uppercase tracking-tighter">@yield('page_title', 'Dashboard')</h2>
                    </div>
                </div>

                <!-- User Profile & Notifications -->
                <div class="flex items-center gap-4">
                    <button class="p-2 text-slate-400 hover:text-white transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                    </button>
                    <div class="h-8 w-[1px] bg-slate-800 mx-2"></div>
                    <div class="flex items-center gap-3">
                        <div class="hidden sm:block text-right">
                            <p class="text-xs font-black text-white italic uppercase tracking-tighter">
                                {{ Auth::user()->name }}</p>
                            <p class="text-[9px] text-slate-500 font-bold uppercase tracking-widest">Administrator</p>
                        </div>
                        <div
                            class="w-10 h-10 rounded-2xl bg-blue-600/10 border border-blue-600/20 flex items-center justify-center font-black text-blue-500 italic">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                    </div>
                </div>
            </header>

            <!-- MAIN CONTENT AREA -->
            <main class="flex-1 p-4 lg:p-8 overflow-y-auto custom-scrollbar bg-[#0a0f1d]">
                <div class="max-w-7xl mx-auto space-y-8">
                    @yield('content')
                </div>

                <!-- Simple Footer Inside Main -->
                <footer
                    class="mt-12 pt-8 border-t border-slate-800 flex flex-col md:flex-row justify-between items-center gap-4 pb-8">
                    <p class="text-[10px] font-bold text-slate-600 uppercase tracking-[0.2em] italic">StockHub
                        Management v1.0.4 &copy; {{ date('Y') }}</p>
                    <div class="flex gap-6 text-[10px] font-bold text-slate-600 uppercase tracking-widest">
                        <a href="#" class="hover:text-slate-400 transition-colors">Docs</a>
                        <a href="#" class="hover:text-slate-400 transition-colors">Support</a>
                    </div>
                </footer>
            </main>
        </div>
    </div>

</div>
