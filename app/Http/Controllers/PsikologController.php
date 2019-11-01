<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\Exports\PsikologExport;
use App\Psikolog;
use App\Keahlian;
use App\Layanan;
use App\User;
use Auth;
use File;
use Carbon\Carbon;
use DB;
use Excel;
use PDF;
use Alert;

class PsikologController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $list = User::where('level','Psikolog')
                    ->where('status','Approved')
                    ->orderBy('name')
                    ->get();
        $counter = 1;
        return view('user.psikolog_list', compact('list', 'counter'));
        //dd($list);
    }   
    

    public function excel(){
      return Excel::download(new Psikolog, 'data_psikolog.xlsx');
    }
  //   public function excel(){
  //     $user_data = DB::table('psikolog')->get()->toArray();
  //     $user_array[] = array('name','email');
  //     foreach ($user_data as $psikolog) {
  //       $user_array[] = array(
  //         'name' => $psikolog->name,
  //         'email' => $psikolog->email
  //       );
  //   } 
  //   Ecxel::create('Data Psikolog', function($excel) use ($user_array){
  //       $excel->setTitle('Data Psikolog');
  //       $excel->sheet('Data Psikolog', function($sheet) use ($user_array){
  //         $sheet->fromArray($user_array, null, 'A1', false, false);
  //       });
  //   })->download('xlsx');
  // }

    public function status(Request $request, $id)
    {
        $psikolog = User::find($id);
        if($psikolog['isActive']=='Aktif'){
          $psikolog->isActive = 'Tidak Aktif';
        }
        else{
          $psikolog->isActive = 'Aktif';
        }
        $psikolog->save();

        Alert::success('Berhasil!','Status Berhasil Diubah');
        return redirect()->back();
    }

    public function getFoto($id)
    {
        $user = User::findOrFail($id);
        if($user->foto!=null) {
            if (Storage::exists('images/' . $user->foto)) {
                $file = Storage::get('images/' . $user->foto);
            } else {
                $file = Storage::get('images/default.jpg');
            }
        }
        else{
            $file = Storage::get('images/default.jpg');
        }

        return (new Response($file, 200))
            ->header('Content-Type', 'image/jpeg');

    }

    public function create()
    {
      $layanan = Layanan::all()->sortBy('id');
      $user = User::all()->sortBy('id');
      return view('user.psikolog_add', compact('user','layanan'));
    }   
    
    public function store(Request $request)
    {

    $this->validate($request, [
      'name' => 'required|regex:/^[\pL\s\-]+$/u|string|max:100',
      'email' => 'required|email|unique:users|max:255',
      'password' => 'required|min:6',
      'username' => 'required|string|unique:users|max:255',
      'nik' => 'required|max:16|regex:/^[0-9]+$/|unique:users,nik,'.$request->id,
      'tanggal_lahir' => 'required|date',
      'jenis_kelamin' => 'required|string|max:10',
      'alamat' => 'required|string|max:255',
      'no_telepon' => 'required|regex:/^[0-9]+$/|max:25|min:11',
      'foto' => 'mimes:jpeg,png,jpg|max:2000',
      'gelar' => 'required',
      'no_sipp' => 'required',
      'layanan_id' => 'required'
    ],
    [
      'name.required' => 'Nama tidak boleh kosong!',
      'name.regex' => 'Format nama tidak valid!',
      'email.required' => 'Email tidak boleh kosong!',
      'email.unique' => 'Email sudah digunakan!',
      'password.required' => 'Password tidak boleh kosong!',
      'username.required' => 'Username tidak boleh kosong!',
      'username.unique' => 'Username sudah digunakan!',
      'nik.required' => 'NIK tidak boleh kosong!',
      'nik.max' => 'NIK tidak boleh lebih dari 16 angka!',
      'nik.unique' => 'NIK sudah digunakan!',
      'nik.regex' => 'Format NIK tidak valid!',
      'tanggal_lahir.required' => 'Tanggal lahir tidak boleh kosong!',
      'jenis_kelamin.required' => 'Jenis Kelamin tidak boleh kosong!',
      'alamat.required' => 'Alamat tidak boleh kosong!',
      'no_telepon.required' => 'No Telepon tidak boleh kosong!',
      'no_telepon.min' => 'No Telepon minimal 11 angka!',
      'no_telepon.regex' => 'Format No Telepon tidak valid!',
      // 'foto.required' => 'Foto tidak boleh kosong!',
      'gelar.required' => 'Gelar tidak boleh kosong!',
      'no_sipp.required' => 'No SIPP tidak boleh kosong!',
      'layanan_id.required' => 'Layanan tidak boleh kosong!',
    ]);

    if(!empty($request->foto)){
      $file = $request->file('foto');
      $extension = strtolower($file->getClientOriginalExtension());
      $filename = $request->nik . '.' . $extension;

      Storage::put('images/' . $filename, File::get($file));
      //Storage::disk('public')->put('$filename', File::get($file));
      $file_server = Storage::get('images/' . $filename);

        // open and resize an image file
        $img = Image::make($file_server)->resize(128, 128);

        // save file as jpg with medium quality
        //$img->save(storage_path('app/images/' . $filename));
        $img->save(base_path('public/images/' . $filename));
        //$file_server = $request->foto->move(base_path('public/images'), $filename);
    }
    // dd($request);
    $psikolog = User::create([
      'name'=>$request->name,
      'email'=>$request->email,
      'password'=>bcrypt($request->password),
      'level'=>'Psikolog',
      'username'=>$request->username,
      'nik'=>$request->nik,
      'tanggal_lahir' => $request->tanggal_lahir,
      'jenis_kelamin' =>$request->jenis_kelamin,
      'alamat' =>$request->alamat,
      'no_telepon'=>$request->no_telepon,
      // 'foto'=>$filename,      
      'status'=>'Approved',
      'isActive' => 'Aktif',
      ])->psikolog()->create([
          'gelar'=>$request->gelar,
          'no_sipp'=>$request->no_sipp,
      ]);
      $user = User::where('id',$psikolog->user_id)->first();
      $psikolog->layanan()->attach($request->layanan_id);
      if($request->foto){
        $user->foto=$filename;
        $user->save();
      }else{
        $user->foto='images.png';
        $user->save();
      }
      DB::commit();
      Alert::success('Berhasil!','Data Berhasil Ditambahkan');
      return redirect('user/psikolog');
    
    }


    public function show($id)
    {
      $user = User::where('id', $id)
                    ->with('psikolog.layanan')
                    ->first();
                    // dd($user);
      return view('user.psikolog_detail', compact('user'));
    }

    public function edit($id)
    {
    $data = User::where('id', $id)
                    ->with(['psikolog.layanan' => function($q){
                      $q->select('nama')->get()->toArray();
                    }])
                    ->first();
                    // dd($data);
    $dataLayanan = DB::table('layanan_psikolog')->where('psikolog_id', $data->psikolog->id)->get()->pluck('layanan_id');
    // dd($dataLayanan);
    $layanan = Layanan::all();
    return view('user.psikolog_edit',compact('data','layanan', 'dataLayanan'));
    //print_r($data);
    }

    // $check_username = User::where('username', $request->username)->get()->count();
    // // dd($check);
    // if($check_username == 1 && Auth::user()->username == $request->username){

    public function update(Request $request,$id)
    {     

      $this->validate($request, [
      'name' => 'required|regex:/^[\pL\s\-]+$/u|string|max:100',
      'email' => 'required|email|max:255|unique:users,email,'.$request->id,
      'username' => 'required|string|max:255|unique:users,username,'.$request->id,
      'nik' => 'required|max:18|regex:/^[0-9]+$/|unique:users,nik,'.$request->id,
      'tanggal_lahir' => 'required|date',
      'jenis_kelamin' => 'required|string|max:10',
      'alamat' => 'required|string|max:255',
      'no_telepon' => 'required|regex:/^[0-9]+$/|max:25|min:11',
      'gelar' => 'required',
      'no_sipp' => 'required',
      'layanan_id' => 'required'
     ],
     [
      'name.required' => 'Nama tidak boleh kosong!',
      'name.regex' => 'Format nama tidak valid!',
      'email.required' => 'Email tidak boleh kosong!',
      'email.unique' => 'Email sudah digunakan!',
      'username.required' => 'Username tidak boleh kosong!',
      'username.unique' => 'Username sudah digunakan!',
      'nik.required' => 'NIK tidak boleh kosong!',
      'nik.unique' => 'NIK sudah digunakan!',
      'nik.max' => 'NIK tidak boleh lebih dari 18 angka!',
      'nik.regex' => 'Format NIK tidak valid!',
      'tanggal_lahir.required' => 'Tanggal lahir tidak boleh kosong!',
      'jenis_kelamin.required' => 'Jenis Kelamin tidak boleh kosong!',
      'alamat.required' => 'Alamat tidak boleh kosong!',
      'no_telepon.required' => 'No Telepon tidak boleh kosong!',
      'no_telepon.min' => 'No Telepon minimal 11 angka!',
      'no_telepon.regex' => 'Format No Telepon tidak valid!',
      'gelar.required' => 'Gelar tidak boleh kosong!',
      'no_sipp.required' => 'No SIPP tidak boleh kosong!',
      'layanan_id.required' => 'Keahlian tidak boleh kosong!',
    ]);
    

      $data= User::find($id);

      $data->name=$request->get('name');
      $data->jenis_kelamin= $request->get('jenis_kelamin');
      $data->tanggal_lahir= $request->tanggal_lahir;
      $data->nik = $request->get('nik');
      $data->psikolog()->update([
        'no_sipp' => $request->get('no_sipp'),
        'gelar'=>$request->get('gelar'),
      ]);
      $data->psikolog->layanan()->sync($request->layanan_id);
          
      $data->alamat = $request->get('alamat');
      $data->no_telepon = $request->get('no_telepon');
      $data->email = $request->get('email');
      $data->username = $request->get('username');
      $data->save();
      Alert::success('Berhasil!','Data Berhasil Diubah');
      return redirect('user/psikolog');  
    }

    public function edit_foto($id)
    {
    $data = User::findOrFail($id);
    return view('user.psikolog_foto',compact('data'));
    //print_r($data);
    }

    public function update_foto(Request $request, $id)
    {
      $this->validate($request, [
      'foto' => 'required|max:2000',
    ],
    [
      'foto.required' => 'Foto tidak boleh kosong!',
    ]);
      $data= User::find($id);
      if(!empty($request->foto)){
        $file = $request->file('foto');
        $extension = strtolower($file->getClientOriginalExtension());

        $filename = $data->nik . '.' . $extension;
        $data->foto = $filename;
        $data->save();

        Storage::put('images/' . $filename, File::get($file));
        //Storage::disk('public')->put('$filename', File::get($file));
        $file_server = Storage::get('images/' . $filename);

          // open and resize an image file
          $img = Image::make($file_server)->resize(128, 128);

          // save file as jpg with medium quality
          //$img->save(storage_path('app/images/' . $filename));
          $img->save(base_path('public/images/' . $filename));
          //$file_server = $request->foto->move(base_path('public/images'), $filename);
      }
      Alert::success('Berhasil!','Foto Berhasil Diubah');
      return redirect('user/psikolog/'.$data->id.'/edit');  

    }

    public function edit_password($id)
    {
    $data = User::findOrFail($id);
    return view('user.psikolog_ganti_password',compact('data'));
    //print_r($data);
    }

    public function update_password(Request $request,$id)
    {
      
      $data= User::find($id);
      if($request->password == $request->konfirmasi){
          $data->password = bcrypt($request->konfirmasi);
          $this->validate($request, [
            'password' => 'required|min:6',
            'konfirmasi' => 'required|min:6'
          ],
          [
            'password.required' => 'Password tidak boleh kosong!',
            'password.min' => 'Password minimal 6 karakter',
            'konfirmasi.required' => 'Konfirmasi password tidak boleh kosong!',
            'konfirmasi.min' => 'Konfirmasi password minimal 6 karakter',

          ]);
          $data->save();
          Alert::success('Berhasil!','Password Berhasil Diubah!');
          return redirect('user/psikolog/'.$data->id.'/edit');
        }else{
          Alert::warning('Peringatan!','Password Baru & Konfirmasi Tidak Sama!');
          return redirect()->back();
        } 
    } 

    public function destroy($id)
    {
      $psikolog_id = Psikolog::where('user_id',$id)->delete();
      $data = User::find($id)->delete();
      Alert::success('Berhasil!','Data Berhasil Dihapus');
      return response()->json(['success'=>"Data Deleted successfully.", 'tr'=>'tr_'.$id]);
    }

    public function withTrashed()
    {
      $data = User::onlyTrashed()->get();
    }

    public function restore($id)
    {
      User::withTrashed()->where('id',$id)->restore();
      return "Success restore";
    }

    public function forceDelete($id)
    {
      $data = User::onlyTrashed($id)->first()->forceDelete();
      return "Success force delete";
    }

    public function export_pdf()
    {
      // Fetch all customers from database
      $data = Psikolog::leftjoin('users','psikolog.user_id','=','users.id')
              ->select('users.id','users.name','users.jenis_kelamin','users.tanggal_lahir','users.nik','users.alamat','users.email','users.no_telepon','psikolog.no_sipp','psikolog.gelar')
              ->where('level','Psikolog')
              ->where('status','Approved')
              ->orderBy('users.name')
              ->get();
      // Send data to the view using loadView function of PDF facade
      $pdf = PDF::loadView('pdf.psikolog_pdf', compact('data'))->setPaper('a4', 'landscape');
      // If you want to store the generated pdf to the server then you can use the store function
      $pdf->save(storage_path().'_filename.pdf');
      // Finally, you can download the file using download function
      return $pdf->download('Daftar_Psikolog.pdf');
    }
}
