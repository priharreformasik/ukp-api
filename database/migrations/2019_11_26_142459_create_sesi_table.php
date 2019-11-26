<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSesiTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sesi', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('nama', 50)->nullable();
			$table->string('jam', 40)->nullable();
			$table->integer('layanan_id')->nullable()->index('layanan_id');
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
		Schema::drop('sesi');
	}

}
