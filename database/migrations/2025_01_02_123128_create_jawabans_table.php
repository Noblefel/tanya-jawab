<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jawaban', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("pertanyaan_id");
            $table->unsignedBigInteger("user_id");
            $table->text("jawaban");
            $table->timestamps();

            $table->foreign("pertanyaan_id")->references("id")->on("pertanyaan")->cascadeOnDelete();
            $table->foreign("user_id")->references("id")->on("user")->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jawaban');
    }
};
