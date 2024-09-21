<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusMahasiswa extends Model
{
    use HasFactory;
    protected $table = 'status_mahasiswas';
    protected $fillable = [
        'id_mhs',
        'id_dsn',
        'bab_terakhir',
        'jml_bimbingan',
        'status',
        'pengajuan',
    ];
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'id_mhs', 'id');
    }

    public function dospem()
    {
        return $this->belongsTo(Dosen::class, 'id_dsn', 'id');
    }

    public function pengajuans()
    {
        return $this->hasMany(Pengajuan::class, 'id_mhs', 'id_mhs');
    }

    public function sidang()
    {
        return $this->hasMany(PengajuanSidang::class, 'id_mhs', 'id_mhs');
    }
}
