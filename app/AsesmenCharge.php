<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AsesmenCharge extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'asesmen_charge';
    protected $fillable = ['id','nama','deskripsi','harga','layanan_id'];
    public $timestamps = true;

    // public function jadwal()
    // {
    //     return $this->hasMany('App\Jadwal', 'status_id', 'id');
    // }
}
