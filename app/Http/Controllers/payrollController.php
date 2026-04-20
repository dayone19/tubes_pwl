<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\absensi; 
use App\Models\profil_pegawai; 
use App\Models\Penggajian; 

class PayrollController extends Controller
{
    /**
     * Menampilkan data Absensi & Lembur
     */
    public function dataAbsensi()
    {
        // Menggunakan paginate(10) agar link pagination muncul di view
        $dataAbsen = absensi::join('profil_pegawai', 'absensi.pegawai_id', '=', 'profil_pegawai.id')
            ->select(
                'absensi.*', 
                'profil_pegawai.nama_lengkap as nama_pegawai', 
                'profil_pegawai.nip'
            )
            ->orderBy('absensi.created_at', 'desc')
            ->paginate(7); // <--- Kuncinya di sini

        return view('halaman.absensi', compact('dataAbsen'));
    }

    /**
     * Menampilkan data Hitung Payroll
     */
    public function dataPayroll()
    {
        // Mengambil data dari tabel 'penggajian' dengan pagination
        $payroll = Penggajian::join('profil_pegawai', 'penggajian.nip', '=', 'profil_pegawai.id')
            ->select(
                'penggajian.*', 
                'profil_pegawai.nama_lengkap as nama_pegawai',
                'profil_pegawai.nip'
            )
            ->orderBy('penggajian.created_at', 'desc')
            ->paginate(7); // <--- Kuncinya di sini

        return view('halaman.payroll', compact('payroll'));
    }

    /**
     * Menampilkan Database Kru / Mekanik
     */
    public function dataKru()
    {
        $data_karyawan = profil_pegawai::orderBy('nama_lengkap', 'asc')
            ->paginate(7);

        return view('halaman.kru', compact('data_karyawan'));
    }

    public function manage()
{
    // Ambil semua karyawan KECUALI yang rolenya 'manager'
    $karyawan = \App\Models\pengguna::where('role', '!=', 'manager')->get();

    // Hitung Ringkasan
    $jumlahKaryawan = $karyawan->count();
    $totalEstimasiGaji = 0;

    foreach ($karyawan as $k) {
        // Logika Gaji Pokok
        $gapok = $k->gaji_pokok ?? 4500000;
        
        // Tunjangan 10%
        $tunjangan = $gapok * 0.1;
        
        $totalEstimasiGaji += ($gapok + $tunjangan);
    }

    return view('halaman.manage', compact('karyawan', 'jumlahKaryawan', 'totalEstimasiGaji'));
}
}