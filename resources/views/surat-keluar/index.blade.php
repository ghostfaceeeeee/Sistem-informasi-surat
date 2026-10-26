@extends('layouts.app')

@section('title', 'Surat Keluar')

@section('content')

    <h1>Daftar Surat Keluar</h1>

    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Nomor Surat</th>
                <th>Tanggal</th>
                <th>Penerima</th>
                <th>Perihal</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($outgoingLetters as $surat)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $surat->no_surat }}</td>
                    <td>{{ $surat->tanggal }}</td>
                    <td>{{ $surat->penerima }}</td>
                    <td>{{ $surat->perihal }}</td>
                    <td>
                        <a href="{{ route('surat-keluar.show', $surat->id) }}">
                            Detail
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Belum ada data surat keluar.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

@endsection