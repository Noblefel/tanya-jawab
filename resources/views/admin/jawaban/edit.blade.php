@extends('layout.admin')

@section('content')
<h1>Edit jawaban</h1>

<form
    method="post"
    action="{{ route('admin.jawaban.update', $jawaban->id) }}">
    @method('PUT')
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

    <div style="grid-column: span 2;">
        <label>Isi jawaban</label>
        <textarea name="jawaban">{{$jawaban->jawaban}}</textarea>
        <br>
        <br>

        <button>Simpan</button>
    </div>
</form>
@endsection