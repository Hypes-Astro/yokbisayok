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
        Schema::create('penilaian', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mahasiswa_id')->constrained('mahasiswas')->onDelete('cascade');
            $table->foreignId('penyelia_id')->constrained('profil_penyelia')->onDelete('cascade');
            $table->text('deskripsi_pekerjaan');
            $table->float('inovasi')->default(0);
            $table->float('kerjasama')->default(0);
            $table->float('kedisiplinan')->default(0);
            $table->text('catatan')->nullable();
            $table->float('score')->default(0);
            $table->string('file_path')->nullable();
            $table->string('status')->default('PENDING');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penilaian');
    }
};
