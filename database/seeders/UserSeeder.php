<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->delete();
        DB::table('users')->insert([
            'name' => 'José Guerrero',
            'email' => 'jose.guerrero.carrizo@gmail.com',
            'password' => '$2y$12$iufP8eJ69OV7VNdw88onCenSXkNQrypHW3ek5JoG/xicWq5o4xvD.',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
