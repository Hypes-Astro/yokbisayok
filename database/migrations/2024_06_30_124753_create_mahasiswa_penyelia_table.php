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
        Schema::create('mahasiswa_penyelia', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mahasiswaId');
            $table->foreign('mahasiswaId')->references('id')->on('mahasiswas');
            $table->unsignedBigInteger('penyeliaId');
            $table->foreign('penyeliaId')->references('id')->on('penyelias');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswa_penyelia');
    }
};
