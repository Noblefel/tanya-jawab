<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pertanyaan_gambar', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("pertanyaan_id");
            $table->string("path");

            $table->foreign("pertanyaan_id")->references("id")->on("pertanyaan")->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pertanyaan_gambar');
    }
};
