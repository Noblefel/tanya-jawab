<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jawaban;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class JawabanController extends Controller
{
    public function index()
    {
        $jawaban = Jawaban::with('pertanyaan', 'user')
            ->orderBy('id', 'DESC')
            ->get();

        return view('admin.jawaban.index', compact('jawaban'));
    }

    public function create() {}
    public function store(Request $request) {}
    public function show(string $id) {}

    public function edit(string $id)
    {
        $jawaban = Jawaban::findOrFail($id);
        return view('admin.jawaban.edit', compact('jawaban'));
    }

    public function update(Request $request, string $id)
    {
        $data = $request->validate(['jawaban' => 'required']);
        $jawaban = Jawaban::findOrFail($id);
        $jawaban->update($data);
        Session::flash("success", "Berhasil update jawaban");
        return redirect('/admin/jawaban');
    }

    public function destroy(string $id)
    {
        Jawaban::findOrFail($id)->delete();
        Session::flash("success", "Jawaban berhasil dihapus");
        return back();
    }
}
