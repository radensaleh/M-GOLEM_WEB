<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'tb_kategori';

    protected $fillable = [
      'id_kategori', 'nama_kategori'
    ];

    protected $primaryKey = 'id_kategori';

    public $incrementing = false;

    public function barang(){
        return $this->hasMany('App\Barang', 'id_kategori');
    }

}
