<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class rincian_gaji extends Model {
    protected $table = 'rincian_gaji';
    protected $guarded = [];
    public $timestamps = false;

    public function komponen() {
        return $this->belongsTo(komponen_gaji::class, 'component_id');
    }
}