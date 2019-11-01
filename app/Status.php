<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Status extends Model
{
	use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $table = 'status';
    protected $fillable = ['id','nama','deskripsi'];
    public $timestamps = true;
    //protected $dates = ['deleted_at', 'tanggal_lahir'];

   	public function jadwal()
    {
        return $this->hasMany('App\Jadwal', 'status_id', 'id');
    }
}
