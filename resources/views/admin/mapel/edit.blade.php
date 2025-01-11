@extends('layout.admin')

@section('content')
<h1>Edit mapel </h1>

<form
    method="post"
    action="{{ route('admin.mapel.update', $mapel->id) }}"
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
        <label>Nama mapel</label>
        <div class="input-container">
            <i class="material-symbols-outlined">sell</i>
            <input
                type="text"
                name="mapel"
                value="{{ $mapel->mapel }}"
                placeholder="Masukan nama mapel" />
        </div>

        <div class="upload-avatar-container">
            <img id="upload-target" src="{{ asset('/storage/' . $mapel->gambar) }}" />
            <div class="upload">
                <i class="material-symbols-outlined">add_circle</i>
                <span>Logo mapel</span>
                <input
                    type="file"
                    name="gambar"
                    accept=".JPG,.PNG" />
            </div>
        </div>

        <br>
        <button>Simpan</button>
    </div>

    <div></div>
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