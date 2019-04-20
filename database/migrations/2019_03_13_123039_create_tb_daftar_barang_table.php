<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbDaftarBarangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_daftar_barang', function (Blueprint $table) {
            $table->string('id_list', 5)->primary();
            $table->string('id_pinjam', 5)->index();
            $table->foreign('id_pinjam')->references('id_pinjam')->on('tb_peminjaman');
            $table->string('id_barang', 5)->index();
            $table->foreign('id_barang')->references('id_barang')->on('tb_barang');
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
        Schema::dropIfExists('tb_daftar_barang');
    }
}
