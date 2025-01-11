<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jawaban;
use App\Models\Mapel;
use App\Models\Pertanyaan;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $total_user = User::count();
        $total_mapel = Mapel::count();
        $total_pertanyaan = Pertanyaan::count();
        $total_jawaban = Jawaban::count();

        return view('admin.dashboard', compact(
            'total_user',
            'total_mapel',
            'total_pertanyaan',
            'total_jawaban',
        ));
    }
}
