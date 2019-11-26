<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLayananSesiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('layanan_sesi', function (Blueprint $table) {
            $table->increments('id');            
            $table->integer('layanan_id')->index('fk_layanan_sesi_layanan');
            $table->integer('sesi_id')->index('fk_layanan_sesi_sesi');
            $table->timestamps();
            $table->foreign('layanan_id', 'fk_layanan_sesi_layanan')->references('id')->on('layanan')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('sesi_id', 'fk_layanan_sesi_sesi')->references('id')->on('sesi')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('layanan_sesi');
    }
}
