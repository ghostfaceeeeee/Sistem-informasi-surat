<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OutgoingLetter;

class SuratKeluarController extends Controller
{
    public function index()
    {
        $suratKeluar = OutgoingLetter::orderBy('id', 'desc')->get();
        return view('surat-keluar.index', compact('suratKeluar'));
    }

    public function create()
    {
        return view('surat-keluar.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nomor_surat' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'penerima' => 'required|string|max:255',
            'perihal' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);
        OutgoingLetter::create($validated);
        return redirect()->route('surat-keluar.index')
            ->with('success', 'Surat berhasil ditambahkan.');
    }

    public function show($id)
    {
        $surat = OutgoingLetter::findOrFail($id);
        return view('surat-keluar.show', compact('surat'));
    }

    public function edit($id)
    {
        $surat = OutgoingLetter::findOrFail($id);
        return view('surat-keluar.edit', compact('surat'));
    }

    public function update(Request $request, $id)
    {
        $surat = OutgoingLetter::findOrFail($id);
        $validated = $request->validate([
            'nomor_surat' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'penerima' => 'required|string|max:255',
            'perihal' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);
        $surat->update($validated);
        return redirect()->route('surat-keluar.index')
            ->with('success', 'Surat berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $surat = OutgoingLetter::findOrFail($id);
        $surat->delete();
        return redirect()->route('surat-keluar.index')
            ->with('success', 'Surat berhasil dihapus.');
    }
}