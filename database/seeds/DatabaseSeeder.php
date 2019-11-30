<?php

use Illuminate\Database\Seeder;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = new User;
        $user->name = 'Developer';
        $user->email = 'dev@gmail.com';
        $user->password = bcrypt('123456');
        $user->level = 'Super Admin';
        $user->username = 'dev123';
        $user->nik = '3309876789991';
        $user->tanggal_lahir = '1997-11-11';
        $user->jenis_kelamin = 'Perempuan';
        $user->alamat = 'Yogyakarta';
        $user->no_telepon = '087987987877';
        $user->foto = null;
        $user->save();
        $this->call(LayananTableSeeder::class);
        $this->call(RuanganTableSeeder::class);
        $this->call(SesiTableSeeder::class);
        $this->call(StatusTableSeeder::class);
        $this->call(AsesmenChargeTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(KlienTableSeeder::class);
        $this->call(PsikologTableSeeder::class);
    }
}
