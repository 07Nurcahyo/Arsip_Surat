<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class kategori_seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id_kategori' => 1,
                'nama_kategori' => 'Tes',
                'keterangan' => 'tes',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];
        DB::table('kategori')->insert($data);
    }
}
