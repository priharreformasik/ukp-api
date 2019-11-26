<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSesiTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('sesi', function(Blueprint $table)
		{
			$table->foreign('layanan_id', 'sesi_ibfk_1')->references('id')->on('layanan')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('sesi', function(Blueprint $table)
		{
			$table->dropForeign('sesi_ibfk_1');
		});
	}

}
