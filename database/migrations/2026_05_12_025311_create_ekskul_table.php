<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ekskuls', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('slug')->unique();
            $table->string('icon');
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });

        // Pivot table siswa <-> ekskul pilihan
        Schema::create('siswa_ekskul', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained('siswas')->onDelete('cascade');
            $table->foreignId('ekskul_id')->constrained('ekskuls')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('siswa_ekskul');
        Schema::dropIfExists('ekskuls');
    }
};
