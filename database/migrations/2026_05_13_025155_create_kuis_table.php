<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kuis_jawabans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained('siswas')->onDelete('cascade');
            $table->integer('nomor_soal');
            $table->integer('jawaban'); // index pilihan jawaban (0-3)
            $table->timestamps();
        });

        Schema::create('hasil_rekomendasis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained('siswas')->onDelete('cascade');
            $table->string('rekomendasi_ekskul'); // slug ekskul hasil
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hasil_rekomendasis');
        Schema::dropIfExists('kuis_jawabans');
    }
};
