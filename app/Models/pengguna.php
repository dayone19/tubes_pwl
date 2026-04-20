<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class pengguna extends Authenticatable
{
    use Notifiable;

    protected $table = 'pengguna';
    protected $primaryKey = 'nip';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'nip', 
        'role', 
        'kata_sandi', 
        'nama', 
        'foto',
        'gaji_pokok', // Pastikan kolom ini sudah ada di database
    ];

    /**
     * Beritahu Laravel bahwa kolom password kita namanya 'kata_sandi'
     */
    public function getAuthPassword()
    {
        return $this->kata_sandi;
    }

    /**
     * ACCESSOR: Tunjangan (10% dari Gaji Pokok)
     * Diakses melalui: $user->tunjangan
     */
    public function getTunjanganAttribute()
    {
        // Menggunakan nilai default 4.500.000 jika kolom gaji_pokok kosong
        $gapok = $this->gaji_pokok ?? 4500000;
        return $gapok * 0.1;
    }

    /**
     * ACCESSOR: Total Gaji (Gaji Pokok + Tunjangan)
     * Diakses melalui: $user->total_gaji
     */
    public function getTotalGajiAttribute()
    {
        $gapok = $this->gaji_pokok ?? 4500000;
        return $gapok + $this->tunjangan;
    }
}