<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLayananTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('layanan', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('nama', 100);
			$table->string('deskripsi');
			$table->integer('harga');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('layanan');
	}

}
