<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $us = 
        [
            [
                'name' => "Admin",
                'email' => "admin@gmail.com",
                'password' => Hash::make('admin123'),
                "created_at"=> now()
            ],
        ];

        DB::table('users')->insert($us);
    }
}
