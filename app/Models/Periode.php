<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periode extends Model
{
    use HasFactory;
    protected $table = 'periode';
    protected $fillable = [
        'tahun_ajaran',
        'status',
    ];
    public function dosenPeriodik()
    {
        return $this->hasOne(DosenPeriodik::class, 'id_periode', 'id');
    }
    public function mahasiswaPeriodik()
    {
        return $this->hasOne(MahasiswaPeriodik::class, 'id_periode', 'id');
    }
    public function statusDosen()
    {
        return $this->hasOne(StatusDosen::class, 'id_period', 'id');
    }
}