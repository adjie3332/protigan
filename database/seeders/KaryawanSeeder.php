<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KaryawanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // insert data ke table karwayan
        DB::table('data_karyawan')->insert([
            'users_id' => 1,
            'nama' => 'admin',
            'alamat' => 'Baturaja',
            'tanggal_lahir' => '2002-03-02',
            'no_telepon' => '0823123123',
            'jenis_kelamin' => 'Laki-laki',
            'umur' => 22,
            'foto' => '1705249336.jpg',
        ]);
    }
}
