<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('peminjaman', function (Blueprint $table) {
            $table->string('nomor_ktp', 20)->nullable()->after('alat_id');
            $table->string('nomor_kk', 20)->nullable()->after('nomor_ktp');
        });
    }

    public function down(): void
    {
        Schema::table('peminjaman', function (Blueprint $table) {
            $table->dropColumn(['nomor_ktp', 'nomor_kk']);
        });
    }
};
