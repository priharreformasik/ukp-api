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

    public function transaksi_asesmen()
    {
        return $this->hasMany('App\TransaksiAsesmen', 'asesmen_id', 'id');
    }

    public function layanan()
    {
        return $this->belongsTo('App\Layanan', 'layanan_id', 'id');
    }

}
