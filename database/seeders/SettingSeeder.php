<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $set = 
        [
            [
                'nama_toko' => "Toko Beras Mulia",
                'email' => "tokoberasmulia@gmail.com",
                'no_telp' => "081234567890",
                'fax' => "080987654321",
                'alamat' => "Jl. Medan Perang, Indonesia Merdeka",
                "created_at"=> now()
            ],
        ];

        DB::table('setting')->insert($set);
    }
}
