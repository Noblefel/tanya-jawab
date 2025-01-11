@extends('layout.app')

@section('head')
<link rel="stylesheet" href="{{ url('css/pertanyaan.css') }}">
@endsection

@section('content')
<form class="create" method="post" action="/pertanyaan" enctype="multipart/form-data">
    @csrf
    <h1>
        <span style="color: var(--primer)">Buat </span>
        <span style="color: var(--sekunder)">Pertanyaan </span> ✏️
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

    <label>Judul</label>
    <div class="input-container">
        <i class="material-symbols-outlined">edit</i>
        <input
            type="text"
            name="judul"
            autocomplete="off"
            placeholder="masukan judul pertanyaan"
            value="{{old('judul')}}" />
    </div>

    <label>Isi pertanyaan</label>
    <textarea
        type="text"
        name="isi"
        autocomplete="off"
        placeholder="Tambahkan keterangan lebih lanjut mengenai pertanyaanmu">{{old('isi')}}</textarea>

    <br />

    <div class="upload-gambar-container">
        <div class="uploader">
            <i class="material-symbols-outlined">add_circle</i>
            <span>Tambah gambar</span>
            <input type="file" multiple />
        </div>
    </div>
    <p style="text-align: center">
        klik gambar kalo tidak jadi upload
    </p>
    <br />

    <div class="grid">
        <div>
            <label>Mata Pelajaran</label>
            <select name="mapel_id">
                <option selected value="#">---</option>

                @foreach($mapel as $m)
                <option value="{{ $m->id }}">{{ $m->mapel }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label>Kelas</label>
            <select name="kelas">
                <option selected value="#">---</option>
                <option value="1">Kelas 1</option>
                <option value="2">Kelas 2</option>
                <option value="3">Kelas 3</option>
                <option value="4">Kelas 4</option>
                <option value="5">Kelas 5</option>
                <option value="6">Kelas 6</option>
            </select>
        </div>
    </div>

    <button type="submit">Buat pertanyaan</button>
</form>

<br />
<br />
<br />
<br />

<script>
    const container = document.querySelector(
        ".upload-gambar-container"
    );
    const uploader = container.querySelector(".uploader input");

    uploader.addEventListener("change", () => {
        if (!uploader.files.length) return;

        for (const file of uploader.files) {
            const item = document.createElement("div");
            item.classList.add("item");

            const img = document.createElement("img");
            img.src = URL.createObjectURL(file);

            const data = new DataTransfer();
            data.items.add(file);

            const inputf = document.createElement("input");
            inputf.type = "file";
            inputf.name = "gambar[]";
            inputf.files = data.files;

            item.appendChild(img);
            item.appendChild(inputf);
            item.onclick = () => item.remove();
            container.appendChild(item);
        }
    });
</script>
@endsection