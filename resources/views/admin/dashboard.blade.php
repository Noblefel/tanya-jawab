@extends('layout.admin')

@section('content')
<div class="dashboard">
    <h1>Dashboard</h1>
    <p>Selamat datang di panel admin 👋</p>
    <br />

    <div class="statistik">
        <article>
            <i class="material-symbols-outlined">account_circle</i>
            <div>
                <b>{{ $total_user }}</b>
                <span>Total user</span>
            </div>
        </article>
        <article>
            <i class="material-symbols-outlined">sell</i>
            <div>
                <b>{{ $total_mapel }}</b>
                <span>Total mapel</span>
            </div>
        </article>
        <article>
            <i class="material-symbols-outlined">article</i>
            <div>
                <b>{{ $total_pertanyaan }}</b>
                <span>Total pertanyaan</span>
            </div>
        </article>
        <article>
            <i class="material-symbols-outlined">forum</i>
            <div>
                <b>{{ $total_jawaban }}</b>
                <span>Total jawaban</span>
            </div>
        </article>
    </div>
</div>
@endsection