<?php

namespace App\Http\Controllers;


// use OuterIterator;

// use Illuminate\Http\Request;
use App\Models\OutgoingLetter;

class SuratKeluarController extends Controller
{
     public function index() {
        $suratKeluar = OutgoingLetter::all();
     return view('surat-keluar.index', compact('suratKeluar'));
    }
    public function show($id) {
     //return 'Detail Surat Masuk dengan ID'. $id ; 
     $surat = OutgoingLetter::findOrFail($id);
     return view('surat-keluar.show', compact('surat'));
    }
}
