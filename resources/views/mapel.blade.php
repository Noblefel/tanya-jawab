@extends('layout.app')

@section('head')
<link rel="stylesheet" href="{{ url('css/mapel.css') }}">
@endsection

@section('content')

<h1>
    <span style="color: var(--primer)">Mata </span>
    <span style="color: var(--sekunder)">Pelajaran </span> 📓
</h1>

<div class="mapel">
    @foreach ($mapel as $m)
    <a class="flex" href="/pertanyaan/search?mapel={{$m->mapel}}">
        <img src="{{ asset('/storage/' . $m->gambar) }}" alt="ikon mata pelajaran {{$m->mapel}}" />
        <b>{{ $m->mapel }}</b>
        <span>{{ $m->pertanyaan_count }} pertanyaan</span>
    </a>
    @endforeach
</div>
@endsection