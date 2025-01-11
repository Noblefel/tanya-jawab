@extends('layout.admin')

@section('content')
<h1>Buat pengguna baru</h1>

<form
    method="post"
    action="/admin/users"
    enctype="multipart/form-data">
    @csrf

    @if ($errors->any())
    <div class="errors">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div>
        <label>Nama</label>
        <div class="input-container">
            <i class="material-symbols-outlined">person</i>
            <input
                type="text"
                name="nama"
                value="{{ old('nama') }}"
                placeholder="Masukan nama pengguna" />
        </div>

        <label>Email</label>
        <div class="input-container">
            <i class="material-symbols-outlined">mail</i>
            <input
                type="email"
                name="email"
                value="{{ old('email') }}"
                placeholder="Masukan alamat email" />
        </div>

        <label>Password</label>
        <div class="input-container">
            <i class="material-symbols-outlined">key</i>
            <input
                type="password"
                placeholder="Buat password"
                name="password"
                value="{{ old('password') }}" />
        </div>

        <label>Role</label>
        <select name="admin">
            <option value="#">---</option>
            <option value="1">Admin</option>
            <option value="0">User</option>
        </select>
    </div>

    <div>
        <label>Avatar</label>
        <div class="upload-avatar-container">
            <img id="upload-target" />
            <div class="upload">
                <i class="material-symbols-outlined">add_circle</i>
                <span>Ubah avatar</span>
                <input
                    type="file"
                    name="avatar"
                    accept=".JPG,.PNG" />
            </div>
        </div>
    </div>

    <div>
        <button>Simpan</button>
    </div>
</form>
<script>
    const input = document.querySelector("input[type=file]");

    input.addEventListener("change", () => {
        if (input.files.length == 0) return;

        const url = URL.createObjectURL(input.files[0]);
        document.querySelector("#upload-target").src = url;
    });
</script>
@endsection