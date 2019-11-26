<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPsikologTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('psikolog', function(Blueprint $table)
		{
			$table->foreign('user_id', 'psikolog_ibfk_2')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('psikolog', function(Blueprint $table)
		{
			$table->dropForeign('psikolog_ibfk_2');
		});
	}

}
