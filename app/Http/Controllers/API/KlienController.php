<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\Http\Controllers\Controller;
use App\Klien;
use App\User;
use App\Kategori;
use App\Jadwal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Validator;
use App\Lib\Helper;
use Carbon\Carbon;
use Hash;
use DB;
use Illuminate\Foundation\Auth\VerifiesEmails;

class KlienController extends Controller
{
use VerifiesEmails;
public $successStatus = 200;

public function register(Request $request)
{
    $validator = Validator::make($request->all(), [
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required',
        'username' => 'required|unique:users',
        'no_telepon' => 'required|unique:users',
    ]);
    if ($validator->fails()) {
                return response()->json(['error'=>$validator->errors()], 401);
    }
    $input = $request->all();
            $input['password'] = bcrypt($input['password']);
            $user = User::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>bcrypt($request->password),
                'level'=>'Klien',
                'username'=>$request->username,
                'tanggal_lahir' =>$request->tanggal_lahir,
                'no_telepon'=>$request->no_telepon,
                ]);
              $user->sendEmailVerificationNotification();
              $user->klien()->create([
                    // 'anak_ke' => $request->anak_ke,
                    // 'jumlah_saudara' => $request->jumlah_saudara,
                   // 'pendidikan_terakhir' => $request->pendidikan_terakhir,
                     'kategori_id' => $request->kategori_id,
                //'foto'=>$request->foto,
                ]);
    return response()->json([
        'status'=>'success',
        'result'=>$user
    ]);
}
public function update(Request $request, $id){
  $data = User::find($id);
  // dd($klien);
  $data->name=$request->name;
  //$data->email=$request->email;
//  $data->level=$request->level;
  //$data->username=$request->username;
  $data->nik=$request->nik;
 $data->tanggal_lahir=$request->tanggal_lahir;
  $data->jenis_kelamin=$request->jenis_kelamin;
  $data->alamat=$request->alamat;
  $data->no_telepon=$request->no_telepon;
  $data->klien()->update([
    'anak_ke'=>$request->anak_ke,
    'jumlah_saudara'=>$request->jumlah_saudara,
    'pendidikan_terakhir'=>$request->pendidikan_terakhir,
    'kategori_id'=>$request->kategori_id,
    
  ]);

  $data->save();
  return response()->json([
  'error'=>false,
  'message'=>'Data Klien Berhasil Diubah',
  'biodata'=>$data
]);
}


public function update_user(Request $request, $id){
  $data = User::find($id);
  // dd($klien);
//  $data->name=$request->name;
  $data->email=$request->email;
  //$data->level=$request->level;
  $data->username=$request->username;
  //$data->nik=$request->nik;
//  $data->tanggal_lahir=$request->tanggal_lahir = Carbon::parse($request->tanggal_lahir);
  //$data->jenis_kelamin=$request->jenis_kelamin;
  //$data->alamat=$request->alamat;
  $data->no_telepon=$request->no_telepon;
  // $data->klien()->update([
  //   'anak_ke'=>$request->anak_ke,
  //   'jumlah_saudara'=>$request->jumlah_saudara,
  //   'pendidikan_terakhir'=>$request->pendidikan_terakhir,
  // ]);

  $data->save();
  return response()->json([
  'error'=>false,
  'message'=>'Data Klien Berhasil Diubah',
  'biodata'=>$data
]);
}

public function update_foto(Request $request,$id)
    {
        $path = base_path() . '/public/images/';
        $photo = Helper::uploadPhoto($request->foto, $path);
        $data= User::find($id);

          $data->foto = $photo['image_name'];
          $data->save();

          return response()->json(['success' => $data]);
    }


    public function pendaftar(Request $request){

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users',
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }

     $path = base_path() . '/public/images/';
     $photo = Helper::uploadPhoto($request->foto, $path);
      $user = User::create([
      'name'=>$request->name,
      'email'=>$request->email,
      'password'=>bcrypt($request->password),
      'level'=>'Klien',
      'username'=>$request->username,
      'nik'=>$request->nik,
      'tanggal_lahir' => $request->tanggal_lahir,
      'jenis_kelamin' =>$request->jenis_kelamin,
      'alamat' =>$request->alamat,
      'no_telepon'=>$request->no_telepon,
      'foto'=>$photo['image_name']
      ])->klien()->create([
          'anak_ke' => request('anak_ke'),
          'jumlah_saudara' => request('jumlah_saudara'),
          'pendidikan_terakhir' => request('pendidikan_terakhir'),
          'kategori_id' => request('kategori_id'),
          'parent_id' => Auth::user()->klien->id,
          'hub_pendafatar' => request('hub_pendaftar'),
      ]);
      // $user = Klien::where('id',$user->id)->with(['user'])->first();
      $user = User::where('id',$user->id)->with('klien')->first();
      return response()->json([
            'status'=>'success',
            'result'=>$user

        ]);

    }

        public function pendaftar_lain(Request $request){

          $user = User::create([
          'name'=>$request->name,
          'password'=>Hash::make(str_random(8)),
          'level'=>'Klien',
          'nik'=>$request->nik,
          'tanggal_lahir' => $request->tanggal_lahir,
          'jenis_kelamin' =>$request->jenis_kelamin,
          'fcm_token' =>$request->get('fcm_token'),
          ])->klien()->create([
              'anak_ke' => request('anak_ke'),
              'jumlah_saudara' => request('jumlah_saudara'),
              'pendidikan_terakhir' => request('pendidikan_terakhir'),
              'parent_id' => Auth::user()->klien->id,
              'hub_pendaftar' => request('hub_pendaftar'),
              'kategori_id' => request('kategori_id'),      
            
          ]);
          
          // $pendaftar = User::where('id',$user->id)->with(['klien'])->first();
        $user = Klien::where('id',$user->id)->with(['user'])->first();
        //dd($user);
          $success['idKlien'] = $user->id;
          $success['parent_id'] = $user->parent_id;
        //  $success['name'] = $user->name;
          return response()->json([
                'Klien_DaftarOrangLain'=>$success,
                //'user'=>$user

            ]);

        }

    public function pendaftar_lain_update(Request $request, $id){
        $data= User::find($id);
          $data->name=$request->get('name', $data->name);
          $data->jenis_kelamin= $request->get('jenis_kelamin');
          $data->tanggal_lahir= $request->tanggal_lahir;
          $data->klien()->update([
            'anak_ke' => $request->get('anak_ke'),
            'jumlah_saudara'=>$request->get('jumlah_saudara'),
            'pendidikan_terakhir'=>$request->get('pendidikan_terakhir'),
            'parent_id' => Auth::user()->klien->id,
            'hub_pendaftar' => request('hub_pendaftar'),
          ]);
          $data->save();
          // dd($data);
          $data = User::where('id',$data->id)->with(['klien'])->first();

          return response()->json([
            'status'=>'success',
            'result'=>$data,

        ]);

    }

        // public function riwayat_konsultasi(Request $request){

        //   $list = Jadwal::whereHas('klien', function($data) use($request)
        //   {
        //     $data->where('klien_id', $request->klien_id)->orderBy('nama', 'asc');
        //   })->select('jadwal.*')
        //     ->leftjoin('status','status.id','=','jadwal.status_id')
        //     ->where('status.nama','=','Selesai')
        //     ->with(['klien.user','status','layanan','psikolog.user','sesi','ruangan'])->get();
        //     // dd($list);
        //     return response()->json(
        //       ['jadwal'=>$list]);
        // }

      public function riwayat_konsultasi(){

      $klien = User::find(Auth::user()->id)->klien()->first()->id;

      $list = DB::table('jadwal')->where('klien_id', $klien)
                      ->leftjoin('status','status.id','=','jadwal.status_id')
                      ->leftjoin('sesi','sesi.id','=','jadwal.sesi_id')
                      ->leftjoin('ruangan','ruangan.id','=','jadwal.ruangan_id')
                      ->leftjoin('layanan','layanan.id','=','jadwal.layanan_id')                      
                      ->leftjoin('psikolog','psikolog.id','=','jadwal.psikolog_id')                    
                      ->leftjoin('users','users.id','=','psikolog.user_id')
                      ->select('jadwal.*','users.name as Psikolog','layanan.nama as Layanan','ruangan.nama as Ruangan','sesi.nama as Sesi','sesi.jam as Jam')
                      ->where('status.nama','=','Selesai')
                      ->get();
                        // dd($list);
      return response()->json(
        ['jadwal'=>$list]
      );
    }

    public function jadwal_konsultasi(){

      $klien = User::find(Auth::user()->id)->klien()->first()->id;

      $list = DB::table('jadwal')->where('klien_id', $klien)
                      ->leftjoin('status','status.id','=','jadwal.status_id')
                      ->leftjoin('sesi','sesi.id','=','jadwal.sesi_id')
                      ->leftjoin('ruangan','ruangan.id','=','jadwal.ruangan_id')
                      ->leftjoin('layanan','layanan.id','=','jadwal.layanan_id')                      
                      ->leftjoin('psikolog','psikolog.id','=','jadwal.psikolog_id')                    
                      ->leftjoin('users','users.id','=','psikolog.user_id')
                      ->select('jadwal.*','users.name as Psikolog','layanan.nama as Layanan','ruangan.nama as Ruangan','sesi.nama as Sesi','sesi.jam as Jam')
                      ->where('status.nama','=','Terjadwal')
                      ->get();
                        // dd($list);
      return response()->json(
        ['jadwal'=>$list]
      );
    }

        // public function jadwal_konsultasi(Request $request){

        //   $list = Jadwal::whereHas('klien', function($data) use($request)
        //   {
        //     $data->where('klien_id', $request->klien_id)->orderBy('nama', 'asc');
        //   })->select('jadwal.*')
        //     ->leftjoin('status','status.id','=','jadwal.status_id')
        //     ->where(function($query){
        //        $query->where('status.nama','=','Terjadwal');
        //      })
        //     ->with(['klien.user','status','layanan','psikolog.user','sesi','ruangan'])->get();
        //     // dd($list);
        //   return response()->json(
        //     ['jadwal'=>$list]);
        // }

        public function riwayat_konsultasiChild(Request $request){

          $list = Jadwal::whereHas('klien', function($data) use($request)
          {
            $data->where('parent_id', $request->parent_id)->orderBy('nama', 'asc');
          })->select('jadwal.*')
            ->leftjoin('status','status.id','=','jadwal.status_id')
            ->where('status.nama','=','Selesai')
            ->with(['klien.user','status','layanan','psikolog.user','sesi','ruangan'])->get();
            // dd($list);
            return response()->json(
              ['jadwal'=>$list]);
        }

        public function jadwal_konsultasiChild(Request $request){

          $list = Jadwal::whereHas('klien', function($data) use($request)
          {
            $data->where('parent_id', $request->parent_id)->orderBy('nama', 'asc');
          })->select('jadwal.*')
            ->leftjoin('status','status.id','=','jadwal.status_id')
            ->where(function($query){
               $query->where('status.nama','=','Terjadwal')
               ;
             })
            // ->orWhere('status.nama','=','Menunggu Konfirmasi')
            // ->orWhere('status.nama','=','Pengalihan Psikolog')
            ->with(['klien.user','status','layanan','psikolog.user','sesi','ruangan'])->get();
            //->with(['klien'])->get();

            // dd($list);
          return response()->json(
            ['jadwal'=>$list]);
        }
        public function konfirmasi_konsultasiChild(Request $request){

          $list = Jadwal::whereHas('klien', function($data) use($request)
          {
            $data->where('parent_id', $request->parent_id)->orderBy('nama', 'asc');
          })->select('jadwal.*')
            ->leftjoin('status','status.id','=','jadwal.status_id')
            ->where(function($query){
               $query->where('status.nama','=','Menunggu Konfirmasi')
               ->orWhere('status.nama','=','Pengalihan Psikolog')
               ->orWhere('status.nama','=','Konfirmasi Pengalihan Psikolog');
             })
            // ->orWhere('status.nama','=','Menunggu Konfirmasi')
            // ->orWhere('status.nama','=','Pengalihan Psikolog')
            ->with(['klien.user','status','layanan','psikolog.user','sesi','ruangan'])->get();
            //->with(['klien'])->get();

            // dd($list);
          return response()->json(
            ['jadwal'=>$list]);
        }

        public function konfirmasi_konsultasi(Request $request){

          $list = Jadwal::whereHas('klien', function($data) use($request)
          {
            $data->where('klien_id', $request->klien_id)->orderBy('nama', 'asc');
          })->select('jadwal.*')
            ->leftjoin('status','status.id','=','jadwal.status_id')
            ->where(function($query){
               $query->where('status.nama','=','Menunggu Konfirmasi')
               ->orWhere('status.nama','=','Pengalihan Psikolog')
               ->orWhere('status.nama','=','Konfirmasi Pengalihan Psikolog');
             })
            ->with(['klien.user','status','layanan','psikolog.user','sesi','ruangan'])->get();
            // dd($list);
          return response()->json(
            ['jadwal'=>$list]);
        }



            public function show($id)
             {
                  $klien = User::where('id',$id)->with('klien')->first();
                //  $klien = Klien::where('id',$id)->with('user')->first();
                 if (! $klien) {
                     return response()->json([
                        'message' => 'Klien not found'
                     ]);
                 }

                 $klien->foto = asset('images/'.$klien->foto.'');

                 return $klien;
             }
             public function show_child(Request $request){

              $list = Klien::whereHas('parent', function($data) use($request)
              {
                $data->where('id', $request->id);
              })->with('user')->get();
              // return response()->json([
              //   'child'=>$list,
              // ]);
              return response()->json(
                $list
              );

            }



            public function list(){
              $klien = User::all()->where('level','Klien');
              return response()->json([
                'status'=>'success',
                'result'=> $klien ,
              ]);
            }

        }
