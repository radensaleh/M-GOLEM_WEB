<?php

namespace App;

// use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Teknisi extends Authenticatable
{
    use Notifiable;

    protected $table = 'tb_teknisi';

    protected $fillable = [
      'username','nama_teknisi','password'
    ];

    protected $primaryKey = 'username';

    public $incrementing = false;

    protected $hidden = [
      'password','remember_token'
    ];

    public function setPasswordAttribute($value)
    {
      $this->attributes['password'] = bcrypt($value);
    }

}
