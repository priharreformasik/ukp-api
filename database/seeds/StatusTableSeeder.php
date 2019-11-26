<?php

use Illuminate\Database\Seeder;

class StatusTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('status')->delete();
        
        \DB::table('status')->insert(array (
            0 => 
            array (
                'id' => 5,
                'nama' => 'Pengalihan Psikolog',
                'deskripsi' => 'Kondisi dimana psikolog mengalihkan permintaan klien atau menolak permintaan klien, sehingga admin dapat memilihkan psikolog',
                'created_at' => '2019-03-05 14:01:33',
                'updated_at' => '2019-03-05 14:01:33',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 6,
                'nama' => 'Menunggu Konfirmasi',
                'deskripsi' => 'Kondisi dimana psikolog belum konfirmasi permintaan klien',
                'created_at' => '2019-02-17 22:51:47',
                'updated_at' => '2019-02-17 22:51:47',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 7,
                'nama' => 'Terjadwal',
                'deskripsi' => 'Kondisi dimana konsultasi telah terjadwal',
                'created_at' => '2019-02-17 22:02:29',
                'updated_at' => '2019-02-17 22:02:29',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 10,
                'nama' => 'Selesai',
                'deskripsi' => 'Kondisi dimana konsultasi telah dilaksanakan',
                'created_at' => '2019-02-17 22:01:51',
                'updated_at' => '2019-02-17 22:01:51',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 12,
                'nama' => 'Konfirmasi Pengalihan Psikolog',
                'deskripsi' => 'Persetujuan klien ketika psikolog akan dialihkan',
                'created_at' => '2019-04-11 00:20:24',
                'updated_at' => '2019-04-11 00:20:24',
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 13,
                'nama' => 'Dibatalkan',
                'deskripsi' => 'Ketika klien membatalkan konsultasi',
                'created_at' => '2019-04-11 00:21:36',
                'updated_at' => '2019-04-11 00:21:36',
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 34,
                'nama' => 'cekYA',
                'deskripsi' => 'TA',
                'created_at' => '2019-04-11 00:22:15',
                'updated_at' => '2019-04-11 00:22:15',
                'deleted_at' => '2019-04-11 00:22:15',
            ),
            7 => 
            array (
                'id' => 35,
                'nama' => 'Palsu',
                'deskripsi' => 'Cek',
                'created_at' => '2019-04-22 01:33:36',
                'updated_at' => '2019-04-22 01:33:36',
                'deleted_at' => '2019-04-22 01:33:36',
            ),
            8 => 
            array (
                'id' => 36,
                'nama' => 'Risol mayo',
                'deskripsi' => 'makanan',
                'created_at' => '2019-04-22 01:33:31',
                'updated_at' => '2019-04-22 01:33:31',
                'deleted_at' => '2019-04-22 01:33:31',
            ),
            9 => 
            array (
                'id' => 37,
                'nama' => 'Konfirmasi Pembayaran',
                'deskripsi' => 'Admin mengkonfirmasi pembayaran dan menentukan ruangan',
                'created_at' => '2019-11-26 15:20:53',
                'updated_at' => '2019-11-26 15:20:53',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}