<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ruangan extends Model
{
	use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $table = 'ruangan';
    protected $fillable = ['id','nama','deskripsi','layanan_id'];
    public $timestamps = true;
    //protected $dates = ['deleted_at', 'tanggal_lahir'];

   	public function jadwal()
    {
        return $this->hasMany('App\Jadwal', 'ruangan_id', 'id');
    }
}

