<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pesan extends Model
{
	use SoftDeletes;
    protected $dates = ['deleted_at'];
    
    protected $table = 'pesan';
    protected $fillable = ['id','user_id','subject','pesan'];
    public $timestamps = true;

    public function user()
    {
        return $this->belongsToMany('App\User', 'pesan_user', 'pesan_id','user_id');
    }
   
}
