<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class KaryawanController extends Controller
{
    public function index()
    {
        // Tambahkan ->onEachSide(1) di sini
        $data_karyawan = DB::table('profil_pegawai')
                            ->paginate(7)
                            ->onEachSide(1); 

        return view('halaman.karyawan', compact('data_karyawan'));
    }

    public function show($id)
{
    // Cari data di database
    $p = DB::table('profil_pegawai')->where('id', $id)->first();

    if (!$p) { abort(404); }

    // Nama view di sini harus sesuai nama file (detail_karyawan)
    return view('halaman.detail_karyawan', compact('p'));
}
}