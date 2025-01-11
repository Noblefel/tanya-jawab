<?php

namespace App\Http\Controllers;

use App\Models\Jawaban;
use App\Models\Pertanyaan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function show($id)
    {
        $user = User::withCount('jawaban')
            ->findOrFail($id);

        $pertanyaan = Pertanyaan::with('mapel', 'user')
            ->withCount("jawaban")
            ->where('user_id', $id)
            ->orderBy('id', 'DESC')
            ->get();

        return view('user.show', compact('user', 'pertanyaan'));
    }

    public function jawaban($id)
    {
        $user = User::withCount('pertanyaan')
            ->findOrFail($id);

        $jawaban = Jawaban::with('user')
            ->where("user_id", $user->id)
            ->orderBy('id', 'DESC')
            ->get();

        return view('user.jawaban', compact('user', 'jawaban'));
    }

    public function edit($id)
    {
        if ($id != Auth::id() && !Auth::user()->admin) {
            return abort(403);
        }

        $user = User::findOrFail($id);
        return view('user.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'nama' => 'required|max:50',
            'avatar' => 'image|max:2048'
        ]);

        if ($id != Auth::id() && !Auth::user()->admin) {
            return abort(403);
        }

        $user = User::findOrFail($id);

        if ($request->file('avatar')) {
            $data['avatar'] = $request->file('avatar')->store($id, 'public');
            Storage::disk('public')->delete($user->avatar ?? '');
        }

        $user->update($data);
        Session::flash('success', 'Berhasil edit data profil');
        return redirect()->route('user.show', $id);
    }

    public function destroy($id)
    {
        if ($id != Auth::id() && !Auth::user()->admin) {
            return abort(403);
        }

        $user = User::findOrFail($id);
        $user->delete();
        Storage::disk('public')->deleteDirectory($id);
        Session::flash('success', 'Akun telah dihapus');
        return redirect('/');
    }
}
