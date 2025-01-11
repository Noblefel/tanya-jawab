<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link
        rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,200,0,0" />
    <link rel="stylesheet" href="{{ url('css/style.css') }}">
    <link rel="stylesheet" href="{{ url('css/auth.css') }}">
</head>

<body>
    <form class="auth" method="post" action="/register">
        @csrf
        <a href="/">
            <img class="logo" src="{{ url('gambar/logo.jpg') }}" alt="logo aplikasi" />
        </a>
        <hr />

        <h2>
            <span style="color: var(--primer)">Mulai dari</span>
            <span style="color: var(--sekunder)"> sini</span> 👋
        </h2>

        @if ($errors->any())
        <div class="errors">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <label>Nama</label>
        <div class="input-container">
            <i class="material-symbols-outlined">person</i>
            <input
                type="text"
                placeholder="Masukan nama anda"
                name="nama"
                value="{{ old('nama') }}" />
        </div>

        <label>Email</label>
        <div class="input-container">
            <i class="material-symbols-outlined">mail</i>
            <input
                type="email"
                placeholder="Masukan alamat email anda"
                name="email"
                value="{{ old('email') }}" />
        </div>

        <label>Password</label>
        <div class="input-container">
            <i class="material-symbols-outlined">key</i>
            <input type="password" placeholder="Masukan password anda" name="password" />
        </div>

        <label>Ulangi password</label>
        <div class="input-container">
            <i class="material-symbols-outlined">key</i>
            <input type="password" name="password_repeat" />
        </div>

        <br>

        <button>Daftar</button>

        <p class="bottom">
            Sudah daftar?
            <a href="{{ route('login') }}">Login</a>
        </p>
    </form>
</body>

</html>