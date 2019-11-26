<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToKlienTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('klien', function(Blueprint $table)
		{
			$table->foreign('user_id', 'klien_ibfk_1')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('kategori_id', 'klien_ibfk_2')->references('id')->on('kategori_klien')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('klien', function(Blueprint $table)
		{
			$table->dropForeign('klien_ibfk_1');
			$table->dropForeign('klien_ibfk_2');
		});
	}

}
