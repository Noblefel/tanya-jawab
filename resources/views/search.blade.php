@extends('layout.app')

@section('head')
<link rel="stylesheet" href="{{ url('css/search.css') }}">
@endsection

@section('content')
<h1>
    <span style="color: var(--primer)">Cari </span>
    <span style="color: var(--sekunder)">Pertanyaan </span> 🔍
</h1>

<form class="search" method="get" action="/pertanyaan/search">
    <div class="input-container">
        <i class="material-symbols-outlined">search</i>
        <input
            type="text"
            name="judul"
            id="judul"
            autocomplete="off"
            placeholder="Masukan judul pertanyaan"
            value="{{ old('judul') }}" />
    </div>

    <div class="flex">
        <div>
            <label>Mata Pelajaran</label>
            <select name="mapel" id="mapel">
                <option value="">Semua mapel</option>

                @foreach($mapel as $m)
                <option value="{{ $m->mapel }}">{{ $m->mapel }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label>Kelas</label>
            <select name="kelas" id="kelas">
                <option value="">Semua Tingkat</option>
                <option value="1">Kelas 1</option>
                <option value="2">Kelas 2</option>
                <option value="3">Kelas 3</option>
                <option value="4">Kelas 4</option>
                <option value="5">Kelas 5</option>
                <option value="6">Kelas 6</option>
            </select>
        </div>
    </div>

    <button>Search</button>
</form>

@if(isset($pertanyaan))
<div class="hasil">
    <h3>Ditemukan <b>{{ count($pertanyaan) }}</b> pertanyaan:</h3>

    @foreach($pertanyaan as $p)
    @include('komponen.preview_pertanyaan', ['pertanyaan' => $p])
    @endforeach
</div>
@endif

<script>
    function set() {
        const query = new URLSearchParams(window.location.search)
        const mapel = query.get("mapel")
        const kelas = query.get("kelas")

        document.querySelector("#judul").value = query.get("judul")

        if (mapel) {
            const op = document.createElement("option")
            op.innerText = mapel
            op.selected = true
            op.value = mapel
            document.querySelector("#mapel").prepend(op)
        }

        if (kelas) {
            const op = document.createElement("option")
            op.innerText = 'Kelas ' + kelas
            op.selected = true
            op.value = kelas
            document.querySelector("#kelas").prepend(op)
        }
    }

    set()
</script>

@endsection