<?php

use Illuminate\Database\Seeder;

class PsikologTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('psikolog')->delete();
        
        \DB::table('psikolog')->insert(array (
            0 => 
            array (
                'id' => 1,
                'gelar' => 'mpsi',
                'no_sipp' => '75237509522552',
                'user_id' => 2,
                'created_at' => '2019-11-26 22:17:41',
                'updated_at' => '2019-11-26 22:17:41',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'gelar' => 'mpsi',
                'no_sipp' => '534326462386',
                'user_id' => 4,
                'created_at' => '2019-11-27 15:41:21',
                'updated_at' => '2019-11-27 15:41:21',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'gelar' => 'Mpsi',
                'no_sipp' => '65835982925',
                'user_id' => 5,
                'created_at' => '2019-11-27 15:45:11',
                'updated_at' => '2019-11-27 15:45:11',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}