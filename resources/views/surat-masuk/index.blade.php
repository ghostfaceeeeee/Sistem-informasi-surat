@extends('layouts.app')
@section('title', 'halaman surat masuk')
    <h1>halaman surat</h1>

@section('content')
    
<h1>Daftar Surat Masuk </h1>
<a href="{{ route('surat-masuk.create') }}">+Tambah Surat Masuk</a>
<!-- @if (session('success'))
    <p style="color:green">{{(session('success')}}</p>
@endif -->


<table border="1" cellpadding="10">
    <thead>
            <tr>
                <th>No</th>
                <th>Nomer Surat</th>
                <th>Tanggal</th>
                <th>Pengirim</th>
                <th>Perihal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($suratMasuk as $surat)
            <tr>
               <td>{{ $loop->iteration }}</td>
               <td>{{ $surat->nomor_surat }}</td>
               <td>{{ $surat->tanggal }}</td>
               <td>{{ $surat->pengirim }}</td>
               <td>{{ $surat->perihal }}</td>
               <td>
                   <a href="{{ route('surat-masuk.show', $surat['id']) }}"> 
                       Detail </a>
                    
                       <a href="{{ route('surat-masuk.edit', $surat['id']) }}"> 
                       Edit </a>

                     <form action ="{{ route('surat-masuk.destory', $surat['id']) }}
                     "method="POST" style="display: inline"> 
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Hapus surat ini?')">Hapus</button>
                    </a>
                    
                    </td>
                </tr>
                @empty
                <tr>
                    <td>Belum ada data surat masuk</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        
@endsection