 @extends("layout.app")

 @section("head")
 <link rel="stylesheet" href="{{ url('css/index.css') }}">
 @endsection

 @section("content")
 <h1>
     <span style="color: var(--primer)">Selamat </span>
     <span style="color: var(--sekunder)">Datang </span> 👋
 </h1>

 <h4>Mapel paling populer </h4>
 <div class="mapel">
     @foreach($mapel_populer as $m)
     <a class="flex">
         <img src="{{ asset('/storage/' . $m->gambar) }}" alt="icon mata pelajaran {{$m->mapel}}" />
         <b>{{ $m->mapel }}</b>
         <span>{{ $m->pertanyaan_count }}+ pertanyaan</span>
     </a>
     @endforeach
 </div>
 <br>

 <h4>Pertanyaan trending minggu ini</h4>

 @foreach($trending as $pertanyaan)
 @include('komponen.preview_pertanyaan', $pertanyaan)
 @endforeach

 <br />
 <h1>
     <span style="color: var(--primer)">Jadilah Pertama </span>
     <span style="color: var(--sekunder)">yang Menjawab </span>✍️
 </h1>
 <h4>Pertanyaan terbaru</h4>

 @foreach($terbaru as $pertanyaan)
 @include('komponen.preview_pertanyaan', $pertanyaan)
 @endforeach

 <br />
 <br />
 <br />
 <br />
 @endsection