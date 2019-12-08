<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransaksiAsesmen extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'transaksi_asesmen';
    protected $fillable = ['id','transaksi_id','asesmen_id'];
    public $timestamps = true;

    public function asesmen()
    {
        return $this->belongsTo('App\AsesmenCharge', 'asesmen_id', 'id');
    }

    public function transaksi()
    {
        return $this->belongsTo('App\Transaksi', 'transaksi_id', 'id');
    }
}
