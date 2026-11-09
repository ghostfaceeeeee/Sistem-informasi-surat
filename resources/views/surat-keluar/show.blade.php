@extends('layouts.app')
@section('title', 'Detail Surat Keluar')

@section('content')
    <div class="max-w-xl mx-auto">
        {{-- Header & Nav --}}
        <div class="flex items-center justify-between mb-4">
            <div>
                <a href="{{ route('surat-keluar.index') }}" class="text-xs text-slate-400 hover:text-slate-600">&larr; Kembali ke Surat Keluar</a>
                <h1 class="text-lg font-bold text-slate-800 mt-1">Detail Surat Keluar</h1>
            </div>
            <div class="flex items-center gap-1.5">
                <a href="{{ route('surat-keluar.edit', $surat->id) }}"
                   class="rounded-lg bg-amber-500 hover:bg-amber-600 px-3 py-1.5 text-xs font-semibold text-white shadow-xs transition active:scale-95">
                    Edit Surat
                </a>
            </div>
        </div>

        {{-- Detail Card --}}
        <div class="rounded-xl border border-slate-200/80 bg-white shadow-xs overflow-hidden">
            <div class="bg-slate-50/70 border-b border-slate-100 px-5 py-3">
                <span class="text-[11px] font-semibold uppercase tracking-wider text-blue-600">Arsip Surat Keluar</span>
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
                    <span class="text-slate-500 font-medium">Penerima</span>
                    <span class="col-span-2 font-medium text-slate-800">{{ $surat->penerima }}</span>
                </div>
                <div class="py-2.5 grid grid-cols-3">
                    <span class="text-slate-500 font-medium">Perihal</span>
                    <span class="col-span-2 text-slate-800">{{ $surat->perihal }}</span>
                </div>
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
