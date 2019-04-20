<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbMahasiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_mahasiswa', function (Blueprint $table) {
            $table->string('nim', 10)->primary();
            $table->string('nama_mhs', 50);
            $table->string('id_kelas', 5)->index();
            $table->foreign('id_kelas')->references('id_kelas')->on('tb_kelas');
            $table->string('password');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_mahasiswa');
    }
}
