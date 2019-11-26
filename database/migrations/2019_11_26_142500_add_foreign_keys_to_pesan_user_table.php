<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPesanUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('pesan_user', function(Blueprint $table)
		{
			$table->foreign('user_id', 'pesan_user_ibfk_1')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('pesan_id', 'pesan_user_ibfk_2')->references('id')->on('pesan')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('pesan_user', function(Blueprint $table)
		{
			$table->dropForeign('pesan_user_ibfk_1');
			$table->dropForeign('pesan_user_ibfk_2');
		});
	}

}
