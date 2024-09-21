<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\DosenPembimbing;
use App\Models\StatusMahasiswa;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat Role
        $roles = ['dosen', 'mahasiswa', 'koor'];

        foreach ($roles as $role) {
            if (!Role::where('name', $role)->exists()) {
                Role::create(['name' => $role]);
            }
        }

        // Buat user dan assign role
        $users = [
            // ['nim' => 'A11.2021.13472', 'password' => bcrypt('Dinus-123'), 'role' => 'mahasiswa'],
            // ['nim' => 'A11.2021.13489', 'password' => bcrypt('Dinus-123'), 'role' => 'mahasiswa'],
            // ['npp' => '0686.11.2012.444', 'password' => bcrypt('Dinus-123'), 'role' => 'dosen'],
            ['npp' => '0686.11.2013.532', 'password' => bcrypt('Dinus-123'), 'role' => 'dosen'],
            ['email' => 'koordinator@kerja.praktek', 'password' => bcrypt('kp-koor-123'), 'role' => 'koor'], // Koordinator login by email
            // ['npp' => '000000000', 'password' => bcrypt('Dinus-123'), 'role' => 'admin'],
        ];
        
        // $users = [
        //     ['name' => 'Admin', 'email' => 'admin@bimbingan.online', 'password' => bcrypt('123456'), 'role' => 'admin'],
        //     // ['name' => 'Dosen', 'email' => 'adhitya@dsn.dinus.ac.id', 'password' => bcrypt('123456'), 'role' => 'dosen'],
        //     // ['name' => 'Dosen', 'email' => 'ardytha.luthfiarta@dsn.dinus.ac.id', 'password' => bcrypt('123456'), 'role' => 'dosen'],
        //     // ['name' => 'Mahasiswa', 'email' => '111202113472@mhs.dinus.ac.id', 'password' => bcrypt('123456'), 'role' => 'mahasiswa'],
        //     // ['name' => 'Mahasiswa', 'email' => '111202113489@mhs.dinus.ac.id', 'password' => bcrypt('123456'), 'role' => 'mahasiswa'],
        //     ['name' => 'Koor', 'email' => 'koordinator@kerja.praktek', 'password' => bcrypt('123456'), 'role' => 'koor'],
        // ];

        foreach ($users as $userData) {
            $user = User::create([
                'nim' => $userData['nim'] ?? null,
                'npp' => $userData['npp'] ?? null,
                'email' => $userData['email'] ?? null,
                'password' => $userData['password'],
            ]);
            $user->assignRole($userData['role']);
        }

        // // Seed data Mahasiswa
        // $mhs = Mahasiswa::create([
        //     'nim' => 'A11.2021.13472',
        //     'nama' => 'Yoga Adi Pratama',
        //     // 'ipk' => 4.00,
        //     // 'telp_mhs' => '082110778946',
        //     'email' => '111202113472@mhs.dinus.ac.id',
        //     // 'dosen_wali' => 'GALUH WILUJENG SARASWATI, M.CS',
        //     // 'transkrip_nilai' => 'https://www.google.com',
        // ]);

        // StatusMahasiswa::create([
        //     'id_mhs' => $mhs->id,
        //     'pengajuan' => 0
        // ]);

        // $mhs2 = Mahasiswa::create([
        //     'nim' => 'A11.2021.13489',
        //     'nama' => 'Surinanda',
        //     // 'ipk' => 4.00,
        //     // 'telp_mhs' => '082243539209',
        //     'email' => '111202113489@mhs.dinus.ac.id',
        //     // 'dosen_wali' => 'ADHITYA NUGRAHA, S.Kom, M.CS',
        //     // 'transkrip_nilai' => 'https://www.google.com',
        // ]);

        // StatusMahasiswa::create([
        //     'id_mhs' => $mhs2->id,
        //     'pengajuan' => 0
        // ]);

        // // Seed data Dosen
        // $dsn = Dosen::create([
        //     'nama' => 'ADHITYA NUGRAHA, S.Kom, M.CS',
        //     'npp' => '0686.11.2012.444',
        //     'email' => 'adhitya@dsn.dinus.ac.id',
        //     'bidang_kajian' => 'RPLD',
        //     'telp' => '081325105905',
        // ]);

        // DosenPembimbing::create([
        //     'id_dsn' => $dsn->id,
        //     'kuota' => 25
        // ]);

        // // Seed data Dosen
        // $dsn2 = Dosen::create([
        //     'nama' => 'ARDYTHA LUTFIARTHA, M.Kom',
        //     'npp' => '0686.11.2012.460',
        //     'email' => 'ardytha.luthfiarta@dsn.dinus.ac.id',
        //     'bidang_kajian' => 'SC',
        //     'telp' => '085235756436',
        // ]);

        // DosenPembimbing::create([
        //     'id_dsn' => $dsn2->id,
        //     'kuota' => 25
        // ]);
    }

}
