<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link
        rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,200,0,0" />
    <link rel="stylesheet" href="{{ url('css/style.css') }}">
    <link rel="stylesheet" href="{{ url('css/auth.css') }}">
</head>

<body>
    @session('success')
    <div class="toast">
        <i class="material-symbols-outlined">check_circle</i>
        <p> {{ $value }}</p>
    </div>
    @endsession

    <form class="auth" method="post" action="{{ route('login') }}">
        @csrf
        <a href="/">
            <img class="logo" src="{{ url('gambar/logo.jpg') }}" alt="logo aplikasi" />
        </a>
        <hr />

        <h2>
            <span style="color: var(--primer)">Selamat</span>
            <span style="color: var(--sekunder)"> Datang</span> 👋
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

        <label>Email</label>
        <div class="input-container">
            <i class="material-symbols-outlined">mail</i>
            <input
                type="text"
                placeholder="Masukan alamat email anda"
                name="email"
                value="{{ old('email') }}" />
        </div>

        <label>Password</label>
        <div class="input-container">
            <i class="material-symbols-outlined">key</i>
            <input
                type="password"
                placeholder="Masukan password anda"
                name="password" />
        </div>

        <p style="text-align: center">atau</p>

        <div class="google">
            <img
                src="https://cdn-icons-png.flaticon.com/256/2875/2875331.png"
                alt="logo google"
                width="30px"
                height="30px" />
            <p>Lanjut dengan google</p>
        </div>

        <div class="lupa-pw">
            <div class="flex">
                <input type="checkbox" name="ingat" />
                <p>Ingat saya</p>
            </div>

            <p>Lupa Password ?</p>
        </div>

        <br>

        <button>Login</button>

        <p class="bottom">
            Pengguna baru?
            <a href="{{ route('register') }}">Daftar</a>
        </p>
    </form>
</body>

</html>