<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRuanganTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ruangan', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('nama', 40)->nullable();
			$table->text('deskripsi', 65535)->nullable();
			$table->timestamps();
			$table->softDeletes();
			$table->integer('layanan_id')->nullable()->index('layanan_id');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ruangan');
	}

}
