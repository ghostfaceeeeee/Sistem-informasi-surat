<?php

namespace App\Http\Controllers;

use App\Models\IncomingLetter;
use Illuminate\Http\Request;

class SuratMasukController extends Controller
{
    public function index()
    {
        $incomingLetters = IncomingLetter::all();
        return view('surat-masuk.index', compact('incomingLetters'));
    } // <-- ini yang tadi hilang

    public function show($id){
        $surat = IncomingLetter::findOrFail($id);
        return view('surat-masuk.show', compact('surat'));
    }
}