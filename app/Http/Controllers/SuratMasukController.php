<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SuratMasukController extends Controller
{
    public function index(){
        $suratMasuk =
        [
        [
            "id"            => 1,
            "nomor_surat"   => "001/FT/X/2026",
            "tanggal"       =>"01-10-2026",
            "pengirim"      =>"Fakultas teknik",
            "perihal"       =>"Undangan Rapat"
        ],
        [
            "id"            => 2,
            "nomor_surat"   => "001/BAA/X/2026",
            "tanggal"       =>"02-10-2026",
            "pengirim"      =>"BAA",
            "perihal"       =>"Pemberitahuan Akademik"
        ],
        [
            "id"            => 3,
            "nomor_surat"   => "001/FT/X/2026",
            "tanggal"       =>"03-10-2026",
            "pengirim"      =>"LPPM",
            "perihal"       =>"Undangan Sosialisasi"
        ]
    ];
        return view("surat-masuk.index", compact("suratMasuk"));
    }

    public function show($id){
        //return "Detail Surat Masuk dengan ID:" .$id;
        $surat = [
        1 => [
                "id"            => 1,
                "nomor_surat"   => "001/FT/X/2026",
                "tanggal"       =>"01-10-2026",
                "pengirim"      =>"Fakultas teknik",
                "perihal"       =>"Undangan Rapat"
            ],
        2 =>[
                "id"            => 2,
                "nomor_surat"   => "001/BAA/X/2026",
                "tanggal"       =>"02-10-2026",
                "pengirim"      =>"BAA",
                "perihal"       =>"Pemberitahuan Akademik"
            ],
        3=> [
                "id"            => 3,
                "nomor_surat"   => "001/FT/X/2026",
                "tanggal"       =>"03-10-2026",
                "pengirim"      =>"LPPM",
                "perihal"       =>"Undangan Sosialisasi"
            ]
        ];
        //Ambil satu surat berdasarkan ID
        $surat = $surat[$id] ?? null;
        return view('surat-masuk.show', compact('surat'));
    }
}


//route -> tampil
