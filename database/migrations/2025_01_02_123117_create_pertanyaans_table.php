<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pertanyaan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id");
            $table->string("judul", 150);
            $table->text("isi")->nullable();
            $table->enum("kelas", [1, 2, 3, 4, 5, 6]);
            $table->timestamps();

            $table->foreign("user_id")->references("id")->on("user")->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pertanyaan');
    }
};
