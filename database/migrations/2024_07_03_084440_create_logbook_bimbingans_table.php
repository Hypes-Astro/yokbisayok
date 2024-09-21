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
        Schema::create('logbook_bimbingans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_mhs');
            $table->unsignedBigInteger('id_dsn');
            $table->date('tanggal');
            $table->integer('bab');
            $table->longText('uraian');
            $table->longText('dokumen');
            $table->enum('status', ['ACC', 'REVISI', 'PENDING'])->default('PENDING');
            $table->timestamps();

            $table->foreign('id_mhs')->references('id')->on('mahasiswas')->cascadeOnDelete();
            $table->foreign('id_dsn')->references('id')->on('dosens')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logbook_bimbingans');
    }
};
