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
			$table->enum('pendidikan_terakhir', array('SD','SMP','SMA','D3','S1','S2','S3'));
			$table->integer('anak_ke')->nullable();
			$table->integer('jumlah_saudara')->nullable();
			$table->integer('user_id')->unsigned()->nullable()->index('klien_ibfk_1');
			$table->timestamps();
			$table->softDeletes();
			$table->integer('kategori_id')->nullable()->index('kategori_id');
			$table->integer('parent_id')->nullable();
			$table->string('hub_pendaftar', 50)->nullable();
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
