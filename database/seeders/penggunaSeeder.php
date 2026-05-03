<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\pengguna; // Nama model kamu
use Illuminate\Support\Facades\Hash;

class penggunaSeeder extends Seeder
{
    public function run(): void
{
    // Hapus data lama agar tidak bentrok
    \App\Models\pengguna::where('nip', '233008')->delete();

    \App\Models\pengguna::create([
        'nip' => '233008',
        'role' => 'hrd',
        'kata_sandi' => \Illuminate\Support\Facades\Hash::make('tontowimetal123'),
    ]);

    \App\Models\pengguna::create([
        'nip' => '203006',
        'role' => 'manager',
        'kata_sandi' => \Illuminate\Support\Facades\Hash::make('putribuahhatiku123'),
    ]);

    \App\Models\pengguna::create([
        'nip' => '161002',
        'role' => 'teknisi',   
        'kata_sandi' => \Illuminate\Support\Facades\Hash::make('budidi123'),
    ]);
    
    \App\Models\pengguna::create([
        'nip' => '151001',
        'role' => 'akuntan',   
        'kata_sandi' => \Illuminate\Support\Facades\Hash::make('prayogapilates123'),
    ]);}

}