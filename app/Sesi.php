<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sesi extends Model
{
	use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $table = 'sesi';
    protected $fillable = ['id','nama','jam','layanan_id'];
    public $timestamps = true;
    //protected $dates = ['deleted_at', 'tanggal_lahir'];

   	public function jadwal()
    {
        return $this->hasMany('App\Jadwal', 'sesi_id', 'id');
    }

    public function layanan()
    {
        return $this->belongsToMany('App\Layanan', 'layanan_sesi','sesi_id','layanan_id');
    }
}
