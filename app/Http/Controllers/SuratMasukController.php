<?php
namespace App\Http\Controllers;

use App\Models\IncomingLetter;
use Illuminate\Http\Request;
use App\Models\incomingLetter as ModelsIncomingLetter;
// use GuzzleHttp\Psr7\Request;

use function PHPUnit\Framework\returnArgument;

// use Illuminate\Http\Request;

class SuratMasukController extends Controller
{
    public function index() {
        $suratMasuk = IncomingLetter::orderBy('id', 'desc')->get();
     return view('surat-masuk.index', compact('suratMasuk'));
    }

    public function create(){
        return view('surat-masuk.create');
    }

public function store(Request $request){
    $validated = $request->validate([
        'nomor_surat' => 'required|string|max:255',
        'tanggal'     => 'required|date',
        'pengirim'    => 'required|string|max:255',
        'perihal'     => 'required|string|max:255',
        'keterangan'  => 'nullable|string',

    ]);
    ModelsIncomingLetter::create($validated);
    return redirect()->route('surat-masuk.index')
        ->with('success','Surat berhasil ditambah.');
}

    public function show($id) {
        
     $surat = IncomingLetter::findOrFail($id);
     return view('surat-masuk.show', compact('surat'));
    }
    public function edit($id){
        $surat = IncomingLetter::findOrFail($id);
        return view('surat-masuk.edit',compact('surat'));


    }

    public function update(Request $request,$id){
        $surat = incomingLetter::findOrFail($id);
        $validated =$request->validate([
        'nomor_surat' => 'required|string|max:255',
        'tanggal'     => 'required|date',
        'pengirim'    => 'required|string|max:255',
        'perihal'     => 'required|string|max:255',
        'keterangan'  => 'nullable|string',
        ]);
        $surat->update($validated);
        return redirect()->route('surat-masuk.index')
            ->with('success','Surat berhasil diperbaharui.');
    }
    public function destory($id){
        $surat = incomingLetter::findOrFail($id);
        $surat ->delete();
        return redirect()->route('surat-masuk.index')
            ->with('success','Surat berhasil dihapus');
    
        }
}

    