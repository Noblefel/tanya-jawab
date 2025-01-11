<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mapel', function (Blueprint $table) {
            $table->id();
            $table->string("mapel", 50)->unique();
            $table->string("gambar");
            $table->timestamps();
        });

        DB::statement('ALTER TABLE pertanyaan ADD COLUMN mapel_id BIGINT UNSIGNED;');
        DB::statement('ALTER TABLE pertanyaan ADD FOREIGN KEY(mapel_id) REFERENCES mapel(id) ON DELETE SET NULL;');
    }

    public function down(): void
    {
        Schema::dropIfExists('mapel');
    }
};
