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
            @can('manage-letters')
            <a href="{{ route('surat-masuk.create') }}"
               class="inline-flex items-center gap-1.5 rounded-lg bg-emerald-600 hover:bg-emerald-700 px-3 py-1.5 text-xs font-semibold text-white shadow-xs transition active:scale-95">
                <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Tambah Surat Masuk
            </a>
            @endcan
        </div>
    </div>

    {{-- Filter & Search Form --}}
    <form method="GET" action="{{ route('surat-masuk.index') }}" class="rounded-xl border border-slate-200/80 bg-white p-3 shadow-xs mb-4 flex flex-col sm:flex-row items-stretch sm:items-center gap-2.5">
        <div class="relative flex-1">
            <input type="text"
                   name="q"
                   value="{{ request('q') }}"
                   placeholder="Nomor, pengirim, atau perihal"
                   class="w-full rounded-lg border border-slate-300 pl-8 pr-3 py-1.5 text-xs text-slate-800 placeholder-slate-400 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
            <svg class="pointer-events-none absolute left-2.5 top-2 h-3.5 w-3.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
            </svg>
        </div>

        <div class="w-full sm:w-52">
            <select name="category_id"
                    class="w-full rounded-lg border border-slate-300 px-3 py-1.5 text-xs text-slate-800 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
                <option value="">Semua kategori</option>
                @foreach ($categories as $kategori)
                    <option value="{{ $kategori->id }}" @selected(request('category_id') == $kategori->id)>
                        {{ $kategori->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="flex items-center gap-2">
            <button type="submit"
                    class="inline-flex items-center justify-center gap-1.5 rounded-lg bg-blue-600 hover:bg-blue-700 px-3.5 py-1.5 text-xs font-semibold text-white shadow-xs transition active:scale-95">
                <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                </svg>
                Cari / Filter
            </button>
            <a href="{{ route('surat-masuk.index') }}"
               class="inline-flex items-center justify-center rounded-lg border border-slate-300 bg-white hover:bg-slate-50 px-3 py-1.5 text-xs font-medium text-slate-600 transition">
                Reset
            </a>
        </div>
    </form>

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
                        <th class="px-3.5 py-2.5">Kategori</th>
                        <th class="px-3.5 py-2.5 w-36 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-slate-700">
                    @forelse ($suratMasuk as $surat)
                        <tr class="hover:bg-slate-50/80 transition-colors">
                            <td class="px-3.5 py-2.5 text-center text-slate-400 font-mono">
                                {{ $suratMasuk->firstItem() ? $suratMasuk->firstItem() + $loop->index : $loop->iteration }}
                            </td>
                            <td class="px-3.5 py-2.5 font-semibold text-slate-900 whitespace-nowrap">
                                <div class="flex items-center gap-1.5">
                                    <span>{{ $surat->nomor_surat }}</span>
                                    @if ($surat->lampiran)
                                        <span title="Memiliki lampiran" class="text-blue-500">
                                            <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m18.375 12.739-7.693 7.693a4.5 4.5 0 0 1-6.364-6.364l10.94-10.94A3 3 0 1 1 19.5 7.372L8.552 18.32m.009-.01-.01.01m5.699-9.941-7.81 7.81a1.5 1.5 0 0 0 2.112 2.13" />
                                            </svg>
                                        </span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-3.5 py-2.5 text-slate-600 whitespace-nowrap">{{ $surat->tanggal }}</td>
                            <td class="px-3.5 py-2.5 text-slate-700 font-medium">{{ $surat->pengirim }}</td>
                            <td class="px-3.5 py-2.5 text-slate-600 max-w-xs truncate">{{ $surat->perihal }}</td>
                            <td class="px-3.5 py-2.5 whitespace-nowrap">
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[11px] font-medium {{ $surat->category ? 'bg-indigo-50 text-indigo-700 border border-indigo-100' : 'bg-slate-100 text-slate-500' }}">
                                    {{ $surat->category?->nama ?? 'Tanpa kategori' }}
                                </span>
                            </td>
                            <td class="px-3.5 py-2.5 text-center whitespace-nowrap">
                                <div class="inline-flex items-center gap-1">
                                    <a href="{{ route('surat-masuk.show', $surat->id) }}"
                                       class="rounded px-2 py-1 text-[11px] font-medium text-emerald-700 bg-emerald-50 hover:bg-emerald-100 transition">
                                        Detail
                                    </a>
                                    @can('manage-letters')
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
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-8 text-center text-xs text-slate-400">
                                Belum ada data surat masuk.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination & Footer Bar --}}
        <div class="border-t border-slate-100 bg-slate-50/50 px-4 py-3 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-slate-600">
            <div>
                Menampilkan <span class="font-semibold text-slate-800">{{ $suratMasuk->firstItem() ?? 0 }}</span> sampai <span class="font-semibold text-slate-800">{{ $suratMasuk->lastItem() ?? 0 }}</span> dari <span class="font-semibold text-slate-800">{{ $suratMasuk->total() }}</span> data surat
            </div>
            <div class="flex items-center gap-2">
                @if ($suratMasuk->previousPageUrl())
                    <a href="{{ $suratMasuk->previousPageUrl() }}"
                       class="inline-flex items-center gap-1 px-2.5 py-1 rounded-md border border-slate-300 bg-white hover:bg-slate-50 text-slate-700 font-medium transition shadow-2xs">
                        Sebelumnya
                    </a>
                @else
                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-md border border-slate-200 bg-slate-100 text-slate-400 font-medium cursor-not-allowed">
                        Sebelumnya
                    </span>
                @endif

                <span class="px-2 py-1 text-slate-500 text-[11px]">
                    Halaman {{ $suratMasuk->currentPage() }} dari {{ $suratMasuk->lastPage() }}
                </span>

                @if ($suratMasuk->nextPageUrl())
                    <a href="{{ $suratMasuk->nextPageUrl() }}"
                       class="inline-flex items-center gap-1 px-2.5 py-1 rounded-md border border-slate-300 bg-white hover:bg-slate-50 text-slate-700 font-medium transition shadow-2xs">
                        Berikutnya
                    </a>
                @else
                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-md border border-slate-200 bg-slate-100 text-slate-400 font-medium cursor-not-allowed">
                        Berikutnya
                    </span>
                @endif
            </div>
        </div>
    </div>
@endsection
