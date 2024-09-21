<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanSidang extends Model
{
    use HasFactory;

    protected $table = 'pengajuan_sidangs';
    protected $fillable = [
        'id_mhs',
        'judul',
        'bidang_kajian',
        'dokumen',
        'validasi',
        'nilaiPenyelia',
        'statusPengajuan',
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(StatusMahasiswa::class, 'id_mhs', 'id_mhs');
    }
}
