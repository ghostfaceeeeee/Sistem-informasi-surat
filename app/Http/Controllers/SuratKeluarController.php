<?php

namespace App\Http\Controllers;

use App\Models\OutgoingLetter;
use Illuminate\Http\Request;

class SuratKeluarController extends Controller
{
    public function index()
    {
        $outgoingLetters = OutgoingLetter::all();
        return view('surat-keluar.index', compact('outgoingLetters'));
    }

    public function show($id)
    {
        $surat = OutgoingLetter::findOrFail($id);
        return view('surat-keluar.show', compact('surat'));
    }
}