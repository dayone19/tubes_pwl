<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class profil_pegawai extends Model
{
    protected $table = 'profil_pegawai';
    protected $guarded = [];
    public $timestamps = false;

    // Relasi ke Akun Login
    public function pengguna()
    {
        return $this->hasOne(Pengguna::class, 'employee_id');
    }

    // Relasi ke Data Absen
    public function absensi()
    {
        return $this->hasMany(Absensi::class, 'employee_id');
    }

    // Relasi ke Riwayat Gaji
    public function penggajian()
    {
        return $this->hasMany(Penggajian::class, 'employee_id');
    }
}