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
        Schema::create('perkembangan_proyek', function (Blueprint $table) {
            $table->id();
            $table->string('kode_perkembangan_proyek')->unique();
            $table->string('kode_proyek');
            $table->bigInteger('nip');
            $table->string('keterangan');
            $table->date('tanggal_dibuat');
            $table->string('foto');
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
        Schema::dropIfExists('perkembangan_proyek');
    }
};
