<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbBarangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_barang', function (Blueprint $table) {
            $table->string('id_barang', 5)->primary();
            $table->string('id_kategori', 5)->index();
            $table->foreign('id_kategori')->references('id_kategori')->on('tb_kategori');
            $table->string('id_merk', 5)->index();
            $table->foreign('id_merk')->references('id_merk')->on('tb_merk');
            $table->string('id_tipe', 5)->index();
            $table->foreign('id_tipe')->references('id_tipe')->on('tb_tipe');
            $table->integer('kuantitas', false, true)->length(10);
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
        Schema::dropIfExists('tb_barang');
    }
}
