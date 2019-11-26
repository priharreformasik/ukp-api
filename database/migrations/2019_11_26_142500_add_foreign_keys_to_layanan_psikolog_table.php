<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToLayananPsikologTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('layanan_psikolog', function(Blueprint $table)
		{
			$table->foreign('layanan_id', 'fk_layanan_psikolog_layanan')->references('id')->on('layanan')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('psikolog_id', 'fk_layanan_psikolog_psikolog')->references('id')->on('psikolog')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('layanan_psikolog', function(Blueprint $table)
		{
			$table->dropForeign('fk_layanan_psikolog_layanan');
			$table->dropForeign('fk_layanan_psikolog_psikolog');
		});
	}

}
