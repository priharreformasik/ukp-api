<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTransaksiAsesmenTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('transaksi_asesmen', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('transaksi_id')->nullable()->index('transaksi_id');
			$table->integer('asesmen_id')->nullable()->index('asesmen_id');
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
		Schema::drop('transaksi_asesmen');
	}

}
