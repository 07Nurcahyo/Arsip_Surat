<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class surat_seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id_surat' => 1,
                'nomor_surat' => '123',
                'judul_surat' => 'tes',
                'file_surat' => '',
                'kode_kategori' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];
        DB::table('surat')->insert($data);
    }
}
