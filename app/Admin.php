<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{

    protected $table = 'admin';
    //protected $fillable = [];
    public $timestamps = true;
    //protected $dates = ['deleted_at', 'tanggal_lahir'];

    public function jadwal()
    {
        return $this->hasMany('App\Jadwal', 'klien_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}

/*protected $table = 'admin';
    protected $fillable = ['id','nama','jenis_kelamin','tanggal_lahir','nik','email','no_telepon','alamat','foto','username','password','created_by','updated_by'];
    public $timestamps = true;*/