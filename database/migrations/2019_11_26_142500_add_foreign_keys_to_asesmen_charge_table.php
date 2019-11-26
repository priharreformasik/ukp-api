<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAsesmenChargeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('asesmen_charge', function(Blueprint $table)
		{
			$table->foreign('layanan_id', 'asesmen_charge_ibfk_1')->references('id')->on('layanan')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('asesmen_charge', function(Blueprint $table)
		{
			$table->dropForeign('asesmen_charge_ibfk_1');
		});
	}

}
