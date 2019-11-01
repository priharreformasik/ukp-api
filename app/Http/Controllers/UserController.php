<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\User;
use Auth;
use File;
use Alert;
use Hash;
use DB;
use Carbon\Carbon;


class UserController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $list = User::where('level','=','Admin')
                      ->orderBy('name')
                      ->get();
        $counter =1;
        return view('user.admin_list',compact('list','counter'));
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
      return view('user.admin_add');
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
    ],
    [
      'name.required' => 'Nama tidak boleh kosong!',
      'name.regex' => 'Nama tidak boleh angka saja!',
      'email.required' => 'Email tidak boleh kosong!',
      'email.unique' => 'Email sudah digunakan!',
      'password.required' => 'Password tidak boleh kosong!',
      'username.required' => 'Username tidak boleh kosong!',
      'username.unique' => 'Username sudah digunakan!',
      'nik.required' => 'NIK tidak boleh kosong!',
      'nik.max' => 'NIK tidak boleh lebih dari 18 angka!',
      'nik.unique' => 'NIK sudah digunakan!',
      'tanggal_lahir.required' => 'Tanggal lahir tidak boleh kosong!',
      'jenis_kelamin.required' => 'Jenis Kelamin tidak boleh kosong!',
      'alamat.required' => 'Alamat tidak boleh kosong!',
      'no_telepon.required' => 'No Telepon tidak boleh kosong!',
      'no_telepon.min' => 'No Telepon minimal 11 angka!',
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

    $user = User::create([
      'name'=>$request->name,
      'email'=>$request->email,
      'password'=>bcrypt($request->password),
      'level'=>'Admin',
      'username'=>$request->username,
      'nik'=>$request->nik,
      'tanggal_lahir' =>$request->tanggal_lahir,
      'jenis_kelamin' =>$request->jenis_kelamin,
      'alamat' =>$request->alamat,
      'no_telepon'=>$request->no_telepon,
      // 'foto'=>$filename,
      //'created_by' => Auth::user()->id,
      //'updated_by' => Auth::user()->id
    ]);

    if(!empty($request->foto)){
        $user->foto=$filename;
        $user->save();
      }else{
        $user->foto='images.png';
        $user->save();
     }
    DB::commit();      
    Alert::success('Berhasil!','Data Berhasil Ditambahkan');
    return redirect('user/admin');
    }


    public function show($id)
    {
      $admin = User::find($id);
      return view('user.admin_detail', compact('admin'));
    }

    public function profile($id)
    {
      $admin = User::find($id);
      return view('user.profile', compact('admin'));
    }

    public function edit($id)
    {
    $data = User::findOrFail($id);
    return view('user.admin_edit',compact('data'));
    //print_r($data);
    }

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
      ],
      [
        'name.required' => 'Nama tidak boleh kosong!',
        'name.regex' => 'Format nama tidak falid!',
        'email.required' => 'Email tidak boleh kosong!',
        'email.unique' => 'Email sudah digunakan!',
        'username.required' => 'Username tidak boleh kosong!',
        'username.unique' => 'Username sudah digunakan!',
        'nik.required' => 'NIK tidak boleh kosong!',
        'nik.unique' => 'NIK sudah digunakan!',
        'nik.regex' => 'Format NIK tidak valid!',
        'nik.max' => 'NIK tidak boleh lebih dari 18 angka!',
        'tanggal_lahir.required' => 'Tanggal lahir tidak boleh kosong!',
        'jenis_kelamin.required' => 'Jenis Kelamin tidak boleh kosong!',
        'alamat.required' => 'Alamat tidak boleh kosong!',
        'no_telepon.required' => 'No Telepon tidak boleh kosong!',
        'no_telepon.min' => 'No Telepon minimal 11 angka!',
      ]);
      $data= User::find($id);
      $data->name=$request->get('name');
      $data->jenis_kelamin= $request->get('jenis_kelamin');
      $data->tanggal_lahir= $request->tanggal_lahir;
      $data->nik = $request->get('nik');
      $data->email = $request->get('email');
      $data->no_telepon = $request->get('no_telepon');
      $data->alamat = $request->get('alamat');
      $data->username = $request->get('username');
      // $data->password = bcrypt($request->get('password'));
      $data->save();
      Alert::success('Berhasil!','Data Berhasil Diubah');
      return redirect('user/admin');  
    }

    public function edit_foto($id)
    {
    $data = User::findOrFail($id);
    return view('user.admin_foto',compact('data'));
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
      return redirect('user/admin/'.$data->id.'/edit');  

    }

    public function edit_profile($id)
    {
    $data = User::findOrFail($id);
    return view('user.profile_edit',compact('data'));
    //print_r($data);
    }

    public function update_profile(Request $request,$id)
    {
      $this->validate($request, [
        'name' => 'required|regex:/^[\pL\s\-]+$/u|string|max:100',
        'email' => 'required|email|max:255|unique:users,email,'.$request->id,
        'username' => 'required|string|max:255|unique:users,username,'.$request->id,
        'nik' => 'required|max:18|unique:users,nik,'.$request->id,
        'tanggal_lahir' => 'required|date',
        'jenis_kelamin' => 'required|string|max:10',
        'alamat' => 'required|string|max:255',
        'no_telepon' => 'required|regex:/^[0-9]+$/|max:25',
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
        'tanggal_lahir.required' => 'Tanggal lahir tidak boleh kosong!',
        'jenis_kelamin.required' => 'Jenis Kelamin tidak boleh kosong!',
        'alamat.required' => 'Alamat tidak boleh kosong!',
        'no_telepon.required' => 'No Telepon tidak boleh kosong!',
      ]);

      $data= User::find($id);
      $data->name=$request->get('name');
      $data->jenis_kelamin= $request->get('jenis_kelamin');
      $data->tanggal_lahir= $request->tanggal_lahir;
      $data->nik = $request->get('nik');
      $data->email = $request->get('email');
      $data->no_telepon = $request->get('no_telepon');
      $data->alamat = $request->get('alamat');
      $data->username = $request->get('username');
      $data->save();
      Alert::success('Berhasil!','Data Berhasil Diubah');
      return redirect('profile/'.Auth::user()->id.'');  
    }

    public function edit_fotoProfile($id)
    {
    $data = User::findOrFail($id);
    return view('user.profile_foto',compact('data'));
    //print_r($data);
    }

    public function update_fotoProfile(Request $request, $id)
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
        $file_server = Storage::get('images/' . $filename);

          // open and resize an image file
          $img = Image::make($file_server)->resize(128, 128);

          // save file as jpg with medium quality
          $img->save(base_path('public/images/' . $filename));
      }
      Alert::success('Berhasil!','Data Berhasil Diubah');
      return redirect('profile/'.Auth::user()->id.'');
    }

    public function edit_password($id)
    {
    $data = User::findOrFail($id);
    return view('user.admin_ganti_password',compact('data'));
    //print_r($data);
    }

    // public function update_password(Request $request){
    //   $ubahPassword = User::find(Auth::user()->id);
    //   if(Hash::check($request->password_lama,$ubahPassword->password)){
    //     if($request->password_baru == $request->konfirmasi){
    //       $ubahPassword->password = bcrypt($request->konfirmasi);
    //       $ubahPassword->save();
    //       Alert::success('Berhasil!','Password Berhasil Diubah!');
    //       return redirect('profile/'.Auth::user()->id.'');
    //     }else{
    //       Alert::warning('Peringatan!','Password Baru & Konfirmasi Tidak Sama!');
    //       return redirect()->back();
    //     }
    //   }else{
    //       Alert::warning('Peringatan!','Password Lama Salah!');
    //       return redirect()->back();
    //   }
    // }

    public function update_password(Request $request){
      $ubahPassword = User::find(Auth::user()->id);
      if(Hash::check($request->password_lama,$ubahPassword->password)){
        if($request->password_baru == $request->konfirmasi){
          $ubahPassword->password = bcrypt($request->konfirmasi);
          $this->validate($request, [
            'password_baru' => 'required|min:6',
            'konfirmasi' => 'required|min:6',
            'password_lama' => 'required|min:6',
          ],
          [
            'password_baru.required' => 'Password Baru tidak boleh kosong!',
            'password_baru.min' => 'Password Baru minimal 6 karakter',
            'konfirmasi.required' => 'Konfirmasi password tidak boleh kosong!',
            'konfirmasi.min' => 'Konfirmasi password minimal 6 karakter',
            'password_lama.required' => 'Password Lama tidak boleh kosong!',
            'password_lama.min' => 'Password Lama minimal 6 karakter',

          ]);
          $ubahPassword->save();
          Alert::success('Berhasil!','Password Berhasil Diubah!');
          return redirect('profile/'.Auth::user()->id.'');
        }else{
          Alert::warning('Peringatan!','Password Baru & Konfirmasi Tidak Sama!');
          return redirect()->back();
        }
      }else{
          Alert::warning('Peringatan!','Password Lama Salah!');
          return redirect()->back();
      }
    }

    public function update_password_api(Request $request){

      $ubahPassword = User::find(Auth::user()->id);
      if(Hash::check($request->password_lama,$ubahPassword->password)){
        if($request->password_baru == $request->konfirmasi){
          $ubahPassword->password = bcrypt($request->konfirmasi);
          $ubahPassword->save();
          Alert::success('Berhasil!','Password Berhasil Diubah!');
          return redirect('profile/'.Auth::user()->id.'');
        }
      }else{
          Alert::warning('Warning!','Something went wrong!');
          return redirect()->back();
      }
    }

    public function edit_password_admin($id)
    {
    $data = User::findOrFail($id);
    return view('user.admin_ubah_password',compact('data'));
    //print_r($data);
    }

    public function update_password_admin(Request $request,$id)
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
          return redirect('user/admin/'.$data->id.'/edit');
        }else{
          Alert::warning('Peringatan!','Password Baru & Konfirmasi Tidak Sama!');
          return redirect()->back();
        } 
    } 

    public function destroy($id)
    {
      $admin=User::where('id','=','1')->first();
      // dd(auth()->user()->id);
      
      if(Auth::user()->id != $id && $admin->id != $id){
        $data = User::find($id)->delete();
        Alert::success('Berhasil!','Data Berhasil Dihapus');
        return redirect('user/admin');
      }else{
        Alert::warning('Peringatan!','Data Tidak Dapat Dihapus');
        return redirect('user/admin');
      }
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
