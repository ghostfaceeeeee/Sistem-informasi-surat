
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Surat Keluar</title>
</head>
<body>

    <h1>Detail Surat Keluar</h1>

    <p>
        <strong>Nomor Surat:</strong>
        {{ $surat['nomor_surat'] }}
    </p>

    <p>
        <strong>Tanggal:</strong>
        {{ $surat['tanggal'] }}
    </p>

    <p>
        <strong>Tujuan:</strong>
        {{ $surat['tujuan'] }}
    </p>

    <p>
        <strong>Perihal:</strong>
        {{ $surat['perihal'] }}
    </p>

    <a href="{{ route('surat-keluar.index') }}">Kembali</a>

</body>
</html>
