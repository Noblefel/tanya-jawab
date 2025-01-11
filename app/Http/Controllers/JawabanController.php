<?php

namespace App\Http\Controllers;

use App\Models\Jawaban;
use App\Models\Pertanyaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class JawabanController extends Controller
{
    public function store(Request $request, $id)
    {
        $request->validate(['jawaban' => 'required']);

        if (!Pertanyaan::find($id)) {
            return abort(404);
        }

        Jawaban::create([
            'user_id' => Auth::id(),
            'pertanyaan_id' => $id,
            'jawaban' => $request->get('jawaban'),
        ]);

        Session::flash('success', 'jawaban berhasil disubmit');
        return back();
    }

    public function delete($id)
    {
        $jawaban = Jawaban::findOrFail($id);

        if ($jawaban->user_id != Auth::id() && !Auth::user()->admin) {
            return abort(403);
        }

        $jawaban->delete();
        Session::flash('success', 'jawaban berhasil dihapus');
        return back();
    }
}
