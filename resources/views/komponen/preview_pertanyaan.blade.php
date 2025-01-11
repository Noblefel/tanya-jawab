<article class="preview">
    <div class="tags flex">
        <span>{{ $pertanyaan?->mapel?->mapel }}</span>
        <span>Kelas {{ $pertanyaan->kelas }}</span>
        @if (!count($pertanyaan->jawaban))
        <span>Belum dijawab</span>
        @endif
        <span>+5 poin</span>
    </div>

    @if (count($pertanyaan->gambar) > 0)
    <img
        src="{{ asset('/storage/' . $pertanyaan->gambar[0]->path) }}"
        alt="gambar pertanyaan"
        class="pertanyaan" />
    @endif

    <a href="{{ route('pertanyaan.show', $pertanyaan->id) }}">
        <p>{{ $pertanyaan->judul }}</p>
    </a>
    <div class="bottom flex">
        <div class="profil flex">
            @if ($pertanyaan->user->avatar)
            <img src="{{ asset('/storage/' . $pertanyaan->user->avatar) }}" alt="avatar">
            @else
            <img src="{{ $pertanyaan->user->default_avatar() }}" alt="avatar">
            @endif
            <div>
                <a href="{{ route('user.show', $pertanyaan->user_id) }}">
                    {{ $pertanyaan->user->nama }}
                </a>
                <p>
                    <span>{{ $pertanyaan->created_at->toDateString() }} | </span>
                    <span>{{ $pertanyaan->created_at->diffForHumans() }}</span>
                </p>
            </div>
        </div>

        <div class="statistik flex">
            <div class="flex">
                <i class="material-symbols-outlined">thumb_up</i>
                0
            </div>
            <div class="flex">
                <i class="material-symbols-outlined">forum</i>
                <span>{{$pertanyaan->jawaban_count }}</span>
            </div>
            <div class="flex">
                <i class="material-symbols-outlined">bookmark</i>
            </div>

            @if ($pertanyaan->user_id == Auth::id() || Auth::user()?->admin)
            <a class="flex" href="{{ route('pertanyaan.edit', $pertanyaan->id) }}">
                <i class="material-symbols-outlined">edit</i>
            </a>

            <form
                class="delete"
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
    </div>
</article>