<?php

namespace App\Exports;

use App\Models\MahasiswaExport;
use Maatwebsite\Excel\Concerns\FromCollection;

class UsersExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // Mengambil semua data mahasiswa
        return MahasiswaExport::select('id', 'nim', 'nama', 'judul', 'perusahaan', 'alamat_mitra', 'nama', 'telp_penyelia')->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'NIM',
            'Nama',
            'Judul KP',
            'Nama Perusahaan',
            'Alamat Perusahaan',
            'Nama penyelia',
            'No.Telp Penyelia'
        ];
    }
}
