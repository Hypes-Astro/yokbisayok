<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPenilaian extends Model
{
    use HasFactory;

    protected $table = 'detail_penilaians';

    protected $fillable = [
        'deskripsi_pekerjaan',
        'prestasi_kontribusi',
        'keterampilan_kemampuan',
        'kerjasama_keterlibatan',
        'komentar',
        'perkembangan',
        'kesimpulan_saran',
        'score',
        'file_path',
        'mahasiswa_id',
        'penyelia_id',
        'status',
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }

    public function penyelia()
    {
        return $this->belongsTo(Penyelia::class);
    }
}
