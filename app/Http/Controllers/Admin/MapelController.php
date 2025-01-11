<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mapel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class MapelController extends Controller
{
    public function index()
    {
        $mapel = Mapel::withCount('pertanyaan')
            ->orderBy('id', 'DESC')
            ->get();
        return view('admin.mapel.index', compact('mapel'));
    }

    public function create()
    {
        return view('admin.mapel.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'mapel' => 'required|max:50',
            'gambar' => 'required|image'
        ]);


        if ($request->file('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('mapel', 'public');
        }

        Mapel::create($data);
        Session::flash("success", "Mapel berhasil disimpan");
        return redirect('/admin/mapel');
    }

    public function show(string $id) {}

    public function edit(string $id)
    {
        $mapel = Mapel::findOrFail($id);
        return view('admin.mapel.edit', compact('mapel'));
    }

    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'mapel' => 'required|max:50',
            'gambar' => 'required|image'
        ]);

        $mapel = Mapel::findOrFail($id);

        if ($request->file('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('mapel', 'public');
            Storage::disk('public')->delete($mapel->gambar ?? '');
        }

        $mapel->update($data);
        Session::flash("success", "Berhasil update mapel");
        return redirect('/admin/mapel');
    }

    public function destroy(string $id)
    {
        Mapel::findOrFail($id)->delete();
        Session::flash("success", "Mapel berhasil dihapus");
        Storage::disk('public')->delete($mapel->gambar ?? '');
        return redirect('/admin/mapel');
    }
}
