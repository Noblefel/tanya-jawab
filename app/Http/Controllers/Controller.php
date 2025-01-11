<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use App\Models\Pertanyaan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function index()
    {
        $mapel_populer = Mapel::withCount('pertanyaan')
            ->orderBy('pertanyaan_count', 'DESC')
            ->limit(2)
            ->get();

        $trending = Pertanyaan::with(['user', 'mapel', 'gambar'])
            ->withCount('jawaban')
            ->where('created_at', '>', Carbon::now()->subWeek())
            ->orderBy('jawaban_count', 'DESC')
            ->limit(3)
            ->get();

        $terbaru = Pertanyaan::with(['user', 'mapel', 'gambar'])
            ->withCount('jawaban')
            ->orderBy('created_at', 'DESC')
            ->limit(3)
            ->get();

        return view('index', compact('mapel_populer', 'trending', 'terbaru'));
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!Auth::attempt($data, $request->get("ingat"))) {
            return redirect()->back()->withErrors('Email atau password salah');
        }

        if (Auth::user()->admin) {
            return redirect("/admin");
        }

        return redirect('/');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|max:50',
            'email' => 'required|email|unique:user',
            'password' => 'required|min:8',
        ]);

        $data['password'] = bcrypt($data['password']);

        User::create($data);
        Session::flash('success', 'berhasil daftar, silahkan login');
        return redirect('/login');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
