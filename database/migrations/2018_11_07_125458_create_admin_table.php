<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAdminTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('admin', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('nama', 100);
			$table->enum('jenis_kelamin', array('Laki-laki','Perempuan'));
			$table->date('tanggal_lahir');
			$table->string('nik', 100);
			$table->string('email');
			$table->string('no_telepon', 25);
			$table->string('alamat');
			$table->string('foto')->nullable();
			$table->string('username', 100);
			$table->string('password', 100);
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
		Schema::drop('admin');
	}

}
