<!DOCTYPE html>
<html lang="id" class="h-full bg-slate-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Sistem Informasi Surat')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            font-size: 0.875rem; /* 14px default for clean compact UI */
        }
    </style>
</head>
<body class="min-h-full flex flex-col text-slate-800 antialiased">
    {{-- NAVBAR COMPACT --}}
    <nav class="bg-blue-600 border-b border-blue-700/50 shadow-sm sticky top-0 z-40">
        <div class="mx-auto max-w-6xl px-4 sm:px-6">
            <div class="flex h-14 items-center justify-between">
                {{-- Brand / Logo --}}
                <a href="{{ route('dashboard') }}" class="flex items-center gap-2.5 group">
                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-white/10 text-white group-hover:bg-white/20 transition">
                        <svg class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                        </svg>
                    </div>
                    <div>
                        <span class="text-sm sm:text-base font-bold text-white tracking-tight">SIS Surat</span>
                        <span class="hidden sm:inline-block text-[11px] text-blue-200 ml-1 font-normal">| Praktikum Web 2</span>
                    </div>
                </a>

                {{-- Desktop Menu --}}
                <div class="hidden sm:flex items-center gap-1">
                    <a href="{{ route('dashboard') }}"
                       class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-md text-xs font-medium transition {{ request()->routeIs('dashboard') ? 'bg-blue-700 text-white shadow-xs' : 'text-blue-100 hover:bg-blue-700/60 hover:text-white' }}">
                        <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                        </svg>
                        Dashboard
                    </a>
                    <a href="{{ route('surat-masuk.index') }}"
                       class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-md text-xs font-medium transition {{ request()->routeIs('surat-masuk.*') ? 'bg-blue-700 text-white shadow-xs' : 'text-blue-100 hover:bg-blue-700/60 hover:text-white' }}">
                        <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 3.75H6.912a2.25 2.25 0 0 0-2.15 1.588L2.35 13.177a2.25 2.25 0 0 0-.1.661V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18v-4.162c0-.224-.034-.447-.1-.661L19.24 5.338a2.25 2.25 0 0 0-2.15-1.588H15M2.25 13.5h3.86a2.25 2.25 0 0 1 2.012 1.244l.256.512a2.25 2.25 0 0 0 2.013 1.244h3.218a2.25 2.25 0 0 0 2.013-1.244l.256-.512a2.25 2.25 0 0 1 2.013-1.244h3.859M12 3v8.25m0 0-3-3m3 3 3-3" />
                        </svg>
                        Surat Masuk
                    </a>
                    <a href="{{ route('surat-keluar.index') }}"
                       class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-md text-xs font-medium transition {{ request()->routeIs('surat-keluar.*') ? 'bg-blue-700 text-white shadow-xs' : 'text-blue-100 hover:bg-blue-700/60 hover:text-white' }}">
                        <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                        </svg>
                        Surat Keluar
                    </a>
                </div>

                {{-- Mobile Menu Button --}}
                <button type="button" id="mobile-menu-btn" class="sm:hidden p-1.5 text-blue-100 hover:bg-blue-700 rounded-md focus:outline-none">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </button>
            </div>
        </div>

        {{-- Mobile Menu Panel --}}
        <div id="mobile-menu" class="hidden sm:hidden border-t border-blue-700/60 bg-blue-650 px-4 py-2 space-y-1">
            <a href="{{ route('dashboard') }}" class="block px-3 py-1.5 rounded text-xs font-medium {{ request()->routeIs('dashboard') ? 'bg-blue-800 text-white' : 'text-blue-100 hover:bg-blue-700' }}">Dashboard</a>
            <a href="{{ route('surat-masuk.index') }}" class="block px-3 py-1.5 rounded text-xs font-medium {{ request()->routeIs('surat-masuk.*') ? 'bg-blue-800 text-white' : 'text-blue-100 hover:bg-blue-700' }}">Surat Masuk</a>
            <a href="{{ route('surat-keluar.index') }}" class="block px-3 py-1.5 rounded text-xs font-medium {{ request()->routeIs('surat-keluar.*') ? 'bg-blue-800 text-white' : 'text-blue-100 hover:bg-blue-700' }}">Surat Keluar</a>
        </div>
    </nav>

    {{-- MAIN CONTAINER --}}
    <main class="flex-1 mx-auto w-full max-w-6xl px-4 sm:px-6 py-6">
        {{-- Flash Success Alert --}}
        @if (session('success'))
            <div class="alert-dismissible mb-4 flex items-center justify-between rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-2.5 text-xs text-emerald-800 shadow-xs">
                <div class="flex items-center gap-2">
                    <svg class="h-4 w-4 text-emerald-600 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
                <button type="button" onclick="this.closest('.alert-dismissible').remove()" class="text-emerald-600 hover:text-emerald-800 ml-3">
                    <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        @endif

        @yield('content')
    </main>

    {{-- FOOTER COMPACT --}}
    <footer class="mt-auto border-t border-slate-200 bg-white py-3.5">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 flex flex-col sm:flex-row items-center justify-between gap-1 text-[11px] text-slate-500">
            <p>&copy; {{ date('Y') }} Sistem Informasi Surat — Praktikum Web 2</p>
            <p class="text-slate-400">Laravel 11 &bull; Tailwind CSS &bull; Vite</p>
        </div>
    </footer>
</body>
</html>
