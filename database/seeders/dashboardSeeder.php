<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\pengguna; 
use App\Models\statistik_bulanan;

class DashboardSeeder extends Seeder
{
    public function run()
    {
        // 1. Data Statistik Bulanan (Sesuai kolom di gambar kamu)
        // Karena 'bulan' di tabel kamu adalah INT, kita pakai angka 1-6
        $dataStatistik = [
            ['bulan' => 1, 'tahun' => 2026, 'total_pegawai' => 35, 'total_biaya' => 110000000.00, 'baru' => 2, 'keluar' => 0],
            ['bulan' => 2, 'tahun' => 2026, 'total_pegawai' => 37, 'total_biaya' => 125000000.00, 'baru' => 3, 'keluar' => 1],
            ['bulan' => 3, 'tahun' => 2026, 'total_pegawai' => 36, 'total_biaya' => 118000000.00, 'baru' => 0, 'keluar' => 1],
            ['bulan' => 4, 'tahun' => 2026, 'total_pegawai' => 40, 'total_biaya' => 128500000.00, 'baru' => 4, 'keluar' => 0],
        ];

        foreach ($dataStatistik as $ds) {
            statistik_bulanan::create([
                'bulan' => $ds['bulan'],
                'tahun' => $ds['tahun'],
                'total_pegawai' => $ds['total_pegawai'],
                'total_biaya' => $ds['total_biaya'],
                'jumlah_pegawai_baru' => $ds['baru'],
                'jumlah_pegawai_keluar' => $ds['keluar'],
            ]);
        }

        // 2. Data Pengguna (Pastikan kolom di tabel 'pengguna' juga sesuai)
        // Saya asumsikan tabel pengguna punya: nama, nip, role, password
        
        $roles = [
            ['nama' => 'Budi Manager', 'nip' => '2601001', 'role' => 'manager'],
            ['nama' => 'Siti Akuntan', 'nip' => '2602001', 'role' => 'akuntan'],
            ['nama' => 'Andi HRD', 'nip' => '2604001', 'role' => 'hrd'],
        ];

        foreach ($roles as $r) {
            pengguna::create([
                'nama' => $r['nama'],
                'nip' => $r['nip'],
                'role' => $r['role'],
                'kata_sandi' => Hash::make('password123'),
            ]);
        }

        // Tambah beberapa mekanik dummy
        for ($i = 1; $i <= 5; $i++) {
            pengguna::create([
                'nama' => 'Mekanik ' . $i,
                'nip' => '2603' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'role' => 'mekanik',
                'kata_sandi' => Hash::make('password123'),
            ]);
        }

        echo "Seeder Berhasil sesuai struktur tabel baru!\n";
    }
}