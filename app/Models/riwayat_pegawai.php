<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class riwayat_kerja extends Model {
    protected $table = 'riwayat_kerja';
    protected $guarded = [];
    public $timestamps = false;

    public function divisi() {
        return $this->belongsTo(divisi::class, 'department_id');
    }
    public function jabatan() {
        return $this->belongsTo(jabatan::class, 'position_id');
    }
}