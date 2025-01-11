@extends('layout.app')

@section('head')
<link rel="stylesheet" href="{{ url('css/profil.css') }}">
@endsection

@section('content')
<form
    class="edit"
    method="post"
    action="{{ route('user.update', $user->id) }}"
    enctype="multipart/form-data">
    @method('PUT')
    @csrf

    <h1>
        <span style="color: var(--primer)">Edit </span>
        <span style="color: var(--sekunder)">Profil </span> ✏️
    </h1>

    @if ($errors->any())
    <div class="errors">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <label>Avatar</label>
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
    <br>

    <label>Nama</label>
    <div class="input-container">
        <i class="material-symbols-outlined">account_circle</i>
        <input
            type="text"
            name="nama"
            autocomplete="off"
            value="{{ $user->nama }}" />
    </div>
    <br>

    <button>Simpan</button>
</form>

<br>
<hr>
<br>

<form
    method="post"
    action="{{ route('user.destroy', $user->id) }}"
    onsubmit="return confirm('yakin?')">
    @method('DELETE')
    @csrf

    <button style="background-color: firebrick;">Hapus akun</button>
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