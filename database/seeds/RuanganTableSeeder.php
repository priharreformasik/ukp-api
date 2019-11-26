<?php

use Illuminate\Database\Seeder;

class RuanganTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('ruangan')->delete();
        
        \DB::table('ruangan')->insert(array (
            0 => 
            array (
                'id' => 3,
                'nama' => 'D-205-UKP',
                'deskripsi' => 'Fakultas Psikologi Gedung D UKP',
                'created_at' => '2018-12-16 16:39:38',
                'updated_at' => '2019-03-27 17:46:40',
                'deleted_at' => NULL,
                'layanan_id' => NULL,
            ),
            1 => 
            array (
                'id' => 4,
                'nama' => 'D-206-UKP',
                'deskripsi' => 'Fakultas Psikologi Gedung D UKP',
                'created_at' => '2018-12-16 16:44:55',
                'updated_at' => '2019-03-27 17:46:51',
                'deleted_at' => NULL,
                'layanan_id' => NULL,
            ),
            2 => 
            array (
                'id' => 25,
                'nama' => 'D-207 UKP',
                'deskripsi' => 'Fakultas Psikologi Gedung D UKP',
                'created_at' => '2019-02-18 22:14:39',
                'updated_at' => '2019-03-27 17:47:07',
                'deleted_at' => NULL,
                'layanan_id' => NULL,
            ),
            3 => 
            array (
                'id' => 26,
                'nama' => 'D-208 UKP',
                'deskripsi' => 'Fakultas Psikologi Gedung D UKP',
                'created_at' => '2019-02-18 22:14:52',
                'updated_at' => '2019-03-27 17:47:18',
                'deleted_at' => NULL,
                'layanan_id' => NULL,
            ),
            4 => 
            array (
                'id' => 27,
                'nama' => 'D-209 UKP',
                'deskripsi' => 'Fakultas Psikologi Gedung D UKP',
                'created_at' => '2019-03-23 16:38:21',
                'updated_at' => '2019-03-27 17:48:14',
                'deleted_at' => NULL,
                'layanan_id' => NULL,
            ),
            5 => 
            array (
                'id' => 30,
                'nama' => 'D-210 UKP',
                'deskripsi' => 'Fakultas Psikologi Gedung D UKP',
                'created_at' => '2019-03-27 17:47:51',
                'updated_at' => '2019-03-29 23:43:06',
                'deleted_at' => NULL,
                'layanan_id' => NULL,
            ),
        ));
        
        
    }
}