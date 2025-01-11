@extends('layout.admin')

@section('content')
<h1>Data mata pelajaran</h1>

<a href="/admin/mapel/create" class="button flex">
    <span>Tambah mapel</span>
    <i class="material-symbols-outlined">add_circle</i>
</a>

<div class="table-wrapper">
    <table>
        <thead>
            <th>id</th>
            <th>Gambar</th>
            <th>Nama mapel</th>
            <th>Jumlah pertanyaan</th>
            <th>Dibuat pada</th>
            <th>Aksi</th>
        </thead>
        <tbody>
            @foreach($mapel as $m)
            <tr>
                <td>{{ $m->id }}</td>
                <td>
                    <img src="{{ asset('/storage/' . $m->gambar) }}" class="mapel">
                </td>
                <td>{{ $m->mapel }}</td>
                <td>{{ $m->pertanyaan_count }}</td>
                <td>{{ $m->created_at->toDateString() }}</td>
                <td>
                    <div class="aksi">
                        <a href="{{ route('admin.mapel.edit', $m->id) }}">
                            <i class="material-symbols-outlined">
                                edit
                            </i>
                        </a>
                        <form
                            class="delete"
                            method="post"
                            action="{{ route('admin.mapel.destroy', $m->id) }}"
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