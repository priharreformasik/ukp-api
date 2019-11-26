<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTransaksiTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('transaksi', function(Blueprint $table)
		{
			$table->foreign('jadwal_id', 'transaksi_ibfk_1')->references('id')->on('jadwal')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('transaksi', function(Blueprint $table)
		{
			$table->dropForeign('transaksi_ibfk_1');
		});
	}

}
