@extends('layouts.app')

@section('title', 'Dashboard - Sistem Informasi Surat')

@section('content')
    {{-- Header & Quick Actions --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-5">
        <div>
            <h1 class="text-xl font-bold text-slate-800 tracking-tight">Dashboard Overview</h1>
            <p class="text-xs text-slate-500 mt-0.5">Ringkasan data surat masuk dan surat keluar.</p>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('surat-masuk.create') }}"
               class="inline-flex items-center gap-1.5 rounded-lg bg-emerald-600 hover:bg-emerald-700 px-3 py-1.5 text-xs font-semibold text-white shadow-xs transition active:scale-95">
                <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Tambah Surat Masuk
            </a>
            <a href="{{ route('surat-keluar.create') }}"
               class="inline-flex items-center gap-1.5 rounded-lg bg-blue-600 hover:bg-blue-700 px-3 py-1.5 text-xs font-semibold text-white shadow-xs transition active:scale-95">
                <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Tambah Surat Keluar
            </a>
        </div>
    </div>

    {{-- Stats Cards (Compact & Neat) --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3.5 mb-6">
        {{-- Card Surat Masuk --}}
        <div class="rounded-xl border border-slate-200/80 bg-white p-4 shadow-xs transition hover:border-slate-300">
            <div class="flex items-center justify-between">
                <div>
                    <span class="text-[11px] font-medium uppercase tracking-wider text-slate-500">Surat Masuk</span>
                    <h3 class="mt-1 text-2xl font-bold text-slate-800">{{ $jumlahMasuk }}</h3>
                </div>
                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-emerald-50 text-emerald-600">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 3.75H6.912a2.25 2.25 0 0 0-2.15 1.588L2.35 13.177a2.25 2.25 0 0 0-.1.661V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18v-4.162c0-.224-.034-.447-.1-.661L19.24 5.338a2.25 2.25 0 0 0-2.15-1.588H15M2.25 13.5h3.86a2.25 2.25 0 0 1 2.012 1.244l.256.512a2.25 2.25 0 0 0 2.013 1.244h3.218a2.25 2.25 0 0 0 2.013-1.244l.256-.512a2.25 2.25 0 0 1 2.013-1.244h3.859M12 3v8.25m0 0-3-3m3 3 3-3" />
                    </svg>
                </div>
            </div>
            <div class="mt-3 pt-2.5 border-t border-slate-100 flex items-center justify-between">
                <a href="{{ route('surat-masuk.index') }}" class="text-[11px] font-semibold text-emerald-600 hover:text-emerald-700 inline-flex items-center gap-1">
                    Buka Surat Masuk &rarr;
                </a>
                <span class="text-[10px] text-slate-400">Total terarsip</span>
            </div>
        </div>

        {{-- Card Surat Keluar --}}
        <div class="rounded-xl border border-slate-200/80 bg-white p-4 shadow-xs transition hover:border-slate-300">
            <div class="flex items-center justify-between">
                <div>
                    <span class="text-[11px] font-medium uppercase tracking-wider text-slate-500">Surat Keluar</span>
                    <h3 class="mt-1 text-2xl font-bold text-slate-800">{{ $jumlahKeluar }}</h3>
                </div>
                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-blue-50 text-blue-600">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                    </svg>
                </div>
            </div>
            <div class="mt-3 pt-2.5 border-t border-slate-100 flex items-center justify-between">
                <a href="{{ route('surat-keluar.index') }}" class="text-[11px] font-semibold text-blue-600 hover:text-blue-700 inline-flex items-center gap-1">
                    Buka Surat Keluar &rarr;
                </a>
                <span class="text-[10px] text-slate-400">Total terarsip</span>
            </div>
        </div>

        {{-- Card Total Semua --}}
        <div class="rounded-xl border border-slate-200/80 bg-white p-4 shadow-xs transition hover:border-slate-300">
            <div class="flex items-center justify-between">
                <div>
                    <span class="text-[11px] font-medium uppercase tracking-wider text-slate-500">Total Semua Arsip</span>
                    <h3 class="mt-1 text-2xl font-bold text-slate-800">{{ $jumlahMasuk + $jumlahKeluar }}</h3>
                </div>
                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-indigo-50 text-indigo-600">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 9.776c.112-.017.227-.026.344-.026h15.812c.117 0 .232.009.344.026m-16.5 0a2.25 2.25 0 0 0-1.883 2.542l.857 6a2.25 2.25 0 0 0 2.227 1.932H19.05a2.25 2.25 0 0 0 2.227-1.932l.857-6a2.25 2.25 0 0 0-1.883-2.542m-16.5 0V6A2.25 2.25 0 0 1 6 3.75h3.879a1.5 1.5 0 0 1 1.06.44l2.122 2.12a1.5 1.5 0 0 0 1.06.44H18A2.25 2.25 0 0 1 20.25 9v.776" />
                    </svg>
                </div>
            </div>
            <div class="mt-3 pt-2.5 border-t border-slate-100 flex items-center justify-between">
                <span class="text-[11px] font-medium text-indigo-600">Surat Masuk + Keluar</span>
                <span class="text-[10px] text-slate-400">Arsip Digital</span>
            </div>
        </div>
    </div>

    {{-- Two-column Recent Letter Previews --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
        {{-- Recent Surat Masuk --}}
        <div class="rounded-xl border border-slate-200/80 bg-white shadow-xs overflow-hidden">
            <div class="flex items-center justify-between border-b border-slate-100 px-4 py-2.5 bg-slate-50/50">
                <div class="flex items-center gap-1.5">
                    <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
                    <h2 class="text-xs font-bold uppercase tracking-wider text-slate-700">Surat Masuk Terbaru</h2>
                </div>
                <a href="{{ route('surat-masuk.index') }}" class="text-[11px] font-medium text-blue-600 hover:underline">Selengkapnya</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead class="border-b border-slate-100 bg-slate-50 text-[11px] text-slate-500 font-semibold">
                        <tr>
                            <th class="px-3.5 py-2">No. Surat</th>
                            <th class="px-3.5 py-2">Pengirim</th>
                            <th class="px-3.5 py-2">Tanggal</th>
                            <th class="px-3.5 py-2 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-700">
                        @forelse ($suratMasukTerbaru as $surat)
                            <tr class="hover:bg-slate-50/70">
                                <td class="px-3.5 py-2 font-medium text-slate-900 truncate max-w-[140px]">{{ $surat->nomor_surat }}</td>
                                <td class="px-3.5 py-2 text-slate-600 truncate max-w-[120px]">{{ $surat->pengirim }}</td>
                                <td class="px-3.5 py-2 text-slate-500 whitespace-nowrap">{{ $surat->tanggal }}</td>
                                <td class="px-3.5 py-2 text-right">
                                    <a href="{{ route('surat-masuk.show', $surat->id) }}" class="text-[11px] font-semibold text-emerald-600 hover:text-emerald-700">Detail</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-3.5 py-4 text-center text-xs text-slate-400">Belum ada surat masuk.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Recent Surat Keluar --}}
        <div class="rounded-xl border border-slate-200/80 bg-white shadow-xs overflow-hidden">
            <div class="flex items-center justify-between border-b border-slate-100 px-4 py-2.5 bg-slate-50/50">
                <div class="flex items-center gap-1.5">
                    <span class="h-2 w-2 rounded-full bg-blue-500"></span>
                    <h2 class="text-xs font-bold uppercase tracking-wider text-slate-700">Surat Keluar Terbaru</h2>
                </div>
                <a href="{{ route('surat-keluar.index') }}" class="text-[11px] font-medium text-blue-600 hover:underline">Selengkapnya</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead class="border-b border-slate-100 bg-slate-50 text-[11px] text-slate-500 font-semibold">
                        <tr>
                            <th class="px-3.5 py-2">No. Surat</th>
                            <th class="px-3.5 py-2">Penerima</th>
                            <th class="px-3.5 py-2">Tanggal</th>
                            <th class="px-3.5 py-2 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-700">
                        @forelse ($suratKeluarTerbaru as $surat)
                            <tr class="hover:bg-slate-50/70">
                                <td class="px-3.5 py-2 font-medium text-slate-900 truncate max-w-[140px]">{{ $surat->nomor_surat }}</td>
                                <td class="px-3.5 py-2 text-slate-600 truncate max-w-[120px]">{{ $surat->penerima }}</td>
                                <td class="px-3.5 py-2 text-slate-500 whitespace-nowrap">{{ $surat->tanggal }}</td>
                                <td class="px-3.5 py-2 text-right">
                                    <a href="{{ route('surat-keluar.show', $surat->id) }}" class="text-[11px] font-semibold text-blue-600 hover:text-blue-700">Detail</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-3.5 py-4 text-center text-xs text-slate-400">Belum ada surat keluar.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
