<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mapel;
use App\Models\Pertanyaan;
use App\Models\PertanyaanGambar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class PertanyaanController extends Controller
{
    public function index()
    {
        $pertanyaan = Pertanyaan::with('mapel', 'user')
            ->orderBy('id', 'DESC')
            ->get();

        return view('admin.pertanyaan.index', compact('pertanyaan'));
    }

    public function create()
    {
        $mapel = Mapel::all();
        return view('admin.pertanyaan.create', compact('mapel'));
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

        Session::flash('success', 'Pertanyaan berhasil disimpan');
        return redirect('/admin/pertanyaan');
    }

    public function show(string $id) {}

    public function edit(string $id)
    {
        $mapel = Mapel::all();
        $pertanyaan = Pertanyaan::with('mapel', 'gambar')->findOrFail($id);
        return view('admin.pertanyaan.edit', compact('mapel', 'pertanyaan'));
    }

    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'judul' => 'required|max:150',
            'kelas' => 'required|in:1,2,3,4,5,6',
            'mapel_id' => 'required|exists:mapel,id',
            'isi' => '',
            'gambar[]' => 'image|max:2048',
        ]);

        $pertanyaan = Pertanyaan::findOrFail($id);
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
        return redirect('/admin/pertanyaan');
    }

    public function destroy(string $id)
    {
        $pertanyaan = Pertanyaan::findOrFail($id);
        $gambar = $pertanyaan->gambar;
        $pertanyaan->delete();

        foreach ($gambar as $g) {
            Storage::disk('public')->delete($g->path ?? '');
        }

        Session::flash('success', 'pertanyaan berhasil dihapus');
        return back();
    }
}
