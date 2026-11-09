@extends('layouts.app')
@section('title', 'Daftar Surat Masuk')

@section('content')
    {{-- Header & Actions --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-4">
        <div>
            <div class="flex items-center gap-2">
                <a href="{{ route('dashboard') }}" class="text-xs text-slate-400 hover:text-slate-600">&larr; Dashboard</a>
                <span class="text-xs text-slate-300">/</span>
                <span class="text-xs font-medium text-slate-600">Surat Masuk</span>
            </div>
            <h1 class="text-lg font-bold text-slate-800 mt-0.5">Daftar Surat Masuk</h1>
        </div>
        <div class="flex items-center gap-2">
            {{-- Instant Search Filter --}}
            <div class="relative">
                <input type="text"
                       data-table-search="table-surat-masuk"
                       placeholder="Cari surat..."
                       class="w-40 sm:w-56 rounded-lg border border-slate-200 bg-white pl-8 pr-3 py-1.5 text-xs text-slate-700 shadow-2xs focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
                <svg class="pointer-events-none absolute left-2.5 top-2 h-3.5 w-3.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                </svg>
            </div>
            <a href="{{ route('surat-masuk.create') }}"
               class="inline-flex items-center gap-1.5 rounded-lg bg-emerald-600 hover:bg-emerald-700 px-3 py-1.5 text-xs font-semibold text-white shadow-xs transition active:scale-95">
                <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Tambah Surat Masuk
            </a>
        </div>
    </div>

    {{-- Table Card --}}
    <div class="rounded-xl border border-slate-200/80 bg-white shadow-xs overflow-hidden">
        <div class="overflow-x-auto">
            <table id="table-surat-masuk" class="w-full text-left text-xs">
                <thead class="border-b border-slate-200 bg-slate-50 text-[11px] font-semibold uppercase tracking-wider text-slate-500">
                    <tr>
                        <th class="px-3.5 py-2.5 w-12 text-center">No</th>
                        <th class="px-3.5 py-2.5">Nomor Surat</th>
                        <th class="px-3.5 py-2.5 w-28">Tanggal</th>
                        <th class="px-3.5 py-2.5">Pengirim</th>
                        <th class="px-3.5 py-2.5">Perihal</th>
                        <th class="px-3.5 py-2.5 w-36 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-slate-700">
                    @forelse ($suratMasuk as $surat)
                        <tr data-search-row class="hover:bg-slate-50/80 transition-colors">
                            <td class="px-3.5 py-2.5 text-center text-slate-400 font-mono">{{ $loop->iteration }}</td>
                            <td class="px-3.5 py-2.5 font-semibold text-slate-900 whitespace-nowrap">{{ $surat->nomor_surat }}</td>
                            <td class="px-3.5 py-2.5 text-slate-600 whitespace-nowrap">{{ $surat->tanggal }}</td>
                            <td class="px-3.5 py-2.5 text-slate-700 font-medium">{{ $surat->pengirim }}</td>
                            <td class="px-3.5 py-2.5 text-slate-600 max-w-xs truncate">{{ $surat->perihal }}</td>
                            <td class="px-3.5 py-2.5 text-center whitespace-nowrap">
                                <div class="inline-flex items-center gap-1">
                                    <a href="{{ route('surat-masuk.show', $surat->id) }}"
                                       class="rounded px-2 py-1 text-[11px] font-medium text-emerald-700 bg-emerald-50 hover:bg-emerald-100 transition">
                                        Detail
                                    </a>
                                    <a href="{{ route('surat-masuk.edit', $surat->id) }}"
                                       class="rounded px-2 py-1 text-[11px] font-medium text-amber-700 bg-amber-50 hover:bg-amber-100 transition">
                                        Edit
                                    </a>
                                    <form action="{{ route('surat-masuk.destroy', $surat->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus surat {{ $surat->nomor_surat }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="rounded px-2 py-1 text-[11px] font-medium text-red-700 bg-red-50 hover:bg-red-100 transition">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-8 text-center text-xs text-slate-400">
                                Belum ada data surat masuk.
                            </td>
                        </tr>
                    @endforelse
                    <tr id="table-surat-masuk-no-results" style="display: none;">
                        <td colspan="6" class="px-4 py-6 text-center text-xs text-slate-400">
                            Tidak ada surat yang cocok dengan pencarian.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="border-t border-slate-100 bg-slate-50/50 px-4 py-2 flex items-center justify-between text-[11px] text-slate-500">
            <span>Total: {{ count($suratMasuk) }} data</span>
            <span class="text-slate-400">Diurutkan berdasarkan terbaru</span>
        </div>
    </div>
@endsection
