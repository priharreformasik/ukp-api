<?php

use Illuminate\Database\Seeder;

class KlienTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('klien')->delete();
        
        \DB::table('klien')->insert(array (
            0 => 
            array (
                'id' => 1,
                'pendidikan_terakhir' => 'SMA',
                'anak_ke' => 1,
                'jumlah_saudara' => 1,
                'user_id' => 3,
                'created_at' => '2019-11-26 22:19:06',
                'updated_at' => '2019-11-26 22:19:06',
                'deleted_at' => NULL,
                'kategori_id' => NULL,
                'parent_id' => NULL,
                'hub_pendaftar' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'pendidikan_terakhir' => 'D3',
                'anak_ke' => 1,
                'jumlah_saudara' => 2,
                'user_id' => 6,
                'created_at' => '2019-11-27 15:49:43',
                'updated_at' => '2019-11-27 15:49:43',
                'deleted_at' => NULL,
                'kategori_id' => NULL,
                'parent_id' => NULL,
                'hub_pendaftar' => NULL,
            ),
        ));
        
        
    }
}