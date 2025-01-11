<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = "user";

    protected $fillable = [
        'nama',
        'avatar',
        'email',
        'password',
        'admin',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function pertanyaan()
    {
        return $this->hasMany(Pertanyaan::class);
    }

    public function jawaban()
    {
        return $this->hasMany(Jawaban::class);
    }

    public function default_avatar()
    {
        $url = "https://ui-avatars.com/api/?size=120&bold=true&color=ffffff&background=random&name=";
        return $url . $this->nama;
    }
}
