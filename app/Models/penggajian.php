<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class penggajian extends Model {
    protected $table = 'penggajian';
    protected $guarded = [];
    public $timestamps = false;

    public function pegawai() {
        return $this->belongsTo(profil_pegawai::class, 'employee_id');
    }

    // Relasi ke Rincian Gaji (Komponen per item)
    public function rincian() {
        return $this->hasMany(rincian_gaji::class, 'payroll_id');
    }
}