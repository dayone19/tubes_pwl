<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class absensi extends Model {
    protected $table = 'absensi'; // Sudah sesuai permintaan (pake nama baru)
    protected $guarded = [];
    public $timestamps = false;

    // Relasi balik ke pemilik absen
    public function pegawai()
{
    // 'pegawai_id' adalah nama kolom foreign key di tabel absensi kamu
    return $this->belongsTo(profil_pegawai::class, 'pegawai_id');
}
}