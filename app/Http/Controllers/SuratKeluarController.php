<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OutGoingLetter;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class SuratKeluarController extends Controller
{
    public function index(Request $request)
    {
        $query = OutGoingLetter::with('category');
        if ($request->filled('q')) {
            $q = $request->input('q');
            $query->where(function ($builder) use ($q) {
                $builder->where('nomor_surat', 'like', "%{$q}%")
                    ->orWhere('penerima', 'like', "%{$q}%")
                    ->orWhere('perihal', 'like', "%{$q}%");
            });
        }
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->input('category_id'));
        }
        $suratKeluar = $query->latest('id')->paginate(5)->withQueryString();
        $categories = Category::orderBy('nama')->get();
        return view('surat-keluar.index', compact('suratKeluar', 'categories'));
    }

    public function create()
    {
        $categories = Category::orderBy('nama')->get();
        return view('surat-keluar.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nomor_surat' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'penerima' => 'required|string|max:255',
            'perihal' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
            'category_id' => 'nullable|exists:categories,id',
            'lampiran' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('lampiran')) {
            $validated['lampiran'] = $request->file('lampiran')
                ->store('lampiran-surat', 'public');
        }

        OutGoingLetter::create($validated);

        return redirect()->route('surat-keluar.index')
            ->with('success', 'Surat berhasil ditambahkan.');
    }

    public function show($id)
    {
        $surat = OutGoingLetter::with('category')->findOrFail($id);
        return view('surat-keluar.show', compact('surat'));
    }

    public function edit($id)
    {
        $surat = OutGoingLetter::findOrFail($id);
        $categories = Category::orderBy('nama')->get();
        return view('surat-keluar.edit', compact('surat', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $surat = OutGoingLetter::findOrFail($id);
        $validated = $request->validate([
            'nomor_surat' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'penerima' => 'required|string|max:255',
            'perihal' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
            'category_id' => 'nullable|exists:categories,id',
            'lampiran' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('lampiran')) {
            $pathLama = $surat->lampiran;
            $validated['lampiran'] = $request->file('lampiran')
                ->store('lampiran-surat', 'public');
            $surat->update($validated);
            if ($pathLama) Storage::disk('public')->delete($pathLama);
        } else {
            unset($validated['lampiran']);
            $surat->update($validated);
        }

        return redirect()->route('surat-keluar.index')
            ->with('success', 'Surat berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $surat = OutGoingLetter::findOrFail($id);
        $path = $surat->lampiran;
        $surat->delete();
        if ($path) Storage::disk('public')->delete($path);

        return redirect()->route('surat-keluar.index')
            ->with('success', 'Surat berhasil dihapus.');
    }
}
