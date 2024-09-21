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
        Schema::create('mahasiswas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_dsn')->nullable();
            $table->string('nim')->unique();
            $table->string('nama');
            $table->double('ipk')->nullable();
            $table->string('telp_mhs')->nullable()->unique();
            $table->string('email')->unique();
            $table->enum('status_kp', ['BARU', 'ULANG'])->default('BARU');
            // $table->string('dosen_wali');
            $table->longText('transkrip_nilai')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswas');
    }
};
