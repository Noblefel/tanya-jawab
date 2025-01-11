@extends('layout.admin')

@section('content')
<h1>Tambah pertanyaan</h1>

<form
    method="post"
    action="/admin/pertanyaan"
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
        <label>Judul</label>
        <div class="input-container">
            <i class="material-symbols-outlined">edit</i>
            <input
                type="text"
                name="judul"
                value="{{ old('judul') }}"
                placeholder="Masukan judul pertanyaan" />
        </div>

        <label>Mapel</label>
        <select name="mapel_id">
            <option value="#">---</option>
            @foreach($mapel as $m)
            <option value="{{ $m->id }}">{{ $m->mapel }}</option>
            @endforeach
        </select>

        <label>Kelas</label>
        <select name="kelas">
            <option value="#">---</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
        </select>

    </div>
    <div>
        <label>Isi</label>
        <textarea
            name="isi"
            placeholder="Masukan keterangan/detail pertanyaan"></textarea>
    </div>
    <div style="grid-column: span 2;">
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
    </div>

    <div>
        <button>Simpan</button>
    </div>
</form>

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