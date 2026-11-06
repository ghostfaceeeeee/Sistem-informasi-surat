@extends('layouts.app')
@section('title','Tambah Surat Masuk')
@section('content')

<h1>
    Tambah Surat Masuk
</h1>
<form action="{{ route('surat-masuk.store') }}" method="POST">
    @csrf
    <p>
        Nomor Surat:
    <input name="nomor_surat" value="{{old('nomor_surat')}}">
    @error('nomor_surat') <span style="color:red">{{ $message }}</span>
    @enderror
    </p>

    <p>
        Tanggal: <br>
        <input type="date" name="tanggal" value="{{old ('tanggal')}}">
         @error('tanggal') <span style="color:red">{{ $message }}</span>
    @enderror
    </p>

    <p>
        Pengirim: <br>
        <input name="pengirim" value="{{old ('pengirim')}}">
         @error('pengirim') <span style="color:red">{{ $message }}</span>
    @enderror
    </p>

    <p>
        Perihal: <br>
        <input name="perihal" value="{{old ('perihal')}}">
         @error('perihal') <span style="color:red">{{ $message }}</span>
    @enderror
    </p>

    <p>
        kerangan: <br>
        <input name="keterangan" value="{{old ('keterangan')}}">
         @error('ketereangan') <span style="color:red">{{ $message }}</span>
    @enderror
    </p>

    <button type="submit">Simpan</button>
    <a href="{{ route('surat-masuk.index') }}">Batal</a>

</form>

@endsection