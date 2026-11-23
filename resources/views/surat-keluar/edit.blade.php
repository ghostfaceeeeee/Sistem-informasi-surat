@extends('layouts.app')
@section('title', 'Edit Surat Keluar')

@section('content')
    <div class="max-w-xl mx-auto">
        {{-- Breadcrumb & Title --}}
        <div class="mb-4">
            <div class="flex items-center gap-2 text-xs text-slate-400">
                <a href="{{ route('surat-keluar.index') }}" class="hover:text-slate-600">&larr; Kembali ke Surat Keluar</a>
            </div>
            <h1 class="text-lg font-bold text-slate-800 mt-1">Edit Surat Keluar</h1>
            <p class="text-xs text-slate-500">Perbarui data surat keluar: <span class="font-semibold text-slate-700">{{ $surat->nomor_surat }}</span></p>
        </div>

        {{-- Compact Form Card --}}
        <div class="rounded-xl border border-slate-200/80 bg-white p-5 shadow-xs">
            <form action="{{ route('surat-keluar.update', $surat->id) }}" method="POST" enctype="multipart/form-data" class="space-y-3.5">
                @csrf
                @method('PUT')

                <div>
                    <label for="nomor_surat" class="block text-xs font-semibold text-slate-700 mb-1">Nomor Surat <span class="text-red-500">*</span></label>
                    <input type="text" id="nomor_surat" name="nomor_surat" value="{{ old('nomor_surat', $surat->nomor_surat) }}" required
                           class="w-full rounded-lg border border-slate-300 px-3 py-1.5 text-xs text-slate-800 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 focus:outline-none">
                    @error('nomor_surat')
                        <p class="mt-1 text-[11px] text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label for="tanggal" class="block text-xs font-semibold text-slate-700 mb-1">Tanggal <span class="text-red-500">*</span></label>
                        <input type="date" id="tanggal" name="tanggal" value="{{ old('tanggal', $surat->tanggal) }}" required
                               class="w-full rounded-lg border border-slate-300 px-3 py-1.5 text-xs text-slate-800 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 focus:outline-none">
                        @error('tanggal')
                            <p class="mt-1 text-[11px] text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="penerima" class="block text-xs font-semibold text-slate-700 mb-1">Penerima <span class="text-red-500">*</span></label>
                        <input type="text" id="penerima" name="penerima" value="{{ old('penerima', $surat->penerima) }}" required
                               class="w-full rounded-lg border border-slate-300 px-3 py-1.5 text-xs text-slate-800 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 focus:outline-none">
                        @error('penerima')
                            <p class="mt-1 text-[11px] text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="perihal" class="block text-xs font-semibold text-slate-700 mb-1">Perihal <span class="text-red-500">*</span></label>
                    <input type="text" id="perihal" name="perihal" value="{{ old('perihal', $surat->perihal) }}" required
                           class="w-full rounded-lg border border-slate-300 px-3 py-1.5 text-xs text-slate-800 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 focus:outline-none">
                    @error('perihal')
                        <p class="mt-1 text-[11px] text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="category_id" class="block text-xs font-semibold text-slate-700 mb-1">Kategori <span class="text-slate-400 font-normal">(Opsional)</span></label>
                    <select id="category_id" name="category_id"
                            class="w-full rounded-lg border border-slate-300 px-3 py-1.5 text-xs text-slate-800 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 focus:outline-none">
                        <option value="">-- Tanpa kategori --</option>
                        @foreach ($categories as $kategori)
                            <option value="{{ $kategori->id }}" @selected(old('category_id', $surat->category_id ?? '') == $kategori->id)>
                                {{ $kategori->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="mt-1 text-[11px] text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="lampiran" class="block text-xs font-semibold text-slate-700 mb-1">Lampiran <span class="text-slate-400 font-normal">(PDF/JPG/PNG, maks. 2 MB)</span></label>
                    @if ($surat->lampiran)
                        <div class="mb-2 flex items-center gap-2 text-xs text-slate-600 bg-slate-50 border border-slate-200 px-2.5 py-1.5 rounded-lg">
                            <span class="text-slate-500">File saat ini:</span>
                            <a href="{{ asset('storage/' . $surat->lampiran) }}" target="_blank" rel="noopener" class="text-blue-600 font-medium hover:underline flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                                </svg>
                                Lihat lampiran
                            </a>
                        </div>
                    @endif
                    <input type="file" id="lampiran" name="lampiran" accept=".pdf,.jpg,.jpeg,.png"
                           class="w-full text-xs text-slate-700 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 border border-slate-300 rounded-lg cursor-pointer focus:outline-none">
                    <p class="mt-1 text-[11px] text-slate-400">Kosongkan jika tidak ingin mengganti file lampiran.</p>
                    @error('lampiran')
                        <p class="mt-1 text-[11px] text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="keterangan" class="block text-xs font-semibold text-slate-700 mb-1">Keterangan <span class="text-slate-400 font-normal">(Opsional)</span></label>
                    <textarea id="keterangan" name="keterangan" rows="3"
                              class="w-full rounded-lg border border-slate-300 px-3 py-1.5 text-xs text-slate-800 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 focus:outline-none resize-none">{{ old('keterangan', $surat->keterangan) }}</textarea>
                    @error('keterangan')
                        <p class="mt-1 text-[11px] text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center gap-2 pt-2 border-t border-slate-100">
                    <button type="submit"
                            class="rounded-lg bg-blue-600 hover:bg-blue-700 px-4 py-1.5 text-xs font-semibold text-white shadow-xs transition active:scale-95">
                        Simpan Perubahan
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
