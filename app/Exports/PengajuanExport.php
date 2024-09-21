<?php

namespace App\Exports;

use App\Models\Pengajuan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PengajuanExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Pengajuan::with('mahasiswa', 'profilPenyelia')->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'NIM',
            'Nama Mahasiswa',
            'Judul KP',
            'Nama Perusahaan',
            'Alamat Perusahaan',
            'Nama Penyelia',
            'No. Telp Penyelia'
        ];
    }

    public function map($pengajuan): array
    {
        return [
            $pengajuan->id, // Ini untuk nomor urut
            $pengajuan->mahasiswa ? $pengajuan->mahasiswa->nim : '-', // NIM
            $pengajuan->mahasiswa ? $pengajuan->mahasiswa->nama : '-', // Nama Mahasiswa
            $pengajuan->judul, // Judul KP
            $pengajuan->profilPenyelia ? $pengajuan->profilPenyelia->perusahaan : '-', // Nama Perusahaan
            $pengajuan->profilPenyelia ? $pengajuan->profilPenyelia->alamat_mitra : '-', // Alamat Perusahaan
            $pengajuan->profilPenyelia ? $pengajuan->profilPenyelia->nama : '-', // Nama Penyelia
            $pengajuan->profilPenyelia ? $pengajuan->profilPenyelia->telp_penyelia : '-' // No. Telp Penyelia
        ];
    }
}
