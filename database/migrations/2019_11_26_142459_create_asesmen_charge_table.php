<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAsesmenChargeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('asesmen_charge', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('nama', 40)->nullable();
			$table->text('deskripsi', 65535)->nullable();
			$table->string('harga', 40)->nullable();
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
		Schema::drop('asesmen_charge');
	}

}
