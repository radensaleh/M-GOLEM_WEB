<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
  protected $table = 'tb_peminjaman';

  protected $fillable = [
    'id_pinjam', 'nim', 'username_verifpinjam', 'username_verifkembali' ,'nama_kegiatan', 'tgl_pinjam', 'tgl_kembali', 'status'
  ];

  protected $primaryKey = 'id_pinjam';

  public $incrementing = false;

  public function mahasiswa()
  {
    return $this->belongsTo('App\Mahasiswa', 'nim');
  }

}
