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
			$table->date('tanggal');
			$table->integer('sesi_id')->index('sesi_id');
			$table->integer('klien_id')->nullable()->index('klien_id');
			$table->text('keluhan', 65535)->nullable();
			$table->integer('layanan_id')->nullable()->index('layanan_id');
			$table->integer('ruangan_id')->nullable()->index('ruangan_id');
			$table->integer('psikolog_id')->nullable()->index('jadwal_ibfk_1');
			$table->integer('status_id')->nullable()->index('status_id');
			$table->timestamps();
			$table->softDeletes();
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
