<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use App\Models\Pertanyaan;
use App\Models\PertanyaanGambar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class PertanyaanController extends Controller
{
    public function search(Request $request)
    {
        $mapel = Mapel::all();

        if (!$request->getQueryString()) {
            return view('search', compact('mapel'));
        }

        $pertanyaan = Pertanyaan::query()
            ->with('user', 'mapel')
            ->withCount('jawaban');

        $judul = $request->query('judul');
        $kelas = $request->query('kelas');
        $mapel_query = $request->query('mapel');

        if ($judul) {
            $pertanyaan->where('judul', 'LIKE', "%{$judul}%");
        }

        if ($kelas) {
            $pertanyaan->where('kelas', $kelas);
        }

        if ($mapel_query) {
            $pertanyaan->whereHas('mapel', function ($m) use ($mapel_query) {
                $m->where('mapel', $mapel_query);
            });
        }

        $pertanyaan = $pertanyaan->get();
        return view('search', compact('pertanyaan', 'mapel'));
    }

    public function mapel()
    {
        $mapel = Mapel::withCount('pertanyaan')->get();
        return view('mapel', compact('mapel'));
    }

    public function show($id)
    {
        $pertanyaan = Pertanyaan::with('user', 'mapel', 'jawaban')->find($id);
        return view('pertanyaan.show', compact('pertanyaan'));
    }

    public function create()
    {
        $mapel = Mapel::all();
        return view('pertanyaan.create', compact('mapel'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'judul' => 'required|max:150',
            'kelas' => 'required|in:1,2,3,4,5,6',
            'mapel_id' => 'required|exists:mapel,id',
            'isi' => '',
            'gambar[]' => 'image|max:2048'
        ]);

        $data['user_id'] = Auth::id();

        $pertanyaan = Pertanyaan::create($data);

        $gambar = $request->file('gambar', []);

        foreach ($gambar as $g) {
            $namafile = $g->store(Auth::id(), 'public');

            PertanyaanGambar::create([
                'pertanyaan_id' => $pertanyaan->id,
                'path' => $namafile,
            ]);
        }

        Session::flash('success', 'berhasil bertanya');
        return redirect()->route('pertanyaan.show', $pertanyaan->id);
    }

    public function edit($id)
    {
        $mapel = Mapel::all();
        $pertanyaan = Pertanyaan::with('mapel', 'gambar')->findOrFail($id);

        if ($pertanyaan->user_id != Auth::id() && !Auth::user()->admin) {
            return abort(403);
        }

        return view('pertanyaan.edit', compact('mapel', 'pertanyaan'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'judul' => 'required|max:150',
            'kelas' => 'required|in:1,2,3,4,5,6',
            'mapel_id' => 'required|exists:mapel,id',
            'isi' => '',
            'gambar[]' => 'image|max:2048',
        ]);

        $pertanyaan = Pertanyaan::findOrFail($id);

        if ($pertanyaan->user_id != Auth::id() && !Auth::user()->admin) {
            return abort(403);
        }

        $pertanyaan->update($data);

        $gambar_dihapus = $request->get("gambar_dihapus", []);

        foreach ($gambar_dihapus as $path) {
            Storage::disk('public')->delete($path);
            PertanyaanGambar::where('path', $path)->delete();
        }

        $files = $request->file('gambar') ?? [];

        foreach ($files as $file) {
            $namafile = $file->store($pertanyaan->user_id, 'public');

            PertanyaanGambar::create([
                'pertanyaan_id' => $pertanyaan->id,
                'path' => $namafile,
            ]);
        }

        Session::flash('success', 'berhasil update pertanyaan');
        return back();
    }

    public function destroy($id)
    {
        $pertanyaan = Pertanyaan::findOrFail($id);

        if ($pertanyaan->user_id != Auth::id() && !Auth::user()->admin) {
            return abort(403);
        }

        $gambar = $pertanyaan->gambar;
        $pertanyaan->delete();

        foreach ($gambar as $g) {
            Storage::disk('public')->delete($g->path ?? '');
        }

        Session::flash('success', 'pertanyaan berhasil dihapus');
        return back();
    }
}
