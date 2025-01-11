<?php

namespace Database\Seeders;

use App\Models\Jawaban;
use App\Models\Mapel;
use App\Models\Pertanyaan;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'nama' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt("admin@admin.com"),
            'admin' => true,
        ]);

        User::create([
            'nama' => 'Dimas',
            'email' => 'dimas@dimas.com',
            'password' => bcrypt("dimas@dimas.com"),
        ]);

        User::create([
            'nama' => 'Budi',
            'email' => 'budi@budi.com',
            'password' => bcrypt("budi@budi.com"),
        ]);

        User::create([
            'nama' => 'Ahmad',
            'email' => 'ahmad@ahmad.com',
            'password' => bcrypt("ahmad@ahmad.com"),
        ]);

        $mapel = ["Matematika", "IPS", "IPA", "Penjaskes", "Bahasa Indonesia", "Bahasa Inggris", "PKN"];

        foreach ($mapel as $m) {
            Mapel::create([
                'mapel' => $m,
                'gambar' => '/mapel/' . $m . '.PNG'
            ]);
        }

        Pertanyaan::create([
            'user_id' => 3,
            'judul' => 'Kapan Indonesia merdeka?',
            'isi' => 'Sebutkan tahun, tanggal nya',
            'kelas' => 1,
            'mapel_id' => 2,
        ]);

        Jawaban::create(['user_id' => 1, 'pertanyaan_id' => 1, 'jawaban' =>  '17 Agustus 1945']);
        Jawaban::create(['user_id' => 2, 'pertanyaan_id' => 1, 'jawaban' =>  '5 Maret 1950']);
        Jawaban::create(['user_id' => 3, 'pertanyaan_id' => 1, 'jawaban' =>  '17/07/1945']);

        Pertanyaan::create([
            'user_id' => 2,
            'judul' => 'Akar pangkat dari 144',
            'isi' => '',
            'kelas' => 3,
            'mapel_id' => 1,
        ]);

        Jawaban::create(['user_id' => 4, 'pertanyaan_id' => 2, 'jawaban' =>  '12']);
        Jawaban::create(['user_id' => 3, 'pertanyaan_id' => 2, 'jawaban' =>  '53']);

        Pertanyaan::create([
            'user_id' => 4,
            'judul' => 'Sebutkan 5 nama binatang dengan bahasa inggris',
            'isi' => 'pake bahasa inggris ya',
            'kelas' => 4,
            'mapel_id' => 6,
        ]);

        Jawaban::create(['user_id' => 4, 'pertanyaan_id' => 3, 'jawaban' =>  'cat, bird, elephant, lion, snake']);

        Pertanyaan::create([
            'user_id' => 3,
            'judul' => 'mana yg tidak termasuk unsur penting cerita fiksi',
            'isi' => 'Karakter tokoh, tema, alur, pengarang',
            'kelas' => 6,
            'mapel_id' => 5,
        ]);

        Pertanyaan::create([
            'user_id' => 1,
            'judul' => 'Gempa bumi yang akan disebabkan oleh adanya aktivitas dari gunung berapi dinamakan',
            'isi' => '',
            'kelas' => 6,
            'mapel_id' => 3,
        ]);

        Jawaban::create(['user_id' => 4, 'pertanyaan_id' => 5, 'jawaban' =>  'vulkanik']);
        Jawaban::create(['user_id' => 1, 'pertanyaan_id' => 5, 'jawaban' =>  'tektonik']);
        Jawaban::create(['user_id' => 2, 'pertanyaan_id' => 5, 'jawaban' =>  'tornado']);
        Jawaban::create(['user_id' => 3, 'pertanyaan_id' => 5, 'jawaban' =>  'erupsi']);

        Pertanyaan::create([
            'user_id' => 3,
            'judul' => 'Negara apa saja yg pernah menjajah indonesia',
            'isi' => '',
            'kelas' => 4,
            'mapel_id' => 2,
        ]);

        Jawaban::create(['user_id' => 4, 'pertanyaan_id' => 6, 'jawaban' =>  'belanda, jepang, spanyol, portugis']);
        Jawaban::create(['user_id' => 1, 'pertanyaan_id' => 6, 'jawaban' =>  'BELANDA']);
        Jawaban::create(['user_id' => 2, 'pertanyaan_id' => 6, 'jawaban' =>  'Spanyol']);

        Pertanyaan::create([
            'user_id' => 4,
            'judul' => 'Hasil dari 25 dikali 4',
            'isi' => '',
            'kelas' => 2,
            'mapel_id' => 1,
        ]);

        Jawaban::create(['user_id' => 2, 'pertanyaan_id' => 7, 'jawaban' =>  '100']);
        Jawaban::create(['user_id' => 4, 'pertanyaan_id' => 7, 'jawaban' =>  'pertanyaan macam apa ini']);

        Pertanyaan::create([
            'user_id' => 4,
            'judul' => 'Berapa jumlah 5 + 9 - 3 ',
            'isi' => 'Sebutkan tahun, tanggal nya',
            'kelas' => 1,
            'mapel_id' => 1,
        ]);

        Jawaban::create(['user_id' => 2, 'pertanyaan_id' => 8, 'jawaban' =>  '11']);
        Jawaban::create(['user_id' => 3, 'pertanyaan_id' => 8, 'jawaban' =>  '11']);
        Jawaban::create(['user_id' => 3, 'pertanyaan_id' => 8, 'jawaban' =>  '12']);
    }
}
