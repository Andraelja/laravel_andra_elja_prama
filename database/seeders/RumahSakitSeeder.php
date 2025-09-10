<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RumahSakitSeeder extends Seeder
{
    public function run()
    {
        DB::table('rumah_sakit')->insert([
            [
                'nama_rumah_sakit' => 'RS Umum Pusat',
                'alamat' => 'Jl. Merdeka No. 123, Jakarta',
                'email' => 'rsup@example.com',
                'no_telp' => '0211234567',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_rumah_sakit' => 'RS Harapan Bunda',
                'alamat' => 'Jl. Sudirman No. 45, Bandung',
                'email' => 'rshb@example.com',
                'no_telp' => '0227654321',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
