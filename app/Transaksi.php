<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaksi extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'transaksi';
    protected $fillable = ['id','biaya_registrasi','foto','jadwal_id','harga'];
    public $timestamps = true;

    public function transaksi_asesmen()
    {
        return $this->hasMany('App\TransaksiAsesmen', 'transaksi_id', 'id');
    }

    public function jadwal()
    {
        return $this->belongsTo('App\Jadwal', 'jadwal_id', 'id');
    }
}
