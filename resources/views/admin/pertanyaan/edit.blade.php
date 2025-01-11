@extends('layout.admin')

@section('content')
<h1>Edit pertanyaan</h1>

<form
    method="post"
    action="{{ route('admin.pertanyaan.update', $pertanyaan->id) }}"
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
        <label>Judul</label>
        <div class="input-container">
            <i class="material-symbols-outlined">edit</i>
            <input
                type="text"
                name="judul"
                value="{{ $pertanyaan->judul }}"
                placeholder="Masukan judul pertanyaan" />
        </div>

        <label>Mapel</label>
        <select name="mapel_id">
            <option value="{{ $pertanyaan?->mapel_id }}">{{ $pertanyaan?->mapel?->mapel }}</option>
            @foreach($mapel as $m)
            <option value="{{ $m->id }}">{{ $m->mapel }}</option>
            @endforeach
        </select>

        <label>Kelas</label>
        <select name="kelas">
            <option value="{{$pertanyaan->kelas}}">{{ $pertanyaan->kelas }}</option>
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
            placeholder="Masukan keterangan/detail pertanyaan">{{ $pertanyaan->isi }}</textarea>
    </div>
    @if (count($pertanyaan->gambar))
    <div style="grid-column: span 2;">
        <label>Gambar</label>
        <div class="select-gambar-container">
            @foreach($pertanyaan->gambar as $g)
            <div class="item">
                <img src="{{ asset('/storage/' . $g->path) }}" />
                <i class="material-symbols-outlined">delete</i>
                <input type="checkbox" name="gambar_dihapus[]" value="{{ $g->path }}" />
            </div>
            @endforeach
        </div>
        <p style="text-align: center">Pilih gambar untuk dihapus</p>
    </div>
    @endif
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