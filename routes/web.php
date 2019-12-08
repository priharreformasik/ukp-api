<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// use App\Http\Middleware\IsAdmin;
use App\User;

Route::get('/', function () {
    return view('auth/login');
});

Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    $exitCode = Artisan::call('composer dump-autoload -o');
    return 'Configuration cache cleared!, Cache cleared, Configuration cached successfully!';
});


Auth::routes();
Route::group(['middleware' => ['isAdmin'], 'prefix' => 'home'],function()
{
Route::get('/', 'HomeController@index')->name('home');

Route::get('/{id}/detail', 'HomeController@show');

Route::get('/{id}/edit', 'HomeController@edit');
Route::post('/{id}/edit', 'HomeController@update');
});



/* ===== START OF USER ===== */

/* START OF ADMIN*/
Route::group(['middleware' => ['isAdmin'], 'prefix' => 'user/admin'],function()
{
Route::get('/', 'UserController@index');

Route::get('/tambah','UserController@create');
Route::post('/tambah','UserController@create');

Route::get('/simpan', 'UserController@store');
Route::post('/simpan', 'UserController@store');

Route::get('/{id}/detail', 'UserController@show');

Route::get('/{id}/edit', 'UserController@edit');
Route::post('/{id}/edit', 'UserController@update');

Route::get('/{id}', 'UserController@destroy');

Route::get('/{id}/edit_foto', 'UserController@edit_foto');
Route::post('/{id}/edit_foto', 'UserController@update_foto');
});

Route::get('profile/{id}', 'UserController@profile');
Route::post('profile/{id}', 'UserController@profile');

Route::get('profile/{id}/edit', 'UserController@edit_profile');
Route::post('profile/{id}/edit', 'UserController@update_profile');

Route::get('ganti_foto/{id}', 'UserController@edit_fotoProfile');
Route::post('ganti_foto/{id}', 'UserController@update_fotoProfile');

Route::get('ganti_password/{id}', 'UserController@edit_password');
Route::post('ganti_password/{id}', 'UserController@update_password');

Route::get('ubah_password/{id}', 'UserController@edit_password_admin');
Route::post('ubah_password/{id}', 'UserController@update_password_admin');
/*END OF ADMIN*/

/*START OF KLIEN*/
Route::get('user/klien', 'KlienController@index');

Route::get('user/klien/tambah','KlienController@create');
Route::post('user/klien/tambah','KlienController@create');

Route::get('user/klien/simpan', 'KlienController@store');
Route::post('user/klien/simpan', 'KlienController@store');

Route::get('user/klien/{id}/detail', 'KlienController@show');

Route::get('user/klien/{id}/edit', 'KlienController@edit');
Route::post('user/klien/{id}/edit', 'KlienController@update');

Route::get('user/klien/{id}/edit_foto', 'KlienController@edit_foto');
Route::post('user/klien/{id}/edit_foto', 'KlienController@update_foto');

Route::delete('user/klien/{id}/delete', 'KlienController@destroy');
Route::get('user/klien/excel', 'KlienController@excel');

Route::get('ganti_password/{id}/klien', 'KlienController@edit_password');
Route::post('ganti_password/{id}/klien', 'KlienController@update_password');


/*END OF KLIEN*/

/*START OF PENDAFTAR*/
Route::get('user/pendaftar/{id}/tambah','KlienController@create_pendaftar');
Route::post('user/pendaftar/{id}/tambah','KlienController@create_pendaftar');

Route::get('user/pendaftar/simpan', 'KlienController@store_pendaftar');
Route::post('user/pendaftar/simpan', 'KlienController@store_pendaftar');

Route::get('user/pendaftar/{id}/edit', 'KlienController@edit_pendaftar');
Route::post('user/pendaftar/{id}/edit', 'KlienController@update_pendaftar');

Route::get('user/pendaftar/{id}/edit_foto', 'KlienController@edit_foto_pendaftar');
Route::post('user/pendaftar/{id}/edit_foto', 'KlienController@update_foto_pendaftar');
/*END OF PENDAFTAR*/

/*START OF PSIKOLOG*/
Route::get('user/psikolog', 'PsikologController@index');

Route::get('user/psikolog/tambah','PsikologController@create');
Route::post('user/psikolog/tambah','PsikologController@create');

Route::get('user/psikolog/simpan', 'PsikologController@store');
Route::post('user/psikolog/simpan', 'PsikologController@store');

Route::get('user/psikolog/{id}/detail', 'PsikologController@show');

Route::get('user/psikolog/{id}/edit', 'PsikologController@edit');
Route::post('user/psikolog/{id}/edit', 'PsikologController@update');

Route::get('user/psikolog/{id}/edit_foto', 'PsikologController@edit_foto');
Route::post('user/psikolog/{id}/edit_foto', 'PsikologController@update_foto');

Route::delete('user/psikolog/{id}/delete', 'PsikologController@destroy');

Route::get('user/psikolog/excel', 'PsikologController@excel');

Route::get('user/psikolog/{id}/status', 'PsikologController@status');

Route::get('ganti_password/{id}/psikolog', 'PsikologController@edit_password');
Route::post('ganti_password/{id}/psikolog', 'PsikologController@update_password');

/*END OF PSIKOLOG*/

/* ===== END OF USER ===== */

/* ===== START OF DATA ===== */
/*START OF LAYANAN*/
Route::get('data/layanan', 'LayananController@index');
Route::get('data/layanan/tambah','LayananController@create');
//Route::post('data/layanan/tambah','LayananController@create');

//Route::get('data/layanan/simpan', 'LayananController@store');
Route::post('data/layanan/simpan', 'LayananController@store');
Route::get('data/layanan/{id}/detail', 'LayananController@detail');

Route::get('data/layanan/{id}/edit', 'LayananController@edit');
Route::post('data/layanan/{id}/edit', 'LayananController@update');

Route::get('data/layanan/{id}/edit_foto', 'LayananController@edit_foto');
Route::post('data/layanan/{id}/edit_foto', 'LayananController@update_foto');

Route::delete('data/layanan/{id}/delete', 'LayananController@destroy');
/*END OF LAYANAN*/

/*START OF ASESMEN*/
Route::get('data/asesmen', 'AsesmenController@index');
Route::get('data/asesmen/tambah','AsesmenController@create');

Route::post('data/asesmen/simpan', 'AsesmenController@store');
Route::get('data/asesmen/{id}/detail', 'AsesmenController@detail');

Route::get('data/asesmen/{id}/edit', 'AsesmenController@edit');
Route::post('data/asesmen/{id}/edit', 'AsesmenController@update');

Route::get('data/asesmen/{id}/edit_foto', 'AsesmenController@edit_foto');
Route::post('data/asesmen/{id}/edit_foto', 'AsesmenController@update_foto');

Route::delete('data/asesmen/{id}/delete', 'AsesmenController@destroy');
/*END OF ASESMEN*/



/*START OF KATEGORI*/
Route::get('data/kategori', 'KategoriController@index');

Route::get('data/kategori/tambah','KategoriController@create');
Route::post('data/kategori/simpan', 'KategoriController@store');

//Route::get('data/kategori/{id}/detail', 'KategoriController@detail');

Route::get('data/kategori/{id}/edit', 'KategoriController@edit');
Route::post('data/kategori/{id}/edit', 'KategoriController@update');

Route::delete('data/kategori/{id}/delete', 'KategoriController@destroy');

/*END OF KATEGORI*/

/*START OF KEAHLIAN*/
Route::get('data/keahlian', 'KeahlianController@index');

Route::get('data/keahlian/tambah','KeahlianController@create');
Route::post('data/keahlian/simpan', 'KeahlianController@store');

//Route::get('data/keahlian/{id}/detail', 'KategoriController@detail');

Route::get('data/keahlian/{id}/edit', 'KeahlianController@edit');
Route::post('data/keahlian/{id}/edit', 'KeahlianController@update');

Route::delete('data/keahlian/{id}/delete', 'KeahlianController@destroy');

/*END OF KEAHLIAN*/

/*START OF RUANGAN*/

Route::get('data/ruangan', 'RuanganController@index');

Route::get('data/ruangan/tambah','RuanganController@create');
Route::post('data/ruangan/simpan', 'RuanganController@store');

//Route::get('data/ruangan/{id}/detail', 'RuanganController@detail');

Route::get('data/ruangan/{id}/edit', 'RuanganController@edit');
Route::post('data/ruangan/{id}/edit', 'RuanganController@update');

Route::delete('data/ruangan/{id}/delete', 'RuanganController@destroy');

/*END OF RUANGAN*/

/*START OF STATUS*/

Route::get('data/status', 'StatusController@index');

Route::get('data/status/tambah','StatusController@create');
Route::post('data/status/simpan', 'StatusController@store');

//Route::get('data/status/{id}/detail', 'StatusController@detail');

Route::get('data/status/{id}/edit', 'StatusController@edit');
Route::post('data/status/{id}/edit', 'StatusController@update');

Route::delete('data/status/{id}/delete', 'StatusController@destroy');
/*END OF STATUS*/

/*START OF SESI*/

Route::get('data/sesi', 'SesiController@index');

Route::get('data/sesi/tambah','SesiController@create');
Route::post('data/sesi/simpan', 'SesiController@store');

//Route::get('data/sesi/{id}/detail', 'SesiController@detail');

Route::get('data/sesi/{id}/edit', 'SesiController@edit');
Route::post('data/sesi/{id}/edit', 'SesiController@update');

Route::delete('data/sesi/{id}/delete', 'SesiController@destroy');

/*END OF SESI*/

/* ===== END OF DATA ===== */

/*=== START OF JADWAL ====*/
Route::get('jadwal', 'JadwalController@index');

Route::get('jadwal/tambah','JadwalController@create');
Route::post('jadwal/tambah','JadwalController@create');

Route::get('jadwal/simpan', 'JadwalController@store');
Route::post('jadwal/simpan', 'JadwalController@store');

Route::get('jadwal/{id}/detail', 'JadwalController@show');

Route::get('jadwal/{id}/edit', 'JadwalController@edit');
Route::post('jadwal/{id}/edit', 'JadwalController@update');

Route::delete('jadwal/{id}/delete', 'JadwalController@destroy');
/*=== END OF JADWAL ===*/


/*=== START OF PENGATURAN ====*/
Route::get('pengaturan/aproval', 'AprovalController@index');
Route::get('pengaturan/aproval/{id}/edit', 'AprovalController@edit');
Route::post('pengaturan/aproval/{id}/edit', 'AprovalController@update');
Route::get('pengaturan/aproval/{id}/detail', 'AprovalController@show');

Route::get('pengaturan/aproval/psikolog', 'AprovalPsikologController@index');
Route::get('pengaturan/aproval/psikolog/{id}/detail', 'AprovalPsikologController@show');
Route::get('pengaturan/aproval/psikolog/{id}/status', 'AprovalPsikologController@status');
Route::delete('pengaturan/aproval/psikolog/{id}/delete', 'AprovalPsikologController@destroy');


Route::get('pengaturan/pesan', 'PesanController@index');
Route::get('pengaturan/pesan/tambah', 'PesanController@create');
Route::post('pengaturan/pesan/simpan', 'PesanController@store');
Route::delete('pengaturan/pesan/{id}/delete', 'PesanController@destroy');

Route::resource('notif', 'NotifController');
Route::post('notif/simpan', 'NotifController@store');
/*=== END OF PENGATURAN ===*/

/*=== START OF PDF ==*/
Route::get('pdf/klien','PdfKlienController@index');
Route::get('pdf/klien/pdf','PdfKlienController@pdf');

// Route::get('downloadPDF','PdfKlienController@downloadPDF');
Route::get('/klien/pdf','PdfKlienController@export_pdf');
Route::get('/psikolog/pdf','PsikologController@export_pdf');
Route::get('/report_layanan/pdf','StatistikLayananController@export_pdf');
Route::get('/report_perlayanan/pdf','StatistikLayananController@layanan_pdf');
Route::get('/report_psikolog/pdf','StatistikPsikologController@export_pdf');
Route::get('/report_perpsikolog/pdf','StatistikPsikologController@psikolog_pdf');
Route::get('/report_klien/pdf','StatistikKlienController@export_pdf');
Route::get('/report_perklien/pdf','StatistikKlienController@klien_pdf');

/*=== END OF PDF ===*/

/*=== START OF EXCEL ===*/
Route::get('/report_layanan/excel','StatistikLayananController@export_excel');
Route::get('/report_perlayanan/excel','StatistikLayananController@layanan_excel');

Route::get('/report_klien/excel','StatistikKlienController@export_excel');
Route::get('/report_perklien/excel','StatistikKlienController@klien_excel');

Route::get('/report_psikolog/excel','StatistikPsikologController@export_excel');
Route::get('/report_perpsikolog/excel','StatistikPsikologController@psikolog_excel');

/*=== START OF EXCEL ===*/

/*=== START OF STATISTIK ==*/
Route::group(['middleware' => ['isAdmin'], 'prefix' => 'statistik'],function()
{
Route::get('/statistik_klien','StatistikKlienController@index');
Route::post('/statistik_klien','StatistikKlienController@index');
Route::get('/klien_report','StatistikKlienController@report');
Route::post('/klien_report','StatistikKlienController@report');

Route::get('/report_all_klien','StatistikKlienController@report_all');
Route::post('/report_all_klien','StatistikKlienController@report_all');

Route::get('/statistik_psikolog','StatistikPsikologController@index');
Route::post('/statistik_psikolog','StatistikPsikologController@index');
Route::get('/psikolog_report','StatistikPsikologController@report');
Route::post('/psikolog_report','StatistikPsikologController@report');

Route::get('/report_all_psikolog','StatistikPsikologController@report_all');
Route::post('/report_all_psikolog','StatistikPsikologController@report_all');

Route::get('/statistik_layanan','StatistikLayananController@index');
Route::post('/statistik_layanan','StatistikLayananController@index');
Route::get('/layanan_report','StatistikLayananController@report');
Route::post('/layanan_report','StatistikLayananController@report');

Route::get('/report_all_layanan','StatistikLayananController@report_all');
Route::post('/report_all_layanan','StatistikLayananController@report_all');
});
/*=== END OF STATISTIK ===*/

/*RESET PASSWORD*/

//Password reset route
Route::post('/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('/password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('/password/reset', 'Auth\ResetPasswordController@reset');
Route::get('/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');

Route::get('send', 'PesanController@sendNotification');

Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
Route::get('email/verify/{id}', 'Auth\VerificationController@verify')->name('verification.verify');
Route::get('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');

Route::get('/search',function(){
 $query = Input::get('query');
 $users = User::where('name','like','%'.$query.'%')->get();
 return response()->json($users);
});

Route::get('/search2', 'Select2Controller@index');
Route::get('/cari', 'Select2Controller@loadData');
 Route::get('autocomplete', 'Select2Controller@loadData');

Route::get('welcome', 'PesanController@welcome');

/*======= START OF TRANSACTION =======*/
Route::group(['middleware' => ['isAdmin'], 'prefix' => 'transaksi'],function()
{
Route::get('/', 'TransaksiController@index');
Route::get('/klien','KlienController@list_klien');
Route::get('/asesmen','AsesmenController@list_asesmen');
Route::get('/asesmen-harga','AsesmenController@list_asesmen_harga');
});
/*======= END OF TRANSACTION =======*/





