<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Merk extends Model
{
    protected $table = 'tb_merk';

    protected $fillable = [
      'id_merk','nama_merk'
    ];

    protected $primaryKey = 'id_merk';

    public $incrementing = false;

    public function barang(){
        return $this->hasMany('App\Barang', 'id_merk');
    }

}
