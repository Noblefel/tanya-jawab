@extends('layout.admin')

@section('content')
<h1>Data pengguna</h1>

<a href="/admin/users/create" class="button flex">
    <span>Tambah user</span>
    <i class="material-symbols-outlined">add_circle</i>
</a>

<div class="table-wrapper">
    <table>
        <thead>
            <th>id</th>
            <th>Avatar</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Role</th>
            <th>Bergabung pada</th>
            <th>Aksi</th>
        </thead>
        <tbody>
            @foreach($user as $u)
            <tr>
                <td>{{ $u->id }}</td>
                <td>
                    @if ($u->avatar)
                    <img src="{{ asset('/storage/' . $u->avatar) }}" height="40px" width="40px">
                    @else
                    <img src="{{ $u->default_avatar() }}" height="40px" width="40px">
                    @endif
                </td>
                <td>
                    <a href="{{ route('user.show', $u->id) }}">
                        {{ $u->nama }}
                    </a>
                </td>
                <td>{{ $u->email }}</td>
                <td>
                    @if($u->admin)
                    <div class="role" style="background-color: var(--primer); color: white"> Admin </div>
                    @else
                    <div class="role"> User </div>
                    @endif
                </td>
                <td>{{ $u->created_at->toDateString() }}</td>
                <td>
                    <div class="aksi">
                        <a href="{{ route('admin.users.edit', $u->id) }}">
                            <i class="material-symbols-outlined">
                                edit
                            </i>
                        </a>
                        <form
                            class="delete"
                            method="post"
                            action="{{ route('admin.users.destroy', $u->id) }}"
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