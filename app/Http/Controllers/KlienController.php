<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Hash;
use App\Klien;
use App\User;
use App\Kategori;
use Auth;
use Alert;
use File;
use Carbon\Carbon;
use PDF;
use Excel;
use DB;

class KlienController extends Controller
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
        $list = Klien::leftJoin('users','users.id','=','klien.user_id')
                      ->select('users.id','users.name','users.jenis_kelamin','klien.parent_id','users.alamat','users.nik','users.no_telepon')
                      ->orderBy('users.name')
                      ->get();
        $counter = 1;
        return view('user.klien_list',compact('list','counter'));
    }    

    public function create()
    {
      $kategori = Kategori::all()->sortBy('id');
      $user = User::all()->sortBy('id');
      return view('user.klien_add', compact('kategori','user'));
    }

    public function store(Request $request)
    {
    $this->validate($request, [
      'name' => 'required|regex:/^[\pL\s\-]+$/u|string|max:100',
      'email' => 'required|email|unique:users|max:255',
      'password' => 'required|min:6',
      'username' => 'required|string|unique:users|max:255',
      'nik' => 'required|max:18|regex:/^[0-9]+$/|unique:users,nik,'.$request->id,
      'tanggal_lahir' => 'required|date',
      'jenis_kelamin' => 'required|string|max:10',
      'alamat' => 'required|string|max:255',
      'no_telepon' => 'required|regex:/^[0-9]+$/|max:25|min:11',
      'foto' => 'mimes:jpeg,png,jpg|max:2000',
      'anak_ke' => 'required|regex:/^[0-9]+$/|max:25',
      'jumlah_saudara' => 'required|regex:/^[0-9]+$/|max:25',
      'pendidikan_terakhir' => 'required',
    ],
    [
      'name.required' => 'Nama tidak boleh kosong!',
      'name.regex' => 'Format nama tidak valid!',
      'email.required' => 'Email tidak boleh kosong!',
      'email.unique' => 'Email sudah digunakan!',
      'password.required' => 'Password tidak boleh kosong!',
      'password.min' => 'Password minimal 6 karakter',
      'username.required' => 'Username tidak boleh kosong!',
      'username.unique' => 'Username sudah digunakan!',
      'nik.required' => 'NIK tidak boleh kosong!',
      'nik.max' => 'NIK tidak boleh lebih dari 18 angka!',
      'nik.unique' => 'NIK sudah digunakan!',
      'nik.regex' => 'Format NIK tidak valid!',
      'tanggal_lahir.required' => 'Tanggal lahir tidak boleh kosong!',
      'jenis_kelamin.required' => 'Jenis Kelamin tidak boleh kosong!',
      'alamat.required' => 'Alamat tidak boleh kosong!',
      'no_telepon.required' => 'No Telepon tidak boleh kosong!',
      'no_telepon.min' => 'No Telepon minimal 11 angka!',
      'no_telepon.regex' => 'Format No Telepon tidak valid!',
      'anak_ke.required' => 'Anak ke tidak boleh kosong!',
      'anak_ke.regex' => 'Format anak ke tidak valid!',
      'jumlah_saudara.required' => 'Jumlah saudara tidak boleh kosong!',
      'jumlah_saudara.regex' => 'Format jumlah saudara tidak valid!',
      'pendidikan_terakhir.required' => 'Pendidikan terakhir tidak boleh kosong!',
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

    $klien = User::create([
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
      // 'foto'=>$filename,
      ])->klien()->create([
          'anak_ke' => request('anak_ke'),
          'jumlah_saudara' => request('jumlah_saudara'),
          'pendidikan_terakhir' => request('pendidikan_terakhir'),
          'kategori_id' => request('kategori_id'),
      ]); 

      $user = User::where('id',$klien->user_id)->first();
      if($request->foto){
        $user->foto=$filename;
        $user->save();
      }else{
        $user->foto='images.png';
        $user->save();
      }
      DB::commit();
      Alert::success('Berhasil!','Data Berhasil Ditambahkan');
    return redirect('user/klien');
    }

    public function create_pendaftar($id)
    {
      $user = User::find($id);
      $kategori = Kategori::all()->sortBy('id');
      return view('user.pendaftar_add', compact('kategori','user'));
    }

    public function store_pendaftar(Request $request){
      $this->validate($request, [
      'name' => 'required|regex:/^[\pL\s\-]+$/u|string|max:100',
      'nik' => 'required|max:18|regex:/^[0-9]+$/|unique:users,nik,'.$request->id,
      'tanggal_lahir' => 'required|date',
      'jenis_kelamin' => 'required|string|max:10',
      'anak_ke' => 'required|regex:/^[0-9]+$/|max:25',
      'jumlah_saudara' => 'required|regex:/^[0-9]+$/|max:25',
      'hub_pendaftar' => 'required',
      'pendidikan_terakhir' => 'required'
    ],
    [
      'name.required' => 'Nama tidak boleh kosong!',
      'name.regex' => 'Format nama tidak valid!', 
      'nik.required' => 'NIK tidak boleh kosong!',
      'nik.max' => 'NIK tidak boleh lebih dari 18 angka!',
      'nik.unique' => 'NIK sudah digunakan!',
      'nik.regex' => 'Format NIK tidak valid!',
      'tanggal_lahir.required' => 'Tanggal lahir tidak boleh kosong!',
      'jenis_kelamin.required' => 'Jenis Kelamin tidak boleh kosong!',
      'anak_ke.required' => 'Anak ke tidak boleh kosong!',
      'anak_ke.regex' => 'Format anak ke tidak valid!',
      'jumlah_saudara.required' => 'Jumlah saudara tidak boleh kosong!',
      'jumlah_saudara.regex' => 'Format jumlah saudara tidak valid!',
      'hub_pendaftar.required' => 'Hubungan pendaftar tidak boleh kosong!',
      'pendidikan_terakhir.required' => 'Pendidikan terakhir tidak boleh kosong!'
    ]);
      $user = User::create([
      'name'=>$request->name,
      'password'=>Hash::make(str_random(8)),
      'level'=>'Klien',
      'nik'=>$request->nik,
      'tanggal_lahir' => $request->tanggal_lahir,
      'jenis_kelamin' =>$request->jenis_kelamin,
      'alamat' =>$request->alamat,
      'no_telepon'=>$request->no_telepon,
      ])->klien()->create([
          'anak_ke' => request('anak_ke'),
          'jumlah_saudara' => request('jumlah_saudara'),
          'pendidikan_terakhir' => request('pendidikan_terakhir'),
          'kategori_id' => request('kategori_id'),
          'parent_id' => $request->parent_id,
          'hub_pendaftar' => request('hub_pendaftar'),
      ]); 
      Alert::success('Berhasil!','Data Berhasil Ditambahkan');
      return redirect('user/klien');
    }

    public function show($id)
    {
      $user = User::find($id);
      return view('user.klien_detail', compact('user'));
    }

    public function edit($id, Request $request)
    {
    $data = User::findOrFail($id);
    $kategori = Kategori::all();
    // dd($data);
    return view('user.klien_edit',compact('data','kategori'));
    //print_r($data);

    }

    public function update(Request $request,$id)
    {
      $this->validate($request, [
      'name' => 'required|regex:/^[\pL\s\-]+$/u|string|max:100',
      'nik' => 'required|max:18|regex:/^[0-9]+$/|unique:users,nik,'.$request->id,
      'email' => 'required|email|max:255|unique:users,email,'.$request->id,
      'username' => 'required|string|max:255|unique:users,username,'.$request->id,
      'tanggal_lahir' => 'required|date',
      'jenis_kelamin' => 'required|string|max:10',
      'no_telepon' => 'required|regex:/^[0-9]+$/|max:25|min:11',
      'anak_ke' => 'required|regex:/^[0-9]+$/|max:25',
      'jumlah_saudara' => 'required|regex:/^[0-9]+$/|max:25',
    ],
    [
      'name.required' => 'Nama tidak boleh kosong!',
      'name.regex' => 'Format nama tidak valid!',
      'nik.required' => 'NIK tidak boleh kosong!',
      'nik.max' => 'NIK tidak boleh lebih dari 18 angka!',
      'nik.unique' => 'NIK sudah digunakan!',
      'nik.regex' => 'Format NIK tidak valid!',
      'email.required' => 'Email tidak boleh kosong!',
      'email.unique' => 'Email sudah digunakan!',
      'username.required' => 'Username tidak boleh kosong!',
      'username.unique' => 'Username sudah digunakan!',
      'tanggal_lahir.required' => 'Tanggal lahir tidak boleh kosong!',
      'jenis_kelamin.required' => 'Jenis Kelamin tidak boleh kosong!',
      'no_telepon.min' => 'No Telepon minimal 11 angka!',
      'no_telepon.regex' => 'Format No Telepon tidak valid!',
      'anak_ke.required' => 'Anak ke tidak boleh kosong!',
      'anak_ke.regex' => 'Format anak ke tidak valid!',
      'jumlah_saudara.required' => 'Jumlah saudara tidak boleh kosong!',
      'jumlah_saudara.regex' => 'Format jumlah saudara tidak valid!',
    ]);   

      $data= User::find($id);
      $data->name=$request->get('name');
      $data->jenis_kelamin= $request->get('jenis_kelamin');
      $data->tanggal_lahir= $request->tanggal_lahir;
      $data->nik = $request->get('nik');
      $data->klien()->update([
        'anak_ke' => $request->get('anak_ke'),
        'jumlah_saudara'=>$request->get('jumlah_saudara'),
        'pendidikan_terakhir'=>$request->get('pendidikan_terakhir'),
        'kategori_id' => $request->get('kategori_id')
      ]);

      $data->alamat = $request->get('alamat');
      $data->no_telepon = $request->get('no_telepon');
      $data->email = $request->get('email');
      $data->username = $request->get('username');
      $data->save();
      Alert::success('Berhasil!','Data Berhasil Diubah');
      return redirect('user/klien'); 
    }  

    public function edit_pendaftar($id, Request $request)
    {
    $data = User::findOrFail($id);
    $kategori = Kategori::all();
    // dd($data);
    return view('user.pendaftar_edit',compact('data','kategori'));
    //print_r($data);

    }

    public function update_pendaftar(Request $request,$id)
    {
      $this->validate($request, [
      'name' => 'required|regex:/^[\pL\s\-]+$/u|string|max:100',
      'nik' => 'required|max:18|regex:/^[0-9]+$/|unique:users,nik,'.$request->id,
      'tanggal_lahir' => 'required|date',
      'jenis_kelamin' => 'required|string|max:10',
      'anak_ke' => 'required|regex:/^[0-9]+$/|max:25',
      'jumlah_saudara' => 'required|regex:/^[0-9]+$/|max:25',
    ],
    [
      'name.required' => 'Nama tidak boleh kosong!',
      'name.regex' => 'Format nama tidak valid!',
      'nik.required' => 'NIK tidak boleh kosong!',
      'nik.max' => 'NIK tidak boleh lebih dari 18 angka!',
      'nik.unique' => 'NIK sudah digunakan!',
      'nik.regex' => 'Format NIK tidak valid!',
      'tanggal_lahir.required' => 'Tanggal lahir tidak boleh kosong!',
      'jenis_kelamin.required' => 'Jenis Kelamin tidak boleh kosong!',
      'anak_ke.required' => 'Anak ke tidak boleh kosong!',
      'anak_ke.regex' => 'Format anak ke tidak valid!',
      'jumlah_saudara.required' => 'Jumlah saudara tidak boleh kosong!',
      'jumlah_saudara.regex' => 'Format jumlah saudara tidak valid!',
    ]);   

      $data= User::find($id);
      $data->name=$request->get('name');
      $data->jenis_kelamin= $request->get('jenis_kelamin');
      $data->tanggal_lahir= $request->tanggal_lahir;
      $data->nik = $request->get('nik');
      $data->klien()->update([
        'anak_ke' => $request->get('anak_ke'),
        'jumlah_saudara'=>$request->get('jumlah_saudara'),
        'pendidikan_terakhir'=>$request->get('pendidikan_terakhir'),
        'kategori_id' => $request->get('kategori_id')
      ]);

      $data->alamat = $request->get('alamat');
      $data->no_telepon = $request->get('no_telepon');
      $data->save();
      Alert::success('Berhasil!','Data Berhasil Diubah');
      return redirect('user/klien'); 
    }  

    public function edit_foto($id)
    {
    $data = User::findOrFail($id);
    return view('user.klien_foto',compact('data'));
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
      return redirect('user/klien/'.$data->id.'/edit'); 
    }

    public function edit_foto_pendaftar($id)
    {
    $data = User::findOrFail($id);
    return view('user.pendaftar_foto',compact('data'));
    //print_r($data);
    }

    public function update_foto_pendaftar(Request $request, $id)
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
      return redirect('user/pendaftar/'.$data->id.'/edit'); 
    }

    public function edit_password($id)
    {
    $data = User::findOrFail($id);
    return view('user.klien_ganti_password',compact('data'));
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
          return redirect('user/klien/'.$data->id.'/edit');
        }else{
          Alert::warning('Peringatan!','Password Baru & Konfirmasi Tidak Sama!');
          return redirect()->back();
        } 
    }  

    public function excel(){

      return Excel::download(new Klien, 'data_klien.xlsx');

    }

    public function destroy($id)
    {
      $klien_id = Klien::where('user_id',$id)->delete();
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
}
