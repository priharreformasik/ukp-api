<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Jadwal extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at','tanggal'];
    protected $casts = [
        'tanggal' => 'datetime:d m Y',
    ];
    protected $table = 'jadwal';
    protected $fillable = ['id','tanggal','sesi_id','klien_id','keluhan','layanan_id','ruangan_id','psikolog_id','status_id'];
    public $timestamps = true;
    
    //protected $dates = ['tanggal'];

   	public function klien()
    {
        return $this->belongsTo('App\Klien', 'klien_id', 'id');
    }

    public function layanan()
    {
        return $this->belongsTo('App\Layanan', 'layanan_id', 'id');
    }

    // public function tes()
    // {
    //     return $this->belongsToMany('App\Tes', 'jadwal_tes', 'jadwal_id','tes_id');
    // }

    public function ruangan()
    {
        return $this->belongsTo('App\Ruangan', 'ruangan_id', 'id');
    }
    public function psikolog()
    {
        return $this->belongsTo('App\Psikolog', 'psikolog_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
    public function sesi()
    {
        return $this->belongsTo('App\Sesi', 'sesi_id', 'id');
    }
    public function status()
    {
        return $this->belongsTo('App\Status', 'status_id', 'id');
    }

}
