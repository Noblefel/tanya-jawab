<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    use HasFactory;

    protected $table = "mapel";

    protected $fillable = ['mapel', 'gambar'];

    public function pertanyaan()
    {
        return $this->hasMany(Pertanyaan::class);
    }
}
