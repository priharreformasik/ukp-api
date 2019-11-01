<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kategori extends Model
{
	use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $table = 'kategori_klien';
    protected $fillable = ['id','nama','deskripsi'];
    public $timestamps = true;
    //protected $dates = ['deleted_at', 'tanggal_lahir'];

    public function klien()
    {
        return $this->hasOne('App\Klien', 'kategori_id', 'id');
    }

   
}
