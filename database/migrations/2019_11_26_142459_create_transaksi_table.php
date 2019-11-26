<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTransaksiTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('transaksi', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('biaya_registrasi', 40)->nullable();
			$table->string('foto')->nullable();
			$table->integer('jadwal_id')->nullable()->index('jadwal_id');
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
		Schema::drop('transaksi');
	}

}
