<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tes extends Model
{
	use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'tes';
    protected $fillable = ['id','nama','deskripsi','harga'];
    public $timestamps = true;
    //protected $dates = ['deleted_at', 'tanggal_lahir'];

   	public function jadwal()
    {
        return $this->belongsToMany('App\Jadwal', 'jadwal_tes', 'jadwal_id', 'tes_id');
    }
}
