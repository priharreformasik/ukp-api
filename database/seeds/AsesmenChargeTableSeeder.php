<?php

use Illuminate\Database\Seeder;

class AsesmenChargeTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('asesmen_charge')->delete();
        
        \DB::table('asesmen_charge')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nama' => 'Asesmen kepribadian',
                'deskripsi' => 'mengetes kepribadian',
                'harga' => '250000',
                'layanan_id' => 14,
                'created_at' => NULL,
                'updated_at' => '2019-11-24 18:18:13',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'nama' => 'aaaab',
                'deskripsi' => 'aaaab',
                'harga' => '50001',
                'layanan_id' => 15,
                'created_at' => '2019-11-24 12:55:16',
                'updated_at' => '2019-11-24 13:02:05',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'nama' => 'bbb',
                'deskripsi' => 'bbb',
                'harga' => '80000',
                'layanan_id' => 15,
                'created_at' => '2019-11-24 12:56:13',
                'updated_at' => '2019-11-24 12:56:13',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}