<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DaftarBarang extends Model
{
  protected $table = 'tb_daftar_barang';

  protected $fillable = [
    'id_list', 'id_pinjam', 'id_barang', 'kuantitas'
  ];

  protected $primaryKey = 'id_list';

  public $incrementing = false;
}
