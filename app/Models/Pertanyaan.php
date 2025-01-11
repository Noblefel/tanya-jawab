<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Pertanyaan extends Model
{
    use HasFactory;

    protected $table = "pertanyaan";

    protected $fillable = [
        'user_id',
        'judul',
        'isi',
        'kelas',
        'mapel_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function jawaban()
    {
        return $this->hasMany(Jawaban::class);
    }

    public function mapel()
    {
        return $this->belongsTo(Mapel::class);
    }

    public function gambar()
    {
        return $this->hasMany(PertanyaanGambar::class);
    }
}
