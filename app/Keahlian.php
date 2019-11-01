<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Keahlian extends Model
{

	use SoftDeletes;
    protected $dates = ['deleted_at'];
    
    protected $table = 'keahlian_psikolog';
    protected $fillable = ['id','nama'];
    public $timestamps = true;
    //protected $dates = ['deleted_at', 'tanggal_lahir'];
    public function psikolog()
    {
        return $this->hasMany('App\Psikolog', 'keahlian_id', 'id');
    }
   
}
