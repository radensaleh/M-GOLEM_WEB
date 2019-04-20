<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'tb_kelas';

    protected $fillable = [
      'id_kelas','nama_kelas'
    ];

    protected $primaryKey = 'id_kelas';

    public $incrementing = false;

    public function mahasiswa(){
        return $this->hasMany('App\Mahasiswa', 'id_kelas');
    }

}
