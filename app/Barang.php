<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'tb_barang';

    protected $fillable = [
      'generate', 'id_barang','id_kategori','id_merk','id_tipe','kuantitas'
    ];

    protected $primaryKey = 'id_barang';

    public $incrementing = false;

    public function kategori(){
        return $this->belongsTo('App\Kategori', 'id_kategori');
    }

    public function merk(){
        return $this->belongsTo('App\Merk', 'id_merk');
    }

    public function tipe(){
        return $this->belongsTo('App\Type', 'id_tipe');
    }

}
