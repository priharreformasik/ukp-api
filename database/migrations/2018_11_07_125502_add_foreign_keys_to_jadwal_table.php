<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToJadwalTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('jadwal', function(Blueprint $table)
		{
			$table->foreign('psikolog_id', 'jadwal_ibfk_1')->references('id')->on('psikolog')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('layanan_id', 'jadwal_ibfk_2')->references('id')->on('layanan')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('tes_id', 'jadwal_ibfk_3')->references('id')->on('tes')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('ruangan_id', 'jadwal_ibfk_4')->references('id')->on('ruangan')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('jadwal', function(Blueprint $table)
		{
			$table->dropForeign('jadwal_ibfk_1');
			$table->dropForeign('jadwal_ibfk_2');
			$table->dropForeign('jadwal_ibfk_3');
			$table->dropForeign('jadwal_ibfk_4');
		});
	}

}
