@extends('layout.admin')

@section('content')
<h1>Data jawaban</h1>

<div class="table-wrapper">
    <table>
        <thead>
            <th>Id</th>
            <th>Jawaban</th>
            <th>Pertanyaan</th>
            <th>User</th>
            <th>Dibuat pada</th>
            <th>Aksi</th>
        </thead>
        <tbody>
            @foreach($jawaban as $j)
            <tr>
                <td>{{ $j->id }}</td>
                <td>{{ $j->jawaban }}</td>
                <td>
                    <a href="{{ route('pertanyaan.show', $j->pertanyaan_id) }}">
                        {{ $j->pertanyaan->judul }}
                    </a>
                </td>
                <td>
                    <a href="{{ route('user.show', $j->user_id) }}">
                        {{ $j->user->nama }}
                    </a>
                </td>
                <td>{{ $j->created_at->toDateString() }}</td>
                <td>
                    <div class="aksi">
                        <a href="{{ route('admin.jawaban.edit', $j->id) }}">
                            <i class="material-symbols-outlined">
                                edit
                            </i>
                        </a>
                        <form
                            class="delete"
                            method="post"
                            action="{{ route('admin.jawaban.destroy', $j->id) }}"
                            onsubmit="return confirm('yakin?')">
                            @method('DELETE')
                            @csrf
                            <button style="color: firebrick">
                                <i class="material-symbols-outlined"> delete </i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection