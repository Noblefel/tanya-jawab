@extends('layout.admin')

@section('content')
<h1>Edit pengguna </h1>

<form
    method="post"
    action="{{ route('admin.users.update', $user->id) }}"
    enctype="multipart/form-data">
    @method('PUT')
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
                value="{{ $user->nama }}"
                placeholder="Masukan nama pengguna" />
        </div>

        <label>Email</label>
        <div class="input-container">
            <i class="material-symbols-outlined">mail</i>
            <input
                type="email"
                name="email"
                value="{{ $user->email }}"
                placeholder="Masukan alamat email" />
        </div>

        <label>Password</label>
        <div class="input-container">
            <i class="material-symbols-outlined">key</i>
            <input
                type="password"
                placeholder="Buat password baru"
                name="password" />
        </div>

        <label>Role</label>
        <select name="admin">
            <option value="{{ $user->admin }}">
                @if($user->admin)
                Admin
                @else
                User
                @endif
            </option>
            <option value="1">Admin</option>
            <option value="0">User</option>
        </select>
    </div>

    <div>
        <label>Foto profil</label>
        <div class="upload-avatar-container">
            @if ($user->avatar)
            <img id="upload-target" src="{{ asset('/storage/' . $user->avatar) }}" />
            @else
            <img id="upload-target" src="{{ $user->default_avatar() }}" />
            @endif
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

    <div> <button>Simpan</button> </div>
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