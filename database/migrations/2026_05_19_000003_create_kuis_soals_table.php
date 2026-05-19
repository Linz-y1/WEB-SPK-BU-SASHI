<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kuis_soals', function (Blueprint $table) {
            $table->id();
            $table->text('pertanyaan');
            $table->json('pilihan');
            $table->json('jawaban_map');
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kuis_soals');
    }
};
