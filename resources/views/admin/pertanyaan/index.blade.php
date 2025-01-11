@extends('layout.admin')

@section('content')
<h1>Data pertanyaan</h1>

<a href="/admin/pertanyaan/create" class="button flex">
    <span>Tambah pertanyaan</span>
    <i class="material-symbols-outlined">add_circle</i>
</a>

<div class="table-wrapper">
    <table>
        <thead>
            <th>Id</th>
            <th>Judul</th>
            <th>Mapel</th>
            <th>Kelas</th>
            <th>User</th>
            <th>Tanggal</th>
            <th>Aksi</th>
        </thead>
        <tbody>
            @foreach($pertanyaan as $p)
            <tr>
                <td>{{ $p->id }}</td>
                <td style="min-width: 225px; ">
                    <a href="{{ route('pertanyaan.show', $p->id) }}">
                        {{ $p->judul }}
                    </a>
                </td>
                <td> {{ $p?->mapel?->mapel }} </td>
                <td> {{ $p->kelas }} </td>
                <td>
                    <a href="{{ route('user.show', $p->user->id) }}">
                        {{ $p->user->nama }}
                    </a>
                </td>
                <td>{{ $p->created_at->toDateString() }}</td>
                <td>
                    <div class="aksi">
                        <a href="{{ route('admin.pertanyaan.edit', $p->id) }}">
                            <i class="material-symbols-outlined">
                                edit
                            </i>
                        </a>
                        <form
                            class="delete"
                            method="post"
                            action="{{ route('admin.pertanyaan.destroy', $p->id) }}"
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