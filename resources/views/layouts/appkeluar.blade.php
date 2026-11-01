<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
</head>
<body>
    <header>
        <h2>Sistem informasi suarat</h2>
        <nav>
            <a href="{{ route('dashboard') }}">Dashboard</a>
            <a href="{{ route('surat-masuk.index') }}">Surat Masuk</a>
            <a href="{{ route('surat-keluar.index') }}">Surat keluar</a>
        </nav>
    </header>
    <main>
        @yield('content')
    </main>
    <footer>
        <p>Sistem informasi surat keluar</p>
    </footer>
</body>
</html>