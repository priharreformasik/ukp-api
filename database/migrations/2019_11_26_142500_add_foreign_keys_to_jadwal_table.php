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
			$table->foreign('psikolog_id', 'jadwal_ibfk_1')->references('id')->on('psikolog')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('layanan_id', 'jadwal_ibfk_2')->references('id')->on('layanan')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('ruangan_id', 'jadwal_ibfk_4')->references('id')->on('ruangan')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('sesi_id', 'jadwal_ibfk_5')->references('id')->on('sesi')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('status_id', 'jadwal_ibfk_6')->references('id')->on('status')->onUpdate('CASCADE')->onDelete('CASCADE');
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
			$table->dropForeign('jadwal_ibfk_4');
			$table->dropForeign('jadwal_ibfk_5');
			$table->dropForeign('jadwal_ibfk_6');
		});
	}

}
