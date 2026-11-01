<?php

namespace App\Http\Controllers;

use App\Models\IncomingLetter;

// use Illuminate\Http\Request;

class SuratMasukController extends Controller
{
    public function index() {
        $suratMasuk = IncomingLetter::all();
     return view('surat-masuk.index', compact('suratMasuk'));
    }
    public function show($id) {
        
     $surat = IncomingLetter::findOrFail($id);
     return view('surat-masuk.show', compact('surat'));
    }
}
