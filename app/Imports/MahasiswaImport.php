<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\DosenPembimbing;
use App\Models\StatusMahasiswa;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MahasiswaImport implements ToModel, WithHeadingRow
{
    // public function model(array $row)
    // {
    //     // Cari dosen berdasarkan npp
    //     $dosen = null;
    //     if (!empty($row['npp'])) {
    //         $dosen = Dosen::where('npp', $row['npp'])->first();
    //     }

    //     // Lakukan upsert untuk mahasiswa agar tidak ada duplikat berdasarkan nim
    //     $mahasiswa = Mahasiswa::updateOrCreate(
    //         ['nim' => $row['nim']],
    //         [
    //             'nama' => $row['nama'],
    //             'email' => $row['email'],
    //             'status_kp' => $row['status_kp'],
    //             'id_dsn' => $dosen ? $dosen->id : null
    //         ]
    //     );

    //     // Jika mahasiswa baru dibuat dan memiliki dosen pembimbing, tambahkan data StatusMahasiswa
    //     if ($mahasiswa->wasRecentlyCreated && $dosen) {
    //         StatusMahasiswa::create([
    //             'id_mhs' => $mahasiswa->id,
    //             'id_dsn' => $dosen->id,
    //             'status' => 'ACC',
    //             'pengajuan' => 0,
    //         ]);

    //         // Update table dosen_pembimbings
    //         $dosenPembimbing = DosenPembimbing::where('id_dsn', $dosen->id)->first();
    //         if ($dosenPembimbing) {
    //             $dosenPembimbing->increment('jumlah_ajuan');
    //             $dosenPembimbing->increment('ajuan_diterima');
    //             $dosenPembimbing->decrement('sisa_kuota');
    //             $dosenPembimbing->status = $dosenPembimbing->sisa_kuota > 0 ? 'Tersedia' : 'Penuh';
    //             $dosenPembimbing->save();
    //         }
    //     } else {
    //         StatusMahasiswa::create([
    //             'id_mhs' => $mahasiswa->id,
    //             'pengajuan' => 0,
    //         ]);
    //     }

    //     // Lakukan pengecekan apakah user sudah ada berdasarkan nim
    //     $user = User::firstOrCreate(
    //         ['nim' => $row['nim']],
    //         [
    //             'npp' => null,
    //             'email' => $row['email'],
    //             'password' => bcrypt('Dinus-123'),
    //         ]
    //     );

    //     // Assign role jika user baru dibuat
    //     if ($user->wasRecentlyCreated) {
    //         $user->assignRole('mahasiswa');
    //     }

    //     // Kembalikan instance mahasiswa
    //     return $mahasiswa;
    // }


    //solving 1
    public function model(array $row)
    {
        // Cari dosen berdasarkan npp
        $dosen = null;
        if (!empty($row['npp'])) {
            $dosen = Dosen::where('npp', $row['npp'])->first();
        }

        // Lakukan upsert untuk mahasiswa agar tidak ada duplikat berdasarkan nim
        $mahasiswa = Mahasiswa::updateOrCreate(
            ['nim' => $row['nim']],
            [
                'nama' => $row['nama'],
                'email' => $row['email'],
                'status_kp' => $row['status_kp'],
                'id_dsn' => $dosen ? $dosen->id : null
            ]
        );

        // Jika mahasiswa baru dibuat dan memiliki dosen pembimbing, tambahkan data StatusMahasiswa
        if ($mahasiswa->wasRecentlyCreated && $dosen) {
            StatusMahasiswa::create([
                'id_mhs' => $mahasiswa->id,
                'id_dsn' => $dosen->id,
                'status' => 'ACC',
                'pengajuan' => 0,
            ]);

            // Update table dosen_pembimbings
            $dosenPembimbing = DosenPembimbing::where('id_dsn', $dosen->id)->first();
            if ($dosenPembimbing) {
                $dosenPembimbing->increment('jumlah_ajuan');
                $dosenPembimbing->increment('ajuan_diterima');
                $dosenPembimbing->decrement('sisa_kuota');
                $dosenPembimbing->status = $dosenPembimbing->sisa_kuota > 0 ? 'Tersedia' : 'Penuh';
                $dosenPembimbing->save();
            }
        } else {
            // Update status mahasiswa jika sudah ada di database
            StatusMahasiswa::updateOrCreate(
                ['id_mhs' => $mahasiswa->id],
                [
                    'pengajuan' => 0,
                    'status' => $dosen ? 'ACC' : 'Pending',
                ]
            );
        }

        // Lakukan pengecekan apakah user sudah ada berdasarkan nim
        $user = User::updateOrCreate(
            ['nim' => $row['nim']],
            [
                'email' => $row['email'],
                'password' => bcrypt('Dinus-123'), // Default password for mahasiswa
            ]
        );

        // Assign role jika user baru dibuat
        if (!$user->hasRole('mahasiswa')) {
            $user->assignRole('mahasiswa');
        }

        // Kembalikan instance mahasiswa
        return $mahasiswa;
    }
}
