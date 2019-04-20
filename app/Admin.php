<?php

namespace App;

// use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $table = 'tb_admin';

    protected $fillable = [
      'id_admin','nama','password'
    ];

    protected $hidden = [
      'password','remember_token'
    ];

    protected $primaryKey = 'id_admin';

    public $incrementing = false;

    public function setPasswordAttribute($value)
    {
      $this->attributes['password'] = bcrypt($value);
    }

}
