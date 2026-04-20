<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class cuti extends Model {
    protected $table = 'cuti';
    protected $guarded = [];
    public $timestamps = false;

    public function pegawai() {
        return $this->belongsTo(profil_pegawai::class, 'employee_id');
    }
}