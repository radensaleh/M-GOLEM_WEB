<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $table = 'tb_tipe';

    protected $fillable = [
      'id_tipe','nama_tipe'
    ];

    protected $primaryKey = 'id_tipe';

    public $incrementing = false;

    public function barang(){
        return $this->hasMany('App\Barang', 'id_tipe');
    }
}
