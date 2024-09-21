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
        Schema::table('pengajuans', function (Blueprint $table) {
            $table->unsignedBigInteger('id_penyelia')->nullable(); 
            $table->foreign('id_penyelia')->references('id')->on('profil_penyelia'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengajuans', function (Blueprint $table) {
            $table->dropForeign(['id_penyelia']);
            $table->dropColumn('id_penyelia');
        });
    }
};
