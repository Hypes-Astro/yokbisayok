<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;
    protected $table = 'dosens';
    protected $fillable = [
        'nama',
        'npp',
        'email',
        'bidang_kajian',
        'telp'
    ];

    public function mahasiswa()
    {
        return $this->hasManyThrough(
            Mahasiswa::class,
            StatusMahasiswa::class,
            'id_dsn', // Foreign key di tabel status_mahasiswas
            'id',     // Foreign key di tabel mahasiswas
            'id',     // Local key di tabel dosens
            'id_mhs'  // Local key di tabel status_mahasiswas
        )->orderBy('status_mahasiswas.created_at', 'desc'); // Urutkan berdasarkan `created_at` di status_mahasiswas
    }

    public function pengajuan()
    {
        return $this->hasMany(StatusMahasiswa::class, 'id_dsn', 'id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'npp', 'npp');
    }

    public function dosen(){
        return $this->hasOne(DosenPembimbing::class, 'id_dsn', 'id');
    }
}
