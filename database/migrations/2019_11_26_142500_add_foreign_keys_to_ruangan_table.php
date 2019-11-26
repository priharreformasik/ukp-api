<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToRuanganTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('ruangan', function(Blueprint $table)
		{
			$table->foreign('layanan_id', 'ruangan_ibfk_1')->references('id')->on('layanan')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('ruangan', function(Blueprint $table)
		{
			$table->dropForeign('ruangan_ibfk_1');
		});
	}

}
