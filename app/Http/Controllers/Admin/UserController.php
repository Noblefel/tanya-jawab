<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        $user = User::orderBy('id', 'DESC')->get();
        return view('admin.users.index', compact('user'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|max:50',
            'avatar' => 'image|max:2048',
            'email' => 'required|email',
            'password' => 'required|min:8',
            'admin' => 'required|in:1,0'
        ]);

        $user = User::create($data);

        if ($request->file('avatar')) {
            $avatar = $request->file('avatar')->store($user->id, 'public');
            Storage::disk('public')->delete($user->avatar ?? '');
            $user->update(['avatar' => $avatar]);
        }

        Session::flash('success', 'User berhasil disimpan');
        return redirect('/admin/users');
    }

    public function show(string $id) {}

    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'nama' => 'required|max:50',
            'avatar' => 'image|max:2048',
            'email' => 'required|email',
            'admin' => 'required|in:1,0'
        ]);

        if ($request->get("password")) {
            $data['password'] = bcrypt($request->get("password"));
        }

        $user = User::findOrFail($id);

        if ($request->file('avatar')) {
            $data['avatar'] = $request->file('avatar')->store($id, 'public');
            Storage::disk('public')->delete($user->avatar ?? '');
        }

        $user->update($data);
        Session::flash('success', 'Berhasil edit data user');
        return redirect('/admin/users');
    }

    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        Storage::disk('public')->deleteDirectory($id);
        Session::flash('success', 'Berhasil hapus user');
        return redirect('/admin/users');
    }
}
