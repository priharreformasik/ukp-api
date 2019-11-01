<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateJadwalTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('jadwal', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('hari', 25);
			$table->date('tanggal');
			$table->string('jam', 30)->nullable();
			$table->integer('klien_id')->nullable()->index('klien_id');
			$table->text('keluhan', 65535)->nullable();
			$table->integer('layanan_id')->nullable()->index('layanan_id');
			$table->integer('tes_id')->nullable()->index('tes_id');
			$table->integer('ruangan_id')->nullable()->index('ruangan_id');
			$table->integer('psikolog_id')->nullable()->index('jadwal_ibfk_1');
			$table->enum('status', array('Terjadwal','Selesai','Konfirmasi','Belum Konfirmasi'))->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('jadwal');
	}

}
