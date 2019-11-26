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
			$table->string('nama');
			$table->text('deskripsi', 65535);
			$table->integer('harga');
			$table->string('foto')->nullable();
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
		Schema::drop('layanan');
	}

}
