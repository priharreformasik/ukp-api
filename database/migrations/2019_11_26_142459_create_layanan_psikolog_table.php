<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLayananPsikologTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('layanan_psikolog', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('layanan_id')->index('fk_layanan_psikolog_layanan');
			$table->integer('psikolog_id')->index('fk_layanan_psikolog_psikolog');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('layanan_psikolog');
	}

}
