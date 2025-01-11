@extends('layout.app')

@section('head')
<link rel="stylesheet" href="{{ url('css/pertanyaan.css') }}">
@endsection

@section('content')
<div class="show">
    <h1 style="color: var(--sekunder)">Pertanyaan</h1>

    <h3>{{$pertanyaan->judul}}</h3>
    <div class="flex">
        <p class="tag"> {{ $pertanyaan?->mapel?->mapel }}</p>
        <p class="tag"> Kelas {{ $pertanyaan->kelas }}</p>
    </div>

    <p>{{ $pertanyaan->isi }}</p>

    @if (count($pertanyaan->gambar))
    <div class="gambar">
        @foreach ($pertanyaan->gambar as $g)
        <img src="{{ asset('/storage/'.$g->path) }}">
        @endforeach
    </div>
    @endif

    <div class="statistik-pertanyaan">
        <div class="flex">
            <i class="material-symbols-outlined">thumb_up</i>
            <span>15</span>
        </div>
        <div class="flex">
            <i class="material-symbols-outlined">forum</i>
            <span>{{ count($pertanyaan->jawaban) }}</span>
        </div>
        <div class="flex">
            <i class="material-symbols-outlined">bookmark</i>
        </div>
        @if ($pertanyaan->user_id == Auth::id() || Auth::user()?->admin)
        <a class="flex" href="{{ route('pertanyaan.edit', $pertanyaan->id) }}">
            <i class="material-symbols-outlined">edit</i>
        </a>

        <form
            class="flex"
            action=" {{ route('pertanyaan.destroy', $pertanyaan->id) }}"
            onsubmit="return confirm('yakin hapus?')"
            method="post">
            @method('DELETE')
            @csrf
            <button class="flex">
                <i class="material-symbols-outlined" style="color: firebrick;">
                    delete
                </i>
            </button>
        </form>
        @endif
    </div>

    <div class="profil">
        @if ($pertanyaan->user->avatar)
        <img src="{{ asset('/storage/' . $pertanyaan->user->avatar) }}"
            alt="avatar"
            width="40px"
            height="40px">
        @else
        <img src="{{ $pertanyaan->user->default_avatar() }}"
            alt="avatar"
            width="40px"
            height="40px">
        @endif
        <div>
            <a href="{{ route('user.show', $pertanyaan->user_id) }}">
                <b>{{ $pertanyaan->user->nama }}</b>
            </a>
            <p>{{ $pertanyaan->created_at->diffForHumans() }}</p>
        </div>
    </div>

    <hr />

    <form class="jawab" method="post" action="{{ route('jawab', $pertanyaan->id) }}">
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
        <textarea
            name="jawaban"
            placeholder="Masukan jawaban mu disini"></textarea>

        <button> Post Jawaban Kamu </button>
    </form>

    <p><b>{{ count($pertanyaan->jawaban) }} Jawaban</b></p>

    <div class="list-jawaban">
        @foreach($pertanyaan->jawaban as $j)
        <article class="preview-jawaban">
            <div class="statistik flex">
                <p class="terbaik">Jawaban Terbaik</p>
                <div style="flex: 1;"></div>
                <p class="bintang">⭐⭐⭐⭐⭐</p>

                @if ($pertanyaan->user_id == Auth::id() || Auth::user()?->admin)
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
                    <a href="{{ route('user.show', $j->user_id) }}">{{ $j->user->nama }}</a>
                    <p>{{ $j->created_at->diffForHumans() }}</p>
                </div>
            </div>

            <p> {{$j->jawaban}} </p>
        </article>
        @endforeach
    </div>
</div>
<br />
<br />
@endsection