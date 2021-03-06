<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePsikologTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('psikolog', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('gelar', 40)->nullable();
			$table->string('no_sipp', 100)->nullable();
			$table->integer('keahlian_id')->nullable()->index('keahlian_id');
			$table->integer('user_id')->unsigned()->nullable()->index('user_id');
			$table->integer('created_by')->nullable();
			$table->integer('updated_by')->nullable();
			$table->timestamps();
			$table->softDeletes();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('psikolog');
	}

}
