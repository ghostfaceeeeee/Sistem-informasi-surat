
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Sistem Informasi Surat')</title>
</head>
<body>

    <h2>Sistem Informasi Surat</h2>

    <nav>
        <a href="{{ route('dashboard') }}">Dashboard</a> |
        <a href="{{ route('surat-masuk.index') }}">Surat Masuk</a> |
        <a href="{{ route('surat-keluar.index') }}">Surat Keluar</a>
    </nav>

    <hr>

    @yield('content')

    <hr>

    <p>Sistem Informasi Surat</p>

</body>
</html>
