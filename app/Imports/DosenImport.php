<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Dosen;
use App\Models\DosenPembimbing;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DosenImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Lakukan upsert untuk dosen agar tidak ada duplikat berdasarkan npp
        $dosen = Dosen::updateOrCreate(
            ['npp' => $row['npp']],
            [
                'nama' => $row['nama'],
                'bidang_kajian' => $row['bidang_kajian'],
                'telp' => $row['telp'],
            ]
        );

        // Jika dosen baru dibuat, tambahkan juga data Dosen Pembimbing
        if ($dosen->wasRecentlyCreated) {
            DosenPembimbing::create([
                'id_dsn' => $dosen->id,
                'kuota' => $row['kuota'],
            ]);
        }

        // Lakukan pengecekan apakah user sudah ada berdasarkan npp
        $user = User::firstOrCreate(
            ['npp' => $row['npp']],
            [
                'nim' => null,
                'email' => $row['email'] ?? null,
                'password' => bcrypt('Dinus-123'),
            ]
        );

        // Assign role jika user baru dibuat
        if ($user->wasRecentlyCreated) {
            $user->assignRole('dosen');
        }

        // Kembalikan instance dosen
        return $dosen;
    }
}
