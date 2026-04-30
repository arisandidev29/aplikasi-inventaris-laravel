<!DOCTYPE html>
<html lang="id" class="h-full bg-[#0a0f1d]">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Sandi | Sistem Inventaris</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body class="h-full font-sans antialiased text-slate-300">

    <div class="flex min-h-screen items-center justify-center p-4 lg:p-8">
        <div class="w-full max-w-md">

            <!-- Logo & Heading -->
            <div class="mb-10 text-center">
                <div class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-2xl bg-blue-600 shadow-xl shadow-blue-900/40">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                    </svg>
                </div>
                <h1 class="text-2xl font-bold tracking-tight text-white">Lupa Kata Sandi?</h1>
                <p class="mt-2 text-sm text-slate-400">Masukkan email Anda, kami akan kirimkan tautan reset password</p>
            </div>

            <!-- Card -->
            <div class="overflow-hidden rounded-3xl border border-slate-800 bg-[#111827] shadow-2xl">
                <div class="p-8 lg:p-10">

                    {{-- Notifikasi sukses setelah email terkirim --}}
                    @if (session('status'))
                        <div class="mb-6 flex items-start gap-3 rounded-xl border border-emerald-500/50 bg-emerald-500/10 p-4 text-sm text-emerald-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="mt-0.5 h-5 w-5 shrink-0" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                            <div>
                                <p class="font-semibold text-emerald-300">Email Terkirim!</p>
                                <p class="mt-0.5">Tautan reset password telah dikirim. Silakan cek inbox atau folder spam.</p>
                            </div>
                        </div>
                    @endif

                    {{-- Error --}}
                    @if ($errors->any())
                        <div class="mb-6 flex items-start gap-3 rounded-xl border border-red-500/50 bg-red-500/10 p-4 text-sm text-red-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                            </svg>
                            <p>{{ $errors->first('email') }}</p>
                        </div>
                    @endif

                    <form action="{{ route('password.email') }}" method="POST" class="space-y-6"
                          x-data="{ loading: false }" @submit="loading = true">
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
                                <input
                                    type="email" id="email" name="email"
                                    required autofocus value="{{ old('email') }}"
                                    class="block w-full rounded-xl border border-slate-700 bg-slate-900/50 py-3 pl-11 pr-4 text-white placeholder-slate-500 transition focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 sm:text-sm"
                                    placeholder="nama@perusahaan.com">
                            </div>
                        </div>

                        <!-- Submit -->
                        <button type="submit" :disabled="loading"
                            class="relative flex w-full justify-center rounded-xl bg-blue-600 px-4 py-3 text-sm font-bold text-white transition hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-2 focus:ring-offset-[#111827] active:scale-95 disabled:opacity-70">
                            <span x-show="!loading">KIRIM TAUTAN RESET</span>
                            <span x-show="loading" x-cloak class="flex items-center gap-2">
                                <svg class="h-4 w-4 animate-spin text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Mengirim...
                            </span>
                        </button>

                        <!-- Kembali ke login -->
                        <div class="text-center">
                            <a href="{{ route('login') }}"
                               class="inline-flex items-center gap-1.5 text-sm text-slate-400 transition hover:text-blue-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                                </svg>
                                Kembali ke halaman masuk
                            </a>
                        </div>
                    </form>
                </div>

                <!-- Footer -->
                <div class="border-t border-slate-800 bg-slate-900/50 px-8 py-4 text-center">
                    <p class="text-xs text-slate-500 italic">Tautan reset akan dikirim ke email yang terdaftar di sistem</p>
                </div>
            </div>

            <!-- Copyright -->
            <p class="mt-8 text-center text-xs font-medium uppercase tracking-widest text-slate-600">
                &copy; 2024 Inventaris IT & Publikasi
            </p>
        </div>
    </div>

</body>
</html>