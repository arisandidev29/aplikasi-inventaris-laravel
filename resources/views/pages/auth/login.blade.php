<!DOCTYPE html>
<html lang="id" class="h-full bg-[#0a0f1d]">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Sistem Inventaris</title>
      @vite(['resources/css/app.css', 'resources/js/app.js']) 
    <!-- Tailwind CSS -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="h-full font-sans antialiased text-slate-300">

    <div class="flex min-h-screen items-center justify-center p-4 lg:p-8">
        <div class="w-full max-w-md">
            
            <!-- Logo & Heading -->
            <div class="mb-10 text-center">
                <div class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-2xl bg-blue-600 shadow-xl shadow-blue-900/40">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-14v4m0 0l8 4m-8-4l-8 4m8 4l8-4m8 4v10l-8 4m0-14v4" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <h1 class="text-2xl font-bold tracking-tight text-white">Sistem Inventaris</h1>
                <p class="mt-2 text-sm text-slate-400">Silakan masuk untuk akses manajemen stok</p>
            </div>

            <!-- Login Card -->
            <div class="overflow-hidden rounded-3xl border border-slate-800 bg-[#111827] shadow-2xl">
                <div class="p-8 lg:p-10">
                    
                    <!-- Alert Error dari Fortify -->
                    @if ($errors->any())
                        <div class="mb-6 flex items-start gap-3 rounded-xl border border-red-500/50 bg-red-500/10 p-4 text-sm text-red-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                            </svg>
                            <p>Email atau password yang Anda masukkan salah. Silakan coba lagi.</p>
                        </div>
                    @endif

                    <form action="{{ route('login') }}" method="POST" class="space-y-6" x-data="{ loading: false }" @submit="loading = true">
                        @csrf
                        
                        <!-- Input Email -->
                        <div>
                            <label for="email" class="mb-2 block text-sm font-medium text-slate-300">Alamat Email</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                    </svg>
                                </span>
                                <input type="email" id="email" name="email" required autofocus
                                    class="block w-full rounded-xl border border-slate-700 bg-slate-900/50 py-3 pl-11 pr-4 text-white placeholder-slate-500 transition focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 sm:text-sm"
                                    placeholder="nama@perusahaan.com">
                            </div>
                        </div>

                        <!-- Input Password -->
                        <div x-data="{ show: false }">
                            <div class="flex items-center justify-between mb-2">
                                <label for="password" class="block text-sm font-medium text-slate-300">Kata Sandi</label>
                                <a href="#" class="text-xs font-semibold text-blue-500 hover:text-blue-400">Lupa sandi?</a>
                            </div>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                                    </svg>
                                </span>
                                <input :type="show ? 'text' : 'password'" id="password" name="password" required
                                    class="block w-full rounded-xl border border-slate-700 bg-slate-900/50 py-3 pl-11 pr-12 text-white placeholder-slate-500 transition focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 sm:text-sm"
                                    placeholder="••••••••">
                                
                                <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 flex items-center pr-3 text-slate-500 hover:text-blue-400">
                                    <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                        <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.523 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                                    </svg>
                                    <svg x-show="show" x-cloak xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M3.707 2.293a1 1 0 00-1.414 1.414l14 14a1 1 0 001.414-1.414l-1.473-1.473A10.014 10.014 0 0019.542 10C18.268 5.943 14.477 3 10 3a9.991 9.991 0 00-4.512 1.074l-1.78-1.781zm4.261 4.26l1.514 1.515a2.003 2.003 0 012.45 2.45l1.514 1.514a4 4 0 00-5.478-5.478z" clip-rule="evenodd" />
                                        <path d="M12.454 16.697L9.75 13.992a4 4 0 01-3.742-3.741L2.335 6.578A9.98 9.98 0 00.458 10c1.274 4.057 5.065 7 9.542 7 .847 0 1.669-.105 2.454-.303z" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <!-- Remember Me -->
                        <div class="flex items-center">
                            <input id="remember_me" name="remember" type="checkbox" 
                                class="h-4 w-4 rounded border-slate-700 bg-slate-900 text-blue-600 focus:ring-blue-600 focus:ring-offset-slate-900">
                            <label for="remember_me" class="ml-2 block text-sm text-slate-400">Ingat saya di perangkat ini</label>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" :disabled="loading"
                            class="relative flex w-full justify-center rounded-xl bg-blue-600 px-4 py-3 text-sm font-bold text-white transition hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-2 focus:ring-offset-[#111827] active:scale-95 disabled:opacity-70">
                            <span x-show="!loading">MASUK KE SISTEM</span>
                            <span x-show="loading" class="flex items-center gap-2">
                                <svg class="h-4 w-4 animate-spin text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Memproses...
                            </span>
                        </button>
                    </form>
                </div>
                
                <!-- Footer Card -->
                <div class="border-t border-slate-800 bg-slate-900/50 px-8 py-4 text-center">
                    <p class="text-xs text-slate-500 italic">Akses terbatas untuk personil yang berwenang</p>
                </div>
            </div>

            <!-- Copyright -->
            <p class="mt-8 text-center text-xs font-medium text-slate-600 uppercase tracking-widest">
                &copy; 2024 Inventaris IT & Publikasi
            </p>
        </div>
    </div>

</body>
</html>