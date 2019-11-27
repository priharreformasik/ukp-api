<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Developer',
                'email' => 'dev@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$aha2NqkDAVpHFU36XhfSf.pGBDmja6rpWBkfPngm7VbRi1ZNqcOce',
                'remember_token' => NULL,
                'level' => 'Super Admin',
                'username' => 'dev123',
                'nik' => '3309876789991',
                'tanggal_lahir' => '1997-11-11',
                'jenis_kelamin' => 'Perempuan',
                'alamat' => 'Yogyakarta',
                'no_telepon' => '087987987877',
                'foto' => NULL,
                'isActive' => NULL,
                'fcm_token' => NULL,
                'status' => NULL,
                'created_at' => '2019-11-26 17:28:34',
                'updated_at' => '2019-11-26 17:28:34',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'psikolog A',
                'email' => 'ps@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$NPfS96Yh3SevTpeJs32PwO7lVwXd3HSwN7zLbHFu5BTcGvc4BkaMy',
                'remember_token' => NULL,
                'level' => 'Psikolog',
                'username' => 'psa',
                'nik' => '4235325345464',
                'tanggal_lahir' => '2019-11-01',
                'jenis_kelamin' => 'Perempuan',
                'alamat' => 'Yogya',
                'no_telepon' => '09097532042413',
                'foto' => '4235325345464.jpeg',
                'isActive' => 'Aktif',
                'fcm_token' => NULL,
                'status' => 'Approved',
                'created_at' => '2019-11-26 22:17:41',
                'updated_at' => '2019-11-26 22:17:41',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'klien A',
                'email' => 'klien@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$stCSvlCpLJ7cekuoYfJdvu7Lv7a2r92dAfrJp7HW420stN3GRrgLS',
                'remember_token' => NULL,
                'level' => 'Klien',
                'username' => 'kliena',
                'nik' => '123456789087666',
                'tanggal_lahir' => '2019-11-20',
                'jenis_kelamin' => 'Laki-laki',
                'alamat' => 'yogya',
                'no_telepon' => '089993759345793',
                'foto' => '123456789087666.jpeg',
                'isActive' => NULL,
                'fcm_token' => NULL,
                'status' => NULL,
                'created_at' => '2019-11-26 22:19:06',
                'updated_at' => '2019-11-26 22:19:06',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Psikolog B',
                'email' => 'psikologb@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$QkNl/1TPzwYQRD/ODMjkOuYM2nnOqX6koDBCwdQokIBnY.8UoGf3C',
                'remember_token' => NULL,
                'level' => 'Psikolog',
                'username' => 'psikologb',
                'nik' => '798972382740274',
                'tanggal_lahir' => '2019-11-05',
                'jenis_kelamin' => 'Perempuan',
                'alamat' => 'Yogyakarta',
                'no_telepon' => '078989797973834',
                'foto' => '798972382740274.jpeg',
                'isActive' => 'Aktif',
                'fcm_token' => NULL,
                'status' => 'Approved',
                'created_at' => '2019-11-27 15:41:21',
                'updated_at' => '2019-11-27 15:41:21',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'psikolog c',
                'email' => 'psikologc@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$r3xQMUrB3VdyxgJ3SDMnvezOBtrDBPFE/65XBHXYmD8LVQaJubeSC',
                'remember_token' => NULL,
                'level' => 'Psikolog',
                'username' => 'psikologc',
                'nik' => '123456789098',
                'tanggal_lahir' => '2019-11-01',
                'jenis_kelamin' => 'Laki-laki',
                'alamat' => 'Yogyakarta',
                'no_telepon' => '0899786879997',
                'foto' => '123456789098.jpeg',
                'isActive' => 'Aktif',
                'fcm_token' => NULL,
                'status' => 'Approved',
                'created_at' => '2019-11-27 15:45:11',
                'updated_at' => '2019-11-27 15:45:11',
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'klien b',
                'email' => 'klienb@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$TYrmDmfvl4jlbyxLlWjfJ.KTNjEAaYyR7g4WaS4rUpNpZZe/D8ly6',
                'remember_token' => NULL,
                'level' => 'Klien',
                'username' => 'klienb',
                'nik' => '68789986989797',
                'tanggal_lahir' => '2019-11-13',
                'jenis_kelamin' => 'Perempuan',
                'alamat' => 'yogya',
                'no_telepon' => '0897878798979',
                'foto' => '68789986989797.jpeg',
                'isActive' => NULL,
                'fcm_token' => NULL,
                'status' => NULL,
                'created_at' => '2019-11-27 15:49:43',
                'updated_at' => '2019-11-27 15:49:43',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}