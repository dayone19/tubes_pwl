<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class statistik_bulanan extends Model
{
    // Karena kamu pakai p kecil dan nama tabel Indonesia
    protected $table = 'statistik_bulanan';
    
    // Matikan timestamps karena di DB kamu biasanya gak ada created_at/updated_at untuk tabel rekap
    public $timestamps = false;

    // Izinkan semua kolom diisi (mass assignment)
    protected $guarded = [];

    /**
     * Scope untuk mempermudah ambil data tahun ini
     */
    public function scopeTahunIni($query)
    {
        return $query->where('year', date('Y'));
    }

    protected $fillable = [
    'bulan', 'tahun', 'total_pegawai', 'total_biaya', 
    'jumlah_pegawai_baru', 'jumlah_pegawai_keluar'
];
}