@extends('layouts.app')
@section('title', 'halaman surat masuk show')
@section('content')
    
<body>
    <h1>Detail Surat Masuk</h1>
    @if ($surat)
    <p>
        <strong>Nomor Surat:</strong>
        {{ $surat->nomor_surat }}
        
    </p>
    <p>
        <strong>Tanggal:</strong>
        {{ $surat->tanggal }}
        
    </p>
    <p>
        <strong>Pengirim:</strong>
        {{ $surat->pengirim }}
    </p>
    <p>
        <strong>Perihal:</strong>
        {{ $surat->perihal }}
        
    </p>
    @else
    <p>surat tidak ditemukan</p>
    @endif
    <a href="{{ route('surat-masuk.index') }}">kembali</a>
    @endsection
