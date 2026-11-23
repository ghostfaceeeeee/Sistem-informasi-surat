@extends('layouts.app')
@section('title', 'Detail Surat Masuk')

@section('content')
    <div class="max-w-xl mx-auto">
        {{-- Header & Nav --}}
        <div class="flex items-center justify-between mb-4">
            <div>
                <a href="{{ route('surat-masuk.index') }}" class="text-xs text-slate-400 hover:text-slate-600">&larr; Kembali ke Surat Masuk</a>
                <h1 class="text-lg font-bold text-slate-800 mt-1">Detail Surat Masuk</h1>
            </div>
            <div class="flex items-center gap-1.5">
                @can('manage-letters')
                <a href="{{ route('surat-masuk.edit', $surat->id) }}"
                   class="rounded-lg bg-amber-500 hover:bg-amber-600 px-3 py-1.5 text-xs font-semibold text-white shadow-xs transition active:scale-95">
                    Edit Surat
                </a>
                @endcan
            </div>
        </div>

        {{-- Detail Card --}}
        <div class="rounded-xl border border-slate-200/80 bg-white shadow-xs overflow-hidden">
            <div class="bg-slate-50/70 border-b border-slate-100 px-5 py-3">
                <span class="text-[11px] font-semibold uppercase tracking-wider text-emerald-600">Arsip Surat Masuk</span>
                <h2 class="text-base font-bold text-slate-900 mt-0.5">{{ $surat->nomor_surat }}</h2>
            </div>
            <div class="p-5 divide-y divide-slate-100 text-xs">
                <div class="py-2.5 grid grid-cols-3">
                    <span class="text-slate-500 font-medium">Nomor Surat</span>
                    <span class="col-span-2 font-semibold text-slate-900">{{ $surat->nomor_surat }}</span>
                </div>
                <div class="py-2.5 grid grid-cols-3">
                    <span class="text-slate-500 font-medium">Tanggal</span>
                    <span class="col-span-2 text-slate-700">{{ $surat->tanggal }}</span>
                </div>
                <div class="py-2.5 grid grid-cols-3">
                    <span class="text-slate-500 font-medium">Pengirim</span>
                    <span class="col-span-2 font-medium text-slate-800">{{ $surat->pengirim }}</span>
                </div>
                <div class="py-2.5 grid grid-cols-3">
                    <span class="text-slate-500 font-medium">Perihal</span>
                    <span class="col-span-2 text-slate-800">{{ $surat->perihal }}</span>
                </div>
                <div class="py-2.5 grid grid-cols-3">
                    <span class="text-slate-500 font-medium">Kategori</span>
                    <span class="col-span-2 text-slate-800 font-medium">
                        {{ $surat->category?->nama ?? 'Tanpa kategori' }}
                    </span>
                </div>
                @if ($surat->lampiran)
                <div class="py-2.5 grid grid-cols-3 items-center">
                    <span class="text-slate-500 font-medium">Lampiran</span>
                    <div class="col-span-2 flex items-center gap-2">
                        <a href="{{ asset('storage/' . $surat->lampiran) }}" target="_blank" rel="noopener"
                           class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-semibold text-blue-700 bg-blue-50 border border-blue-200 hover:bg-blue-100 transition">
                            <svg class="w-4 h-4 text-blue-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                            </svg>
                            Lihat lampiran
                        </a>
                        @can('manage-letters')
                        <form action="{{ route('surat-masuk.delete-lampiran', $surat->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus lampiran ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-semibold text-red-700 bg-red-50 border border-red-200 hover:bg-red-100 transition">
                                <svg class="w-4 h-4 text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                </svg>
                                Hapus lampiran
                            </button>
                        </form>
                        @endcan
                    </div>
                </div>
                @endif
                <div class="py-2.5 grid grid-cols-3">
                    <span class="text-slate-500 font-medium">Keterangan</span>
                    <span class="col-span-2 text-slate-700 whitespace-pre-line">{{ $surat->keterangan ?: '-' }}</span>
                </div>
            </div>
            <div class="bg-slate-50/50 border-t border-slate-100 px-5 py-2.5 flex items-center justify-between text-[11px] text-slate-400">
                <span>Dibuat: {{ $surat->created_at ? $surat->created_at->format('d/m/Y H:i') : '-' }}</span>
                <span>Diperbarui: {{ $surat->updated_at ? $surat->updated_at->format('d/m/Y H:i') : '-' }}</span>
            </div>
        </div>
    </div>
@endsection
