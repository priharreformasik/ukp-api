<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLayananRuanganTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('layanan_ruangan', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('layanan_id')->index('fk_layanan_ruangan_layanan');
            $table->integer('ruangan_id')->index('fk_layanan_ruangan_ruangan');
            $table->timestamps();
            $table->foreign('layanan_id', 'fk_layanan_ruangan_layanan')->references('id')->on('layanan')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('ruangan_id', 'fk_layanan_ruangan_ruangan')->references('id')->on('ruangan')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('layanan_ruangan');
    }
}
