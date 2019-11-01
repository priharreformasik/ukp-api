<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
/*======================== START OF USER ==============================*/
Route::middleware('auth:api')->get('/psikolog', 'API\PsikologController@list');
Route::middleware('auth:api')->get('/klien', 'API\KlienController@list');
Route::middleware('auth:api')->get('logout', 'API\UserController@logout');
Route::middleware('auth:api')->get('/delete/{id}', 'API\UserController@destroy');
// Route::middleware('auth:api')->post('/pendafatar', 'API\KlienController@pendaftar');
Route::middleware('auth:api')->put('/update_token/{id}', 'API\UserController@update_token');// dipake
Route::middleware('auth:api')->put('/updateStatusAktif/{id}', 'API\UserController@updateStatusAktif');// dipake

/*======================== END OF USER ==============================*/

/*======================== START OF DATA MASTER ==============================*/
/*==START TES==*/
Route::middleware('auth:api')->get('/tes', 'TesController@tes');
Route::middleware('auth:api')->post('/store_api', 'TesController@store_api');
Route::middleware('auth:api')->put('/update_tes/{id}', 'TesController@update_tes');
/*==START TES==*/

/*==START LAYANAN==*/

Route::middleware('auth:api')->get('/layanan', 'LayananController@layanan');// dipake
Route::middleware('auth:api')->post('/layanan/store', 'LayananController@store_api');
Route::middleware('auth:api')->put('/layanan/update/{id}', 'LayananController@update_api');// dipake

/*==START LAYANAN==*/

/*==START Sesi==*/

Route::middleware('auth:api')->get('/sesi', 'SesiController@sesi');// dipake

/*==START KEAHLIAN==*/

Route::middleware('auth:api')->get('/keahlian', 'KeahlianController@layanan');
Route::middleware('auth:api')->post('/keahlian/store', 'KeahlianController@store_api');
Route::middleware('auth:api')->put('/keahlian/update/{id}', 'KeahlianController@update_api');

/*==START KEAHLIAN==*/

/*==START KATEGORI==*/

Route::middleware('auth:api')->get('/kategori', 'KategoriController@layanan');
Route::middleware('auth:api')->post('/kategori/store', 'KategoriController@store_api');
Route::middleware('auth:api')->put('/kategori/update/{id}', 'KategoriController@update_api');

/*==START KATEGORI==*/

/*==START RUANGAN==*/

Route::middleware('auth:api')->get('/ruangan', 'RuanganController@layanan');
Route::middleware('auth:api')->post('/ruangan/store', 'RuanganController@store_api');
Route::middleware('auth:api')->put('/ruangan/update/{id}', 'RuanganController@update_api');

/*==START RUANGAN==*/

/*======================== END OF DATA MASTER ==============================*/
/*==START JADWAL==*/
Route::middleware('auth:api')->get('/jadwal', 'JadwalController@jadwal');
Route::middleware('auth:api')->post('jadwal/store', 'JadwalController@store_api');// dipake
Route::middleware('auth:api')->put('jadwal/update/{id}', 'JadwalController@update_api');// dipake
Route::middleware('auth:api')->put('jadwal/updatePsikolog/{id}', 'JadwalController@updateJadwal_psikolog');// dipake
Route::middleware('auth:api')->get('jadwal/show/{id}', 'JadwalController@show_klien');// dipake
/*==END JADWAL==*/


/*==START USER==*/
Route::post('login', 'API\UserController@login');
Route::post('register', 'API\UserController@register');
Route::group(['middleware' => 'auth:api'], function(){
	Route::get('details', 'API\UserController@details');// dipake
});
/*==END USER==*/

/*==START PSIKOLOG==*/
Route::post('login/psikolog', 'API\UserController@loginPsikolog');// dipake
Route::post('register/psikolog', 'API\PsikologController@register');// dipake
Route::middleware('auth:api')->get('/psikolog', 'API\PsikologController@psikolog');
Route::get('/psikolog/list/','API\PsikologController@list');
Route::get('/psikolog/show/{id}','API\PsikologController@show');
Route::put('/psikolog/update/{id}', 'API\PsikologController@update_foto')->middleware('auth:api');// dipake
Route::put('/psikolog/update_user/{id}', 'API\PsikologController@update_user');// dipake
Route::put('/psikolog/update_biodata/{id}', 'API\PsikologController@update_biodata');// dipake
Route::middleware('api')->get('/psikolog/riwayat','API\PsikologController@riwayat_konsultasi');// dipake
Route::middleware('api')->get('/psikolog/jadwal','API\PsikologController@jadwal_konsultasi');// dipake
Route::middleware('api')->get('/psikolog/permintaan_klien','API\PsikologController@permintaan_klien');// dipake
Route::middleware('api')->get('/psikolog/cari_klien','API\PsikologController@cari_klien');// dipake

/*==END PSIKOLOG==*/

/*==START KLIEN==*/
Route::post('login/klien', 'API\UserController@loginKlien');// dipake
Route::post('register/klien', 'API\KlienController@register');// dipake


Route::middleware('auth:api')->get('/klien', 'API\KlienController@list');
Route::post('/klien/store', 'API\KlienController@store');
Route::put('/klien/update/{id}', 'API\KlienController@update');// dipake
Route::put('/klien/update_user/{id}', 'API\KlienController@update_user');
Route::get('/klien/show/{id}','API\KlienController@show');// dipake
Route::get('/klien/list/','API\KlienController@list');// dipake
Route::get('/klien/child','API\KlienController@show_child');// dipake
Route::put('/klien/update_foto/{id}', 'API\KlienController@update_foto');// dipake

Route::middleware('api')->get('/klien/riwayat','API\KlienController@riwayat_konsultasi');// dipake
Route::middleware('api')->get('/klien/jadwal','API\KlienController@jadwal_konsultasi');// dipake
Route::middleware('api')->get('/klien/riwayatChild','API\KlienController@riwayat_konsultasiChild');// dipake
Route::middleware('api')->get('/klien/jadwalChild','API\KlienController@jadwal_konsultasiChild');// dipake


Route::middleware('auth:api')->get('klien/konsultasi/{id}', 'API\KlienController@konsultasi_klien');
Route::post('/pendaftar', 'API\KlienController@pendaftar')->middleware('auth:api');// dipake
Route::post('/pendaftar_lain', 'API\KlienController@pendaftar_lain')->middleware('auth:api');// dipake
Route::put('/pendaftar_lain/update/{id}', 'API\KlienController@pendaftar_lain_update')->middleware('auth:api');// dipake
/*==END KLIEN==*/

/*JADWAL*/
Route::middleware('api')->get('/layananPsikolog','JadwalController@layananPsikolog');// dipake
Route::middleware('auth:api')->post('jadwal/getSesi', 'JadwalController@getSesi');// dipake
Route::put('ganti_password/{id}', 'API\UserController@update_password_api')->middleware('auth:api');// dipake
Route::get('detail_psikolog/{id}', 'API\PsikologController@show_psikolog')->middleware('auth:api');// dipake


Route::post('forgot/password', 'API\ForgotPasswordController')->name('forgot.password');// dipake

/*====VERIF EMAIL========*/
  Route::get('email/verify', 'API\VerificationAPIController@show');// dipake
  Route::post('email/verify', 'API\VerificationAPIController@verify');// dipake
  Route::get('email/resend', 'API\VerificationAPIController@resend');// dipake
  
  
/*DASHBOARD*/
Route::middleware('api')->get('/dashboard', function()
{
	$pengalihan_psikolog = App\Jadwal::leftjoin('status','jadwal.status_id','=','status.id')
                                    ->where('status.nama','Pengalihan Psikolog')
                                    ->get()
                                    ->count();
	$psikolog = App\User::all()
              ->where('level','Psikolog')
              ->where('status','Not Approved')
              ->sortBy('name')
              ->count();
	$menunggu_konfirmasi = App\Jadwal::leftjoin('status','jadwal.status_id','=','status.id')
                                 		->where('status.nama','Menunggu Konfirmasi')
                                 		->get()
                                 		->count();

    $konfirmasi = App\Jadwal::leftjoin('status','jadwal.status_id','=','status.id')
                                    ->where('status.nama','Konfirmasi')
                                    ->get()
                                    ->count();
                                    // ->get();
                                    // dd($konfirmasi);
      return response()->json([
        'status'=>'success',
        'result'=>[
        	'pengalihan_psikolog' => $pengalihan_psikolog, 
          'psikolog' => $psikolog, 
          'waiting' => $menunggu_konfirmasi, 
          'konfirmasi' => $konfirmasi]
      ]);
});
