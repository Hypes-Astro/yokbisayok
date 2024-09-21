<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilPenyelia extends Model
{
    use HasFactory;

    protected $table = 'profil_penyelia';

    // alif
    protected $fillable = [
        'nama',
        'jabatan',
        'perusahaan',
        'alamat_mitra',
        'telp_penyelia',
        'id_mhs' // Tambahkan id_mhs agar bisa diisi
    ];

    // Relasi ke model Pengajuan
    public function pengajuan()
    {
        return $this->hasMany(Pengajuan::class, 'penyelia_id', 'id');
    }
}
