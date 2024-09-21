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
        Schema::create('detail_penilaians', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mahasiswa_id')->constrained('mahasiswas')->onDelete('cascade');
            $table->foreignId('penyelia_id')->constrained('penyelias')->onDelete('cascade');
            $table->text('deskripsi_pekerjaan');
            $table->text('prestasi_kontribusi');
            $table->text('keterampilan_kemampuan');
            $table->text('kerjasama_keterlibatan');
            $table->text('komentar')->nullable();
            $table->text('perkembangan');
            $table->text('kesimpulan_saran');
            $table->float('score');
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
        Schema::dropIfExists('detail_penilaians');
    }
};
