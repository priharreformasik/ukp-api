<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Notifications\EmailVerification;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, HasApiTokens;
    use SoftDeletes;
    protected $dates = ['deleted_at','tanggal_lahir'];
    // protected $casts = [
    //     'tanggal_lahir' => 'datetime:j F Y',
    // ];
    protected $casts = [
        'tanggal_lahir' => 'datetime:j M Y',
    ];

    protected $fillable = [
        'name', 'email', 'password', 'level' , 'username' , 'nik' , 'tanggal_lahir' , 'jenis_kelamin' , 'alamat' , 'no_telepon' , 'foto' , 'isActive','fcm_token','status'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function sendEmailVerificationNotification()
    {
        $this->notify(new EmailVerification); // my notification
    }

    public function psikolog()
    {
        return $this->hasOne('App\Psikolog', 'user_id', 'id');
    }

    public function klien()
    {
        return $this->hasOne('App\Klien', 'user_id', 'id');
    }

    public function admin()
    {
        return $this->hasOne('App\Admin', 'user_id', 'id');
    }

    public function jadwal()
    {
        return $this->hasMany('App\Jadwal', 'user_id', 'id');
    }

    public function pesan()
    {
        return $this->belongsToMany('App\Pesan', 'pesan_user', 'pesan_id', 'user_id');
    }

}
