<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 191);
			$table->string('email', 191)->nullable()->unique();
			$table->dateTime('email_verified_at')->nullable();
			$table->string('password', 191);
			$table->string('remember_token', 100)->nullable();
			$table->string('level', 191)->nullable();
			$table->string('username', 191)->nullable()->unique('username');
			$table->char('nik', 20)->nullable()->unique('nik');
			$table->date('tanggal_lahir')->nullable();
			$table->enum('jenis_kelamin', array('Laki-laki','Perempuan'))->nullable();
			$table->text('alamat', 65535)->nullable();
			$table->string('no_telepon', 40)->nullable();
			$table->string('foto', 191)->nullable();
			$table->enum('isActive', array('Aktif','Tidak Aktif',''))->nullable();
			$table->string('fcm_token')->nullable();
			$table->enum('status', array('Approved','Not Approved'))->nullable();
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
		Schema::drop('users');
	}

}
