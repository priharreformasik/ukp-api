<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTransaksiAsesmenTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('transaksi_asesmen', function(Blueprint $table)
		{
			$table->foreign('transaksi_id', 'transaksi_asesmen_ibfk_1')->references('id')->on('transaksi')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('asesmen_id', 'transaksi_asesmen_ibfk_2')->references('id')->on('asesmen_charge')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('transaksi_asesmen', function(Blueprint $table)
		{
			$table->dropForeign('transaksi_asesmen_ibfk_1');
			$table->dropForeign('transaksi_asesmen_ibfk_2');
		});
	}

}
