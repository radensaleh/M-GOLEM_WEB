<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbPeminjamanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_peminjaman', function (Blueprint $table) {
            $table->string('id_pinjam', 5)->primary();
            $table->string('nim', 10)->index();
            $table->foreign('nim')->references('nim')->on('tb_mahasiswa');
            $table->string('username', 13)->index();
            $table->foreign('username')->references('username')->on('tb_teknisi');
            $table->string('nama_kegiatan');
            $table->date('tgl_pinjam');
            $table->date('tgl_kembali');
            $table->integer('status', false, true)->length(2);
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
        Schema::dropIfExists('tb_peminjaman');
    }
}
