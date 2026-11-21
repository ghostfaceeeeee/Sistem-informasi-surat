<!DOCTYPE html>
<html lang="id" class="h-full bg-slate-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Informasi Surat</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
        }
    </style>
</head>
<body class="min-h-full flex items-center justify-center antialiased">
    <div class="w-full max-w-sm px-4">
        {{-- Logo / Brand --}}
        <div class="text-center mb-6">
            <div class="inline-flex h-12 w-12 items-center justify-center rounded-xl bg-blue-600 text-white shadow-lg mb-3">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                </svg>
            </div>
            <h1 class="text-lg font-bold text-slate-800">SIS Surat</h1>
            <p class="text-xs text-slate-500 mt-0.5">Sistem Informasi Manajemen Surat</p>
        </div>

        {{-- Login Card --}}
        <div class="rounded-xl border border-slate-200/80 bg-white p-6 shadow-xs">
            <h2 class="text-sm font-bold text-slate-800 mb-1">Masuk ke Akun Anda</h2>
            <p class="text-xs text-slate-500 mb-5">Silakan masukkan email dan password untuk melanjutkan.</p>

            <form method="POST" action="{{ route('login.submit') }}" class="space-y-3.5">
                @csrf

                <div>
                    <label for="email" class="block text-xs font-semibold text-slate-700 mb-1">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                           class="w-full rounded-lg border border-slate-300 px-3 py-2 text-xs text-slate-800 placeholder-slate-400 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 focus:outline-none"
                           placeholder="contoh@email.test">
                    @error('email')
                        <p class="mt-1 text-[11px] text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-xs font-semibold text-slate-700 mb-1">Password</label>
                    <input type="password" id="password" name="password" required
                           class="w-full rounded-lg border border-slate-300 px-3 py-2 text-xs text-slate-800 placeholder-slate-400 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 focus:outline-none"
                           placeholder="Masukkan password">
                    @error('password')
                        <p class="mt-1 text-[11px] text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit"
                        class="w-full rounded-lg bg-blue-600 hover:bg-blue-700 px-4 py-2 text-xs font-semibold text-white shadow-xs transition active:scale-[0.98]">
                    Masuk
                </button>
            </form>
        </div>

        <p class="text-center text-[11px] text-slate-400 mt-4">&copy; {{ date('Y') }} Sistem Informasi Surat</p>
    </div>
</body>
</html>
