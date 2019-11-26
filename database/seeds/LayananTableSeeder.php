<?php

use Illuminate\Database\Seeder;

class LayananTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('layanan')->delete();
        
        \DB::table('layanan')->insert(array (
            0 => 
            array (
                'id' => 14,
                'nama' => 'Rekomendasi Sekolah',
                'deskripsi' => 'Pelayanan asesmen psikologi dan konseling bagi calon siswa SD',
                'harga' => 300000,
                'foto' => 'Rekomendasi Sekolah.jpeg',
                'created_at' => '2019-04-21 21:48:24',
                'updated_at' => '2019-04-21 21:48:24',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 15,
                'nama' => 'Minat Bakat Sekolah',
                'deskripsi' => 'Pelayanan asesmen psikologi dan konseling bagi : 
- Penjurusan IPA/IPS 
- Penjurusan Kuliah',
                'harga' => 350000,
                'foto' => 'Minat Bakat Sekolah.jpeg',
                'created_at' => '2019-04-21 23:35:01',
                'updated_at' => '2019-04-21 23:35:01',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 16,
                'nama' => 'Minat Bakat Kerja',
                'deskripsi' => 'Pelayanan asesmen psikologi dan konseling bagi pengembangan individu di dunia kerja',
                'harga' => 350000,
                'foto' => 'Minat Bakat Kerja.jpeg',
                'created_at' => '2019-04-21 23:35:13',
                'updated_at' => '2019-04-21 23:35:13',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 19,
                'nama' => 'Konsultasi Pribadi : Anak - anak',
                'deskripsi' => 'Pelayanan asesmen psikologi dan konseling bagi kasus pribadi anak-anak',
                'harga' => 280000,
                'foto' => 'Konsultasi Pribadi : Anak - anak.jpeg',
                'created_at' => '2019-04-21 23:35:25',
                'updated_at' => '2019-04-21 23:35:25',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 20,
                'nama' => 'Konsultasi Pribadi : Dewasa',
                'deskripsi' => 'Pelayanan asesmen psikologi dan konseling bagi kasus pribadi dewasa',
                'harga' => 250000,
                'foto' => 'Konsultasi Pribadi : Dewasa.jpeg',
                'created_at' => '2019-04-21 23:35:39',
                'updated_at' => '2019-04-21 23:35:39',
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 43,
                'nama' => 'Rumah Tangga',
                'deskripsi' => 'Pelayanan asesmen psikologi dan konseling bagi permasalahan di dalam keluarga, seperti permasalahan dengan pasangan, berkaitan dengan kesalahpahaman, pola komunikasi, pembagian peran, intimasi, keturunan, dll.',
                'harga' => 250000,
                'foto' => 'Rumah Tangga.jpeg',
                'created_at' => '2019-04-21 23:35:51',
                'updated_at' => '2019-04-21 23:35:51',
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 49,
                'nama' => 'cek ya',
                'deskripsi' => 'cek y',
                'harga' => 70,
                'foto' => 'layanan.jpg',
                'created_at' => '2019-04-11 00:13:19',
                'updated_at' => '2019-04-11 00:13:19',
                'deleted_at' => '2019-04-11 00:13:19',
            ),
            7 => 
            array (
                'id' => 50,
                'nama' => 'ghghg',
                'deskripsi' => 'cxg',
                'harga' => 46487,
                'foto' => '.jpeg',
                'created_at' => '2019-04-11 00:14:01',
                'updated_at' => '2019-04-11 00:14:01',
                'deleted_at' => '2019-04-11 00:14:01',
            ),
            8 => 
            array (
                'id' => 51,
                'nama' => 'bfksja',
                'deskripsi' => 'HDHDLKAHLK',
                'harga' => 569284,
                'foto' => 'layanan.jpg',
                'created_at' => '2019-04-20 10:30:28',
                'updated_at' => '2019-04-20 10:30:28',
                'deleted_at' => '2019-04-20 10:30:28',
            ),
            9 => 
            array (
                'id' => 52,
                'nama' => 'adaf',
                'deskripsi' => 'ssgh1454',
                'harga' => 357,
                'foto' => 'layanan.jpg',
                'created_at' => '2019-04-20 10:30:19',
                'updated_at' => '2019-04-20 10:30:19',
                'deleted_at' => '2019-04-20 10:30:19',
            ),
            10 => 
            array (
                'id' => 53,
                'nama' => 'Kerja',
                'deskripsi' => 'kerja',
                'harga' => 70,
                'foto' => '.jpeg',
                'created_at' => '2019-04-20 23:37:37',
                'updated_at' => '2019-04-20 23:37:37',
                'deleted_at' => '2019-04-20 23:37:37',
            ),
            11 => 
            array (
                'id' => 54,
                'nama' => '0',
                'deskripsi' => '0',
                'harga' => 96,
                'foto' => 'layanan.jpg',
                'created_at' => '2019-04-21 21:42:48',
                'updated_at' => '2019-04-21 21:42:48',
                'deleted_at' => '2019-04-21 21:42:48',
            ),
            12 => 
            array (
                'id' => 55,
                'nama' => 'pijet',
                'deskripsi' => 'pijet',
                'harga' => 1000000,
                'foto' => 'layanan.jpg',
                'created_at' => '2019-04-21 18:52:19',
                'updated_at' => '2019-04-21 18:52:19',
                'deleted_at' => '2019-04-21 18:52:19',
            ),
            13 => 
            array (
                'id' => 56,
                'nama' => '00',
                'deskripsi' => '00',
                'harga' => 6,
                'foto' => 'layanan.jpg',
                'created_at' => '2019-04-21 21:42:32',
                'updated_at' => '2019-04-21 21:42:32',
                'deleted_at' => '2019-04-21 21:42:32',
            ),
            14 => 
            array (
                'id' => 57,
                'nama' => 'nana',
                'deskripsi' => 'nana',
                'harga' => 90,
                'foto' => 'layanan.jpg',
                'created_at' => '2019-04-21 21:59:56',
                'updated_at' => '2019-04-21 21:59:56',
                'deleted_at' => '2019-04-21 21:59:56',
            ),
            15 => 
            array (
                'id' => 58,
                'nama' => 'Layanan anak',
                'deskripsi' => 'Melayani anak',
                'harga' => 200000,
                'foto' => 'Layanan anak.jpeg',
                'created_at' => '2019-04-22 09:32:19',
                'updated_at' => '2019-04-22 09:32:19',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}