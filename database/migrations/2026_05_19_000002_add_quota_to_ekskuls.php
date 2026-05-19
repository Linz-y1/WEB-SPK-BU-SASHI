<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('ekskuls', function (Blueprint $table) {
            $table->unsignedInteger('quota')->default(0)->after('deskripsi');
            $table->unsignedInteger('approved_count')->default(0)->after('quota');
        });
    }

    public function down(): void
    {
        Schema::table('ekskuls', function (Blueprint $table) {
            $table->dropColumn(['quota', 'approved_count']);
        });
    }
};
