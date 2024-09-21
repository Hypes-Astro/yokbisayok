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
        Schema::create('status_dosens', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_period');
            $table->integer('kuota')->default(0);
            $table->integer('ajuan')->default(0);
            $table->integer('diterima')->default(0);
            $table->integer('sisa')->default(0);
            $table->enum('status', ['TERSEDIA', 'PENUH'])->default('TERSEDIA');
            $table->timestamps();

            // $table->foreign('id_mhs')->references('id')->on('mahasiswa')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('status_dosens');
    }
};