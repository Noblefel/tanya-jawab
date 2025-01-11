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
    <link rel="stylesheet" href="{{ url('css/admin.css') }}">
    @yield("head")
</head>

<body>
    @session('success')
    <div class="toast">
        <i class="material-symbols-outlined">check_circle</i>
        <p> {{ $value }}</p>
    </div>
    @endsession

    <div class="layout">
        <nav>
            <div class="fixed">
                <a href="/admin" class="flex {{ Route::is('admin.dashboard') ? 'active' : '' }}">
                    <i class="material-symbols-outlined"> dashboard </i>
                    <span>Dashboard</span>
                </a>
                <a href="/admin/users" class="flex {{ Route::is('admin.users.*') ? 'active' : '' }}">
                    <i class="material-symbols-outlined">
                        account_circle
                    </i>
                    <span>Users</span>
                </a>
                <a href="/admin/pertanyaan" class="flex {{ Route::is('admin.pertanyaan.*') ? 'active' : '' }}">
                    <i class="material-symbols-outlined"> article </i>
                    <span>Pertanyaan</span>
                </a>
                <a href="/admin/mapel" class="flex {{ Route::is('admin.mapel.*') ? 'active' : '' }}">
                    <i class="material-symbols-outlined">sell</i>
                    <span>Mapel</span>
                </a>
                <a href="/admin/jawaban" class="flex {{ Route::is('admin.jawaban.*') ? 'active' : '' }}">
                    <i class="material-symbols-outlined"> forum </i>
                    <span>Jawaban</span>
                </a>

                <div class="space"></div>

                <div class="bottom">
                    <a href="/" class="flex">
                        <i class="material-symbols-outlined">cottage</i>
                        <span>Kembali ke aplikasi</span>
                    </a>
                    <a href="/logout" class="flex">
                        <i class="material-symbols-outlined">logout</i>
                        <span>Logout</span>
                    </a>
                </div>
            </div>
        </nav>

        <main>
            @yield('content')
        </main>
    </div>
</body>

</html>