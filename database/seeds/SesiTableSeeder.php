<?php

use Illuminate\Database\Seeder;

class SesiTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('sesi')->delete();
        
        \DB::table('sesi')->insert(array (
            0 => 
            array (
                'id' => 12,
                'nama' => 'Sesi 1',
                'jam' => '08:00 AM - 10:00 AM',
                'layanan_id' => NULL,
                'created_at' => '2019-01-08 23:21:59',
                'updated_at' => '2019-01-08 16:21:59',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 13,
                'nama' => 'Sesi 2',
                'jam' => '10:00 AM - 12:00 PM',
                'layanan_id' => NULL,
                'created_at' => '2019-03-11 17:04:24',
                'updated_at' => '2019-03-11 17:04:24',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 14,
                'nama' => 'Sesi 3',
                'jam' => '12:30 PM - 02:00 PM',
                'layanan_id' => NULL,
                'created_at' => '2019-04-22 01:35:06',
                'updated_at' => '2019-04-22 01:35:06',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 15,
                'nama' => 'Sesi 4',
                'jam' => '02:00 PM - 04:00 PM',
                'layanan_id' => NULL,
                'created_at' => '2019-04-22 01:34:06',
                'updated_at' => '2019-04-22 01:34:06',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}