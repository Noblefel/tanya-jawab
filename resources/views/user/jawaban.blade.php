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
        <img src="{{ url('/gambar/user.jpg') }}" alt="foto profil user" width="100px" />

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
            <p>{{ $user->pertanyaan_count }}</p>
            <p>Pertanyaan</p>
        </div>
        <div>
            <p>{{ count($jawaban) }}</p>
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
        <a href="{{ route('user.show', $user->id) }}">Pertanyaan</a>
        <a href="{{ route('user.jawaban', $user->id) }}" class="active">Jawaban</a>
        <a>Bookmark</a>
    </div>

    @foreach($jawaban as $j)
    <article class="preview-jawaban">
        <div class="statistik flex">
            <p class="terbaik">Jawaban Terbaik</p>
            <div style="flex: 1;"></div>
            <p class="bintang">⭐⭐⭐⭐⭐</p>

            @if ($j->user_id == Auth::id() || Auth::user()?->admin)
            <form
                class="delete"
                action=" {{ route('jawaban.delete', $j->id) }}"
                onsubmit="return confirm('yakin hapus?')"
                method="post">
                @method('DELETE')
                @csrf
                <button>
                    <i class="material-symbols-outlined" style="color: firebrick;">
                        delete
                    </i>
                </button>
            </form>
            @endif
        </div>

        <div class="profil flex">
            @if ($j->user->avatar)
            <img src="{{ asset('/storage/' . $j->user->avatar) }}" alt="avatar">
            @else
            <img src="{{ $j->user->default_avatar() }}" alt="avatar">
            @endif
            <div>
                <a>{{ $j->user->nama }}</a>
                <p>{{ $j->created_at->diffForHumans() }}</p>
            </div>
        </div>

        <p> {{$j->jawaban}} </p>
    </article>
    @endforeach
</div>
@endsection