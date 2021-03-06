<?php

namespace App;

// use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Mahasiswa extends Authenticatable
{
    use Notifiable;

    protected $table = 'tb_mahasiswa';

    protected $fillable = [
      'nim','nama_mhs','id_kelas','password'
    ];

    protected $primaryKey = 'nim';

    public $incrementing = false;

    protected $hidden = [
      'password','remember_token'
    ];

    public function setPasswordAttribute($value)
    {
      $this->attributes['password'] = bcrypt($value);
    }

    public function kelas(){
        return $this->belongsTo('App\Kelas', 'id_kelas');
    }

}
