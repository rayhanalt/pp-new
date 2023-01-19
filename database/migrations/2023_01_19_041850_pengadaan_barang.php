<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengadaan_barang', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pengadaan_barang')->unique();
            $table->bigInteger('nip');
            $table->string('kode_proyek');
            $table->string('nama_barang');
            $table->integer('harga_barang');
            $table->string('keterangan');
            $table->date('tgl_dibuat');
            $table->string('status');
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
        Schema::dropIfExists('pengadaan_barang');
    }
};
