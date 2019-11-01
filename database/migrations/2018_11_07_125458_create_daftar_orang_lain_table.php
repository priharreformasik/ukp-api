<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDaftarOrangLainTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('daftar_orang_lain', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->enum('jenis_kelamin', array('Laki-laki','Permpuan'));
			$table->integer('tanggal_lahir');
			$table->integer('anak_ke');
			$table->integer('jumlah_saudara');
			$table->enum('pendidikan_terakhir', array('SD','SMP','SMA','S1','S2','S3'));
			$table->string('hub_pendaftar');
			$table->integer('klien_id');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('daftar_orang_lain');
	}

}
