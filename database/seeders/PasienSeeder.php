<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PasienSeeder extends Seeder
{
    public function run()
    {
        DB::table('pasien')->insert([
            [
                'nama_pasien' => 'Budi Santoso',
                'alamat' => 'Jl. Kenanga No. 5, Jakarta',
                'no_telp' => '081234567890',
                'id_rumah_sakit' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_pasien' => 'Siti Aminah',
                'alamat' => 'Jl. Melati No. 10, Bandung',
                'no_telp' => '082345678901',
                'id_rumah_sakit' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
