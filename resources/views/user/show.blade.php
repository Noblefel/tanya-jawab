@extends('layout.app')

@section('head')
<link rel="stylesheet" href="{{ url('css/profil.css') }}">
@endsection

@section('content')
<div class="show">
    <h1 style="color: var(--sekunder)">Profil</h1>

    <div class="foto">
        <div class="flex">
            <p>{{ $user->created_at->toDateString() }}</p>
            <p>Tanggal Join</p>
        </div>

        @if ($user->avatar)
        <img src="{{ asset('/storage/' . $user->avatar) }}" alt="foto profil user" />
        @else
        <img src="{{ $user->default_avatar() }}" alt="foto profil user" />
        @endif

        @if ($user->id == Auth::id() || Auth::user()?->admin)
        <div class="flex">
            <a href="{{ route('user.edit', $user->id) }}" class="button">
                Edit
            </a>
        </div>
        @endif
    </div>

    <h2 style="text-align: center;">
        {{ $user->nama }}
    </h2>

    <div class="statistik-profil">
        <div>
            <p>{{ count($pertanyaan) }}</p>
            <p>Pertanyaan</p>
        </div>
        <div>
            <p>{{ $user->jawaban_count }}</p>
            <p>Jawaban</p>
        </div>
        <div>
            <p>5.0</p>
            <p>Rating</p>
        </div>
        <div>
            <p style="color: var(--sekunder)">100</p>
            <p>Poin</p>
        </div>
    </div>

    <div class="tabs">
        <a href="{{ route('user.show', $user->id) }}" class="active">Pertanyaan</a>
        <a href="{{ route('user.jawaban', $user->id) }}">Jawaban</a>
        <a>Bookmark</a>
    </div>

    @foreach($pertanyaan as $p)

    @include('komponen.preview_pertanyaan', ['pertanyaan' => $p])

    @endforeach
</div>

@endsection