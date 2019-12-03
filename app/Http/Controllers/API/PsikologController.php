<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Psikolog;
use App\User;
use App\Keahlian;
use Illuminate\Support\Facades\Session;
use Validator;
use App\Lib\Helper;
use App\Jadwal;
use DB;
use Illuminate\Foundation\Auth\VerifiesEmails;

class PsikologController extends Controller
{
public $successStatus = 200;
use VerifiesEmails;

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
          //  'c_password' => 'required|same:password',
            'username' => 'required|unique:users',
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
                    'level'=>'Psikolog',
                    'username'=>$request->username,

                    /*'nik'=>$request->nik,
                    'tanggal_lahir' =>$request->tanggal_lahir,
                    'jenis_kelamin' =>$request->jenis_kelamin,
                    'alamat' =>$request->alamat,*/
                    'no_telepon'=>$request->no_telepon,
                    //'foto'=>$request->foto,
                    'isActive'=>'Tidak Aktif',
                    'status'=>'Not Approved',
                ]);
                $user->sendEmailVerificationNotification();
                $user->psikolog()->create([
                    'gelar'=>$request->gelar,
                    'no_sipp'=>$request->no_sipp,
                    //'keahlian_id'=>$request->keahlian_id,
                ]);
        return response()->json([
            'status'=>'success',
            'result'=>$user
        ]);
    }
    public function permintaan_klien(Request $request){

      $list = Jadwal::whereHas('psikolog', function($data) use($request)
      {
        $data->where('psikolog_id', $request->psikolog_id)->orderBy('nama', 'asc');
      })->select('jadwal.*')
        ->leftjoin('status','status.id','=','jadwal.status_id')
        ->where('status.nama','=','Menunggu Konfirmasi')
        ->with(['status','layanan','klien.user','sesi','ruangan'])->get();
        // dd($list);
        return response()->json(
          ['jadwal'=>$list]);

    }

    public function cari_klien(Request $request){

      $list = Jadwal::whereHas('psikolog', function($data) use($request)
      {
        $data->where('psikolog_id', $request->psikolog_id)->orderBy('nama', 'asc');
      })->select('jadwal.*')
        ->leftjoin('status','status.id','=','jadwal.status_id')
        ->where('status.nama','=','Pengalihan Psikolog')
        ->with(['status','layanan','klien.user','sesi','ruangan'])->get();
      // dd($list);
      return response()->json(
        ['jadwal'=>$list]);

    }

    // public function riwayat_konsultasi(Request $request){

    //   $list = Jadwal::whereHas('psikolog', function($data) use($request)
    //   {
    //     $data->where('psikolog_id', $request->psikolog_id)->orderBy('nama', 'asc');
    //   })->select('jadwal.*')
    //     ->leftjoin('status','status.id','=','jadwal.status_id')
    //     ->where('status.nama','=','Selesai')
    //     ->with(['status','layanan','klien.user','sesi','ruangan'])->get();
    //     // dd($list);
    //     return response()->json(
    //       ['jadwal'=>$list]);

    // }

    public function riwayat_konsultasi(){

      $psikolog = User::find(Auth::user()->id)->psikolog()->first()->id;

      $list = DB::table('jadwal')->where('psikolog_id', $psikolog)
                      ->leftjoin('status','status.id','=','jadwal.status_id')
                      ->leftjoin('sesi','sesi.id','=','jadwal.sesi_id')
                      ->leftjoin('ruangan','ruangan.id','=','jadwal.ruangan_id')
                      ->leftjoin('layanan','layanan.id','=','jadwal.layanan_id')                      
                      ->leftjoin('klien','klien.id','=','jadwal.klien_id')                    
                      ->leftjoin('users','users.id','=','klien.user_id')
                      ->select('jadwal.*','users.name as Klien','layanan.nama as Layanan','ruangan.nama as Ruangan','sesi.nama as Sesi','sesi.jam as Jam')
                      ->where('status.nama','=','Selesai')
                      ->get();
                        // dd($list);
      return response()->json(
        ['jadwal'=>$list]
      );
    }


    // public function jadwal_konsultasi(Request $request){

    //   $list = Jadwal::whereHas('psikolog', function($data) use($request)
    //   {
    //     $data->where('psikolog_id', $request->psikolog_id)->orderBy('nama', 'asc');
    //   })->select('jadwal.*')
    //     ->leftjoin('status','status.id','=','jadwal.status_id')
    //     ->where('status.nama','=','Terjadwal')
    //   //  ->orWhere('status.nama','=','Menunggu Konfirmasi')
    //     ->with(['status','layanan','klien.user','sesi','ruangan'])->get();
    //       // dd($list);
    //       return response()->json(
    //         ['jadwal'=>$list]);
    //     }

    public function jadwal_konsultasi(){

      $psikolog = User::find(Auth::user()->id)->psikolog()->first()->id;

      $list = DB::table('jadwal')->where('psikolog_id', $psikolog)
                      ->leftjoin('status','status.id','=','jadwal.status_id')
                      ->leftjoin('sesi','sesi.id','=','jadwal.sesi_id')
                      ->leftjoin('ruangan','ruangan.id','=','jadwal.ruangan_id')
                      ->leftjoin('layanan','layanan.id','=','jadwal.layanan_id')                      
                      ->leftjoin('klien','klien.id','=','jadwal.klien_id')                    
                      ->leftjoin('users','users.id','=','klien.user_id')
                      ->select('jadwal.*','users.name as Klien','layanan.nama as Layanan','ruangan.nama as Ruangan','sesi.nama as Sesi','sesi.jam as Jam')
                      ->where('status.nama','=','Terjadwal')
                      ->orWhere('status.nama','=','Menunggu Konfirmasi')
                      // ->with(['status','layanan','klien.user','sesi','ruangan'])
                      ->get();
                        // dd($list);
      return response()->json(
        ['jadwal'=>$list]
      );
    }

    public function alihkan_permintaan(){
      $list = Jadwal::leftjoin('status','status.id','=','jadwal.status_id')
                      ->where('status.nama','=','Alihkan Permintaan')
                      ->with(['klien.user','psikolog.user','sesi','ruangan','layanan','status'])
                      ->get();
        // dd($list);
      return response()->json($list);
    }

    public function psikolog(){
      $psikolog = User::with(['psikolog'])->where('level','Psikolog')->get();
      return response()->json([
        'status'=>'success',
        'result'=> $psikolog,
      ]);
    }

    public function show_psikolog($id)
    {
      $user = Psikolog::where('id', $id)
                    ->with('layanan')
                    ->first();
      // dd($user);
      return response()->json(
         $user
      );
    }

    public function details()
    {
        $psikolog = Auth::psikolog();
        return response()->json(['success' => $psikolog], $this-> successStatus);
    }

    public function update_foto(Request $request,$id)
    {
        $path = base_path() . '/public/images/';
        $photo = Helper::uploadPhoto($request->foto, $path);
        $data= User::find($id);
        // return response()->json(['success' => $data]);

 //         $data->name=$request->get('name', $data->name);
 //         $data->jenis_kelamin= $request->get('jenis_kelamin');
 //         $data->tanggal_lahir= $request->tanggal_lahir;
 //         $data->nik = $request->get('nik', $data->nik);
 //         $data->psikolog()->update([
 //           'no_sipp' => $request->get('no_sipp', $data->no_sipp),
 //           'gelar'=>$request->get('gelar', $data->gelar),
 //           'keahlian_id' => $request->get('keahlian_id', $data->keahlian_id)
 //         ]);
 //         $data->psikolog->layanan()->sync($request->layanan_id);
//
 //         $data->alamat = $request->get('alamat', $data->alamat);
  //        $data->no_telepon = $request->get('no_telepon', $data->no_telepon);
   //       $data->email = $request->get('email', $data->email);
 //         $data->username = $request->get('username', $data->username);
          $data->foto = $photo['image_name'];
          $data->save();
      //     $keahlian;
// foreach
      // $fg = json_decode($keahlian, true);
          // dd($data);
          // $psikolog = User::where('id', $success['id'])->get();
          $data = User::where('id',$data->id)->with(['psikolog.layanan'])->first();
          return response()->json(['success' => $data]);
    }


      public function list(){
        $psikolog = User::with(['psikolog.keahlian'])->Where('level', 'Psikolog')->get();
        return response()->json([

          'psikolog'=> $psikolog ,
        ]);
      }

      public function show()
      {
        $psikolog = User::find(Auth::user()->id)->psikolog()->first()->id;
        $list = DB::table('psikolog')->where('psikolog.id', $psikolog)                 
                ->leftjoin('users','users.id','=','psikolog.user_id')
                ->select('users.*','psikolog.*')
                ->first();
        if (! $list) {
            return response()->json([
              'pesan' => 'Psikolog tidak ditemukan'
            ]);
        }

        $list->foto = asset('images/'.$list->foto.'');

        return response()->json([
          'status' => 'Sukses',
          'result' => $list
        ]);
      }


    //   public function show_psikolog($id)
     //  {
      //   $user = User::where('id', $id)
       //                ->with('psikolog.layanan')
        //               ->first();
         // dd($user);
        // return response()->json([
         //  'status'=>'success',
          // 'result'=> $user,
         //]);
      // }
      public function update_biodata(Request $request,$id)
      {
      //    $path = base_path() . '/public/images/';
      //    $photo = Helper::uploadPhoto($request->foto, $path);
          $data= User::find($id);
          // return response()->json(['success' => $data]);

           $data->name=$request->get('name', $data->name);
           $data->jenis_kelamin= $request->get('jenis_kelamin');
           $data->tanggal_lahir= $request->tanggal_lahir;
           $data->nik = $request->get('nik', $data->nik);
           $data->psikolog()->update([
             'no_sipp' => $request->get('no_sipp', $data->no_sipp),
             'gelar'=>$request->get('gelar', $data->gelar),
   //           'keahlian_id' => $request->get('keahlian_id', $data->keahlian_id)
           ]);
   //         $data->psikolog->layanan()->sync($request->layanan_id);
  //
            $data->alamat = $request->get('alamat', $data->alamat);
  //        $data->no_telepon = $request->get('no_telepon', $data->no_telepon);
   //       $data->email = $request->get('email', $data->email);
   //         $data->username = $request->get('username', $data->username);
  //          $data->foto = $photo['image_name'];
            $data->save();
        //     $keahlian;
  // foreach
        // $fg = json_decode($keahlian, true);
            // dd($data);
            // $psikolog = User::where('id', $success['id'])->get();
      //      $data = User::where('id',$data->id)->with(['psikolog.layanan'])->first();
            return response()->json(['success' => $data]);
      }
      
       public function update_layanan(Request $request,$id)
      {
          $data= User::find($id);
          $data->psikolog->layanan()->sync($request->layanan_id);
          $data = User::where('id',$data->id)->with(['psikolog.layanan'])->first();
            return response()->json(['success' => $data]);
           //foreach($request->layanan_id)
           //{
             //  $data[]=$request->layanan_id;
           //}
         //  return response()->json($request->all());
      }

       public function update_user(Request $request, $id){
         $this->validate($request, [
         'email' => 'required|string|max:255|unique:users,email,'.$request->id,
         'username' => 'required|string|max:255|unique:users,username,'.$request->id,
         'no_telepon' => 'required|regex:/^[0-9]+$/|max:25',
        ]);
         $data = User::find($id);

         $data->email=$request->email;
         $data->email_verified_at=$request->email_verified_at;
         $data->username=$request->username;
         $data->no_telepon=$request->no_telepon;

         $data->save();
         return response()->json([
         'status'=>'success',
         'message'=>'Data Klien Berhasil Diubah',
         'biodata'=>$data
       ]);
       }
}
