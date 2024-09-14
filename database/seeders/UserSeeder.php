<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'OgnjenM',
            'email' => 'ognjen@gmail.com',
            'password' => Hash::make('ognjen123'),
            'role' => 'packer'
        ]);
        DB::table('users')->insert([
            'name' => 'AlenA',
            'email' => 'alen@gmail.com',
            'password' => Hash::make('alen123'),
            'role' => 'storage'
        ]);
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin'),
            'role' => 'admin'
        ]);
    }
}
