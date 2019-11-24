<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Layanan extends Model
{
	use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $table = 'layanan';
    protected $fillable = ['id','nama','deskripsi','harga','foto'];
    public $timestamps = true;
    //protected $dates = ['deleted_at', 'tanggal_lahir'];
    public function jadwal()
    {
        return $this->hasMany('App\Jadwal', 'layanan_id', 'id');
    }

    public function psikolog()
    {
        return $this->belongsToMany('App\Psikolog', 'layanan_psikolog', 'psikolog_id', 'layanan_id');
    }

    public function sesi()
    {
        return $this->hasMany('App\Sesi', 'layanan_id', 'id');
    }

    public function ruangan()
    {
        return $this->hasMany('App\Ruangan', 'layanan_id', 'id');
    }

    public function asesmen()
    {
        return $this->hasMany('App\AsesmenCharge', 'layanan_id', 'id');
    }
   
}
