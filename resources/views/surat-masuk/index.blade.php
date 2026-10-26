@extends('layouts.app')

@section('title', 'Surat Masuk')

@section('content')

    <h1>Daftar Surat Masuk</h1>

    <table border="1" cellpadding="8" cellspacing="0">
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
            @forelse ($suratMasuk as $surat)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $surat['nomor_surat'] }}</td>
                    <td>{{ $surat['tanggal'] }}</td>
                    <td>{{ $surat['pengirim'] }}</td>
                    <td>{{ $surat['perihal'] }}</td>
                    <td>
                        <a href="{{ route('surat-masuk.show', $surat['id']) }}">
                            Detail
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Belum ada data surat masuk.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

@endsection