
@extends('layouts.appkeluar')

@section('content')
    <h1>Data Surat Keluar</h1>

    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Nomor Surat</th>
                <th>Tanggal</th>
                <th>Pengirim</th>
                <th>Perihal</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($suratKeluar as $surat)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $surat->nomor_surat }}</td>
                    <td>{{ $surat->tanggal }}</td>
                    <td>{{ $surat->pengirim }}</td>
                    <td>{{ $surat->perihal }}</td>
                    <td>
                        <a href="{{ route('surat-keluar.show', $surat->id) }}">
                            Detail Surat
                        </a>
                    </td>
                </tr>
                @empty
                <tr>    
                     <td>Belum ada data surat masuk</td>
                </tr>
            @endforelse
                <tr>
                    <td colspan="6">Belum ada data surat keluar</td>
                </tr>
        </tbody>
    </table>
@endsection
