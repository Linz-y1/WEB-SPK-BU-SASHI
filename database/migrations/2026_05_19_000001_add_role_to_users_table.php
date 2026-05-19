<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('user')->after('password');
        });

        // Add status columns to siswa_ekskul pivot (pendaftaran)
        Schema::table('siswa_ekskul', function (Blueprint $table) {
            $table->string('status')->default('pending')->after('ekskul_id');
            $table->unsignedBigInteger('approved_by')->nullable()->after('status');
            $table->timestamp('approved_at')->nullable()->after('approved_by');
        });
    }

    public function down(): void
    {
        Schema::table('siswa_ekskul', function (Blueprint $table) {
            $table->dropColumn(['status', 'approved_by', 'approved_at']);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
        });
    }
};
