@extends('layouts.app')
@section('title', 'Tambah Surat Keluar')

@section('content')
    <div class="max-w-xl mx-auto">
        {{-- Breadcrumb & Title --}}
        <div class="mb-4">
            <div class="flex items-center gap-2 text-xs text-slate-400">
                <a href="{{ route('surat-keluar.index') }}" class="hover:text-slate-600">&larr; Kembali ke Surat Keluar</a>
            </div>
            <h1 class="text-lg font-bold text-slate-800 mt-1">Tambah Surat Keluar</h1>
            <p class="text-xs text-slate-500">Masukkan data surat keluar baru ke dalam sistem.</p>
        </div>

        {{-- Compact Form Card --}}
        <div class="rounded-xl border border-slate-200/80 bg-white p-5 shadow-xs">
            <form action="{{ route('surat-keluar.store') }}" method="POST" class="space-y-3.5">
                @csrf

                <div>
                    <label for="nomor_surat" class="block text-xs font-semibold text-slate-700 mb-1">Nomor Surat <span class="text-red-500">*</span></label>
                    <input type="text" id="nomor_surat" name="nomor_surat" value="{{ old('nomor_surat') }}" required
                           class="w-full rounded-lg border border-slate-300 px-3 py-1.5 text-xs text-slate-800 placeholder-slate-400 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 focus:outline-none"
                           placeholder="Contoh: 001/SK/FTx/2026">
                    @error('nomor_surat')
                        <p class="mt-1 text-[11px] text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label for="tanggal" class="block text-xs font-semibold text-slate-700 mb-1">Tanggal <span class="text-red-500">*</span></label>
                        <input type="date" id="tanggal" name="tanggal" value="{{ old('tanggal', date('Y-m-d')) }}" required
                               class="w-full rounded-lg border border-slate-300 px-3 py-1.5 text-xs text-slate-800 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 focus:outline-none">
                        @error('tanggal')
                            <p class="mt-1 text-[11px] text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="penerima" class="block text-xs font-semibold text-slate-700 mb-1">Penerima <span class="text-red-500">*</span></label>
                        <input type="text" id="penerima" name="penerima" value="{{ old('penerima') }}" required
                               class="w-full rounded-lg border border-slate-300 px-3 py-1.5 text-xs text-slate-800 placeholder-slate-400 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 focus:outline-none"
                               placeholder="Nama tujuan / penerima surat">
                        @error('penerima')
                            <p class="mt-1 text-[11px] text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="perihal" class="block text-xs font-semibold text-slate-700 mb-1">Perihal <span class="text-red-500">*</span></label>
                    <input type="text" id="perihal" name="perihal" value="{{ old('perihal') }}" required
                           class="w-full rounded-lg border border-slate-300 px-3 py-1.5 text-xs text-slate-800 placeholder-slate-400 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 focus:outline-none"
                           placeholder="Perihal surat keluar">
                    @error('perihal')
                        <p class="mt-1 text-[11px] text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="keterangan" class="block text-xs font-semibold text-slate-700 mb-1">Keterangan <span class="text-slate-400 font-normal">(Opsional)</span></label>
                    <textarea id="keterangan" name="keterangan" rows="3"
                              class="w-full rounded-lg border border-slate-300 px-3 py-1.5 text-xs text-slate-800 placeholder-slate-400 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 focus:outline-none resize-none"
                              placeholder="Keterangan tambahan jika ada">{{ old('keterangan') }}</textarea>
                    @error('keterangan')
                        <p class="mt-1 text-[11px] text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center gap-2 pt-2 border-t border-slate-100">
                    <button type="submit"
                            class="rounded-lg bg-blue-600 hover:bg-blue-700 px-4 py-1.5 text-xs font-semibold text-white shadow-xs transition active:scale-95">
                        Simpan Surat Keluar
                    </button>
                    <a href="{{ route('surat-keluar.index') }}"
                       class="rounded-lg border border-slate-300 bg-white hover:bg-slate-50 px-3 py-1.5 text-xs font-medium text-slate-600 transition">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
