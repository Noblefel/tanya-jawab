<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tanya Jawab</title>
    <link
        rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,200,0,0" />
    <link rel="stylesheet" href="{{ url('css/style.css') }}">
    <link rel="stylesheet" href="{{ url('css/layout.css') }}">
    @yield("head")
</head>

<body>
    @session('success')
    <div class="toast">
        <i class="material-symbols-outlined">check_circle</i>
        <p> {{ $value }}</p>
    </div>
    @endsession

    <nav id="mobile-nav">
        <a href="/" class="{{ Route::is('home') ? 'active' : '' }}">
            <i class="material-symbols-outlined"> home </i>
        </a>
        @if(Auth::check())
        <a href="{{ route('user.show', Auth::id()) }}" class="{{ Route::is('user.*') ? 'active' : '' }}">
            <i class="material-symbols-outlined"> account_circle </i>
        </a>
        @else
        <a href="/login">
            <i class="material-symbols-outlined"> account_circle </i>
        </a>
        @endif
        <a href="/pertanyaan/create">
            <i class="material-symbols-outlined"> rate_review </i>
        </a>
        <a
            href="/pertanyaan/search"
            class="{{ Route::is('search') ? 'active' : '' }}">
            <i class="material-symbols-outlined"> search </i>
        </a>
        <a href="/mapel" class="{{ Route::is('mapel') ? 'active' : '' }}">
            <i class="material-symbols-outlined"> category </i>
        </a>
    </nav>

    <div class="layout">
        <aside class="left">
            <nav id="side-nav">
                <h3>Tanya Jawab</h3>

                <a href="/" class="flex {{ Route::is('home') ? 'active' : '' }}">
                    <i class="material-symbols-outlined">home</i>
                    Home
                </a>
                @if(Auth::check())
                <a href="{{ route('user.show', Auth::id()) }}" class="flex {{ Route::is('user.*') ? 'active' : '' }}">
                    <i class="material-symbols-outlined">account_circle</i>
                    Profil
                </a>
                @else
                <a href="/login" class="flex">
                    <i class="material-symbols-outlined">login</i>
                    Login
                </a>
                @endif
                <a href="/pertanyaan/search" class="flex {{ Route::is('search') ? 'active' : '' }}">
                    <i class="material-symbols-outlined">search</i>
                    Search
                </a>
                <a href="/mapel" class="flex {{ Route::is('mapel') ? 'active' : '' }}">
                    <i class="material-symbols-outlined">category</i>
                    Mata Pelajaran
                </a>
                @if(Auth::user()?->admin)
                <a href="/admin" class="flex">
                    <i class="material-symbols-outlined">monitor</i>
                    Dashboard Admin
                </a>
                @endif
                <a href="/pertanyaan/create" class="button flex">
                    <i class="material-symbols-outlined">rate_review</i>
                    Buat Pertanyaan
                </a>
            </nav>
        </aside>
        <main>
            @yield('content')
        </main>
        <aside class="right">
            <div class="fixed">
                @if (Auth::check())
                <div class="flex mini-profil">
                    @if (Auth::user()->avatar)
                    <img src="{{ asset('/storage/'.Auth::user()->avatar) }}" alt="avatar">
                    @else
                    <img src="{{ Auth::user()->default_avatar() }}" alt="avatar">
                    @endif

                    <a href="{{ route('user.show', Auth::id()) }}">{{ Auth::user()->nama }}</a>
                </div>
                <a href="/logout" class="button logout">Logout</a>
                @else
                <div class="flex">
                    <a href="/login" class="button">Login</a>
                    <a href="/daftar" class="button" style="background-color: var(--sekunder);">Daftar</a>
                </div>
                @endif

                <h5>Pertanyaan Trending</h5>

                <a href="/" class="pertanyaan">
                    Apa yang dimaksud dengan Lorem Ipsum Dolor Sit Amet ?
                </a>

                <a href="/" class="pertanyaan">
                    Apa yang dimaksud dengan Lorem Ipsum Dolor Sit Amet ?
                </a>

                <a href="/" class="pertanyaan">
                    Apa yang dimaksud dengan Lorem Ipsum Dolor Sit Amet ?
                </a>

                <h5>Pertanyaan Terbaru</h5>

                <a href="/" class="pertanyaan">
                    Apa yang dimaksud dengan Lorem Ipsum Dolor Sit Amet ?
                </a>

                <a href="/" class="pertanyaan">
                    Apa yang dimaksud dengan Lorem Ipsum Dolor Sit Amet ?
                </a>

                <a href="/" class="pertanyaan">
                    Apa yang dimaksud dengan Lorem Ipsum Dolor Sit Amet ?
                </a>
            </div>
        </aside>
    </div>
</body>

</html>