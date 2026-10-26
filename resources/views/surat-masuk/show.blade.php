<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Surat Masuk</title>
</head>
<body>
    <h1>Detail Surat Masuk</h1>

    @if ($surat)

        <p>
            <strong>Nomor Surat:</strong>
            {{ $surat['nomor_surat']}}
        </p>

        <p>
            <strong>Tanggal:</strong>
            {{ $surat['tanggal'] }}
        </p>

        <p>
            <strong>Pengirim:</strong>
            {{ $surat['pengirim'] }}
        </p>

        <p>
            <strong>Perihal:</strong>
            {{ $surat['perihal'] }}
        </p>

    @else

        <p>Surat tidak ditemukan.</p>

    @endif

    <a href="{{ route('surat-masuk.index') }}">Kembali</a>

</body>
</html>