<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>

    {{-- Bootstrap 5 via CDN. Jika Bootstrap sudah di-install lewat npm / laravel/ui,
         hapus 2 baris CDN ini dan ganti dengan @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>
</head>
<body class="d-flex flex-column min-vh-100 bg-body-tertiary">

    {{-- Navbar --}}
    <nav class="navbar bg-body border-bottom">
        <div class="container">
            <a class="navbar-brand fw-semibold" href="{{ url('/') }}">{{ config('app.name', 'Laravel') }}</a>

            @if (Route::has('login'))
                <div class="d-flex gap-2">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn btn-primary btn-sm">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline-primary btn-sm">Login</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-primary btn-sm">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>
    </nav>

    {{-- Hero --}}
    <main class="flex-grow-1 d-flex align-items-center">
        <div class="container py-5">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8">
                    <h1 class="display-4 fw-bold mb-3">Selamat datang di <br>{{ config('app.name', 'Laravel') }}</h1>
                    <p class="lead text-secondary mb-4">
                        Ganti teks ini dengan deskripsi singkat aplikasi Anda: untuk siapa dan masalah apa yang diselesaikan.
                    </p>

                    @if (Route::has('login'))
                        <div class="d-flex flex-column flex-sm-row justify-content-center gap-3">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="btn btn-primary btn-lg px-5">Buka Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-primary btn-lg px-5">Login</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="btn btn-outline-secondary btn-lg px-5">Register</a>
                                @endif
                            @endauth
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </main>

    <footer class="border-top bg-body py-3">
        <div class="container small text-secondary text-center">
            &copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}
        </div>
    </footer>

</body>
</html>