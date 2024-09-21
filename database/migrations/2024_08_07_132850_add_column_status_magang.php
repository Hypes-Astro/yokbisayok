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
        Schema::table('status_mahasiswas', function (Blueprint $table) {
            $table->enum('status_magang',['BELUM','PROSES','SELESAI'])->default('BELUM')->after('logbook');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('status_mahasiswas', function (Blueprint $table) {
            $table->dropColumn('status_magang');
        });
    }
};
