<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\incomingLetter;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class SuratMasukController extends Controller
{
    public function index(Request $request)
    {
        $query = incomingLetter::with('category');
        if ($request->filled('q')) {
            $q = $request->input('q');
            $query->where(function ($builder) use ($q) {
                $builder->where('nomor_surat', 'like', "%{$q}%")
                    ->orWhere('pengirim', 'like', "%{$q}%")
                    ->orWhere('perihal', 'like', "%{$q}%");
            });
        }
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->input('category_id'));
        }
        $suratMasuk = $query->latest('id')->paginate(5)->withQueryString();
        $categories = Category::orderBy('nama')->get();
        return view('surat-masuk.index', compact('suratMasuk', 'categories'));
    }

    public function create()
    {
        $categories = Category::orderBy('nama')->get();
        return view('surat-masuk.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nomor_surat' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'pengirim' => 'required|string|max:255',
            'perihal' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
            'category_id' => 'nullable|exists:categories,id',
            'lampiran' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('lampiran')) {
            $validated['lampiran'] = $request->file('lampiran')
                ->store('lampiran-surat', 'public');
        }

        incomingLetter::create($validated);

        return redirect()->route('surat-masuk.index')
            ->with('success', 'Surat berhasil ditambahkan.');
    }

    public function show($id)
    {
        $surat = incomingLetter::with('category')->findOrFail($id);
        return view('surat-masuk.show', compact('surat'));
    }

    public function edit($id)
    {
        $surat = incomingLetter::findOrFail($id);
        $categories = Category::orderBy('nama')->get();
        return view('surat-masuk.edit', compact('surat', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $surat = incomingLetter::findOrFail($id);
        $validated = $request->validate([
            'nomor_surat' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'pengirim' => 'required|string|max:255',
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

        return redirect()->route('surat-masuk.index')
            ->with('success', 'Surat berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $surat = incomingLetter::findOrFail($id);
        $path = $surat->lampiran;
        $surat->delete();
        if ($path) Storage::disk('public')->delete($path);

        return redirect()->route('surat-masuk.index')
            ->with('success', 'Surat berhasil dihapus.');
    }

    public function deleteLampiran($id)
    {
        $surat = incomingLetter::findOrFail($id);

        if ($surat->lampiran) {
            Storage::disk('public')->delete($surat->lampiran);
            $surat->update(['lampiran' => null]);
        }

        return redirect()->route('surat-masuk.edit', $surat->id)
            ->with('success', 'Lampiran berhasil dihapus.');
    }
}
