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
        // Schema::table('status_dosens', function (Blueprint $table) {
        //     $table->renameColumn('id_period', 'id_dsn');
        // });
        Schema::table('status_dosens', function (Blueprint $table) {
            $table->dropColumn('id_period'); // Hapus kolom lama
            $table->unsignedBigInteger('id_dsn'); // Tambahkan kolom baru dengan nama yang diinginkan
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::table('status_dosens', function (Blueprint $table) {
        //     $table->renameColumn('id_dsn','id_period');
        // });
        Schema::table('status_dosens', function (Blueprint $table) {
            $table->dropColumn('id_dsn'); // Hapus kolom baru
            $table->unsignedBigInteger('id_period'); // Tambahkan kembali kolom lama
        });
    }
};
