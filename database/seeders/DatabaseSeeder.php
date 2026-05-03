<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Panggil PenggunaSeeder di sini
        $this->call([
            PenggunaSeeder::class,
        ]);
    }
}