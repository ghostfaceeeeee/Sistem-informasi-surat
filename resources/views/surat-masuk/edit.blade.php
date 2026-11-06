@extends('layouts.app')
@section('title','Tambah Surat Masuk')
@section('content')

<h1>
    endsection Surat Masuk
</h1>
<form action="{{ route('surat-masuk.store', $surat->id) }}" method="POST">
    @csrf
    @method('PUT')
    <p>
        Nomor Surat: <br>
    <input name="nomor_surat" value="{{old('nomor_surat',$surat->nomor_surat)}}">
    @error('nomor_surat') <span style="color:red">{{ $message }}</span>
    @enderror
    </p>

    <p>
        Tanggal: <br>
        <input type="date" name="tanggal" value="{{old ('tanggal',$surat -> tanggal)}}">
         @error('tanggal') <span style="color:red">{{ $message }}</span>
    @enderror
    </p>

    <p>
        Pengirim: <br>
        <input name="pengirim" value="{{old ('pengirim',$surat->pengirim)}}">
         @error('pengirim') <span style="color:red">{{ $message }}</span>
    @enderror
    </p>

    <p>
        Perihal: <br>
        <input name="perihal" value="{{old ('perihal',$surat->perihal)}}">
         @error('perihal') <span style="color:red">{{ $message }}</span>
    @enderror
    </p>

    <p>
        kerangan: <br>
        <input name="keterangan" value="{{old ('keterangan',$surat->keterangan  )}}">
         @error('perihal') <span style="color:red">{{ $message }}</span>
    @enderror
    </p>

    <button type="submit">Simpan</button>
    <a href="{{ route('surat-masuk.index') }}">Batal</a>

</form>

@endsection