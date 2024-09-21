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
        Schema::create('profil_penyelia', function (Blueprint $table) {
            $table->id();
            // alif
            $table->string(column: 'id_mhs');
            $table->string('nama');
            $table->string('jabatan');
            $table->string('perusahaan');
            $table->text('alamat_mitra');
            $table->string('telp_penyelia');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profil_penyelia');
    }
};
