<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateKlienTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('klien', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->enum('pendidikan_terakhir', array('SD','SMP','SMA','S1','S2','S3'));
			$table->integer('anak_ke');
			$table->integer('jumlah_saudara');
			$table->integer('user_id')->unsigned()->nullable();
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
		Schema::drop('klien');
	}

}
