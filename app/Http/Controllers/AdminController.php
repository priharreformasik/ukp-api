<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\Admin;
use App\User;
use Auth;
use File;
use Carbon\Carbon;

class AdminController extends Controller
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
        $list = Admin::all()->sortBy('id');
        return view('user.admin_list',compact('list'));
    }

    public function getFoto($id)
    {
        $admin = Person::findOrFail($id);
        if($admin->foto!=null) {
            if (Storage::exists('images/' . $admin->foto)) {
                $file = Storage::get('images/' . $admin->foto);
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
      'nik' => 'required|max:18|unique:users,nik,'.$request->id,
      'tanggal_lahir' => 'required|date',
      'jenis_kelamin' => 'required|string|max:10',
      'alamat' => 'required|string|max:255',
      'no_telepon' => 'required|regex:/^[0-9]+$/|max:25',
      'foto' => 'required|max:2000',
    ],
    [
      'name.required' => 'Nama tidak boleh kosong!',
      'name.regex' => 'Nama tidak boleh angka saja!',
      'email.required' => 'Email tidak boleh kosong!',
      'email.unique' => 'Email sudah digunakan!',
      'password.required' => 'Password tidak boleh kosong!',
      'password.min' => 'Password minimal 6 karakter',
      'username.required' => 'Username tidak boleh kosong!',
      'username.unique' => 'Username sudah digunakan!',
      'nik.required' => 'NIK tidak boleh kosong!',
      'nik.max' => 'NIK tidak boleh lebih dari 18 angka!',
      'nik.unique' => 'NIK sudah digunakan!',
      'tanggal_lahir.required' => 'Tanggal lahir tidak boleh kosong!',
      'jenis_kelamin.required' => 'Jenis Kelamin tidak boleh kosong!',
      'alamat.required' => 'Alamat tidak boleh kosong!',
      'no_telepon.required' => 'No Telepon tidak boleh kosong!',
      'foto.required' => 'Foto tidak boleh kosong!',
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

    Admin::create([
      'nama' => request('nama'),
      'jenis_kelamin' => request('jenis_kelamin'),
      'tanggal_lahir' => Carbon::parse($request->tanggal_lahir),
      'nik' => request('nik'),
      'email' => request('email'),
      'no_telepon' => request('no_telepon'),
      'alamat' => request('alamat'),
      //'foto' => $filename,
      'username' => request('username'),
      'nama' => request('nama'),
      'password' => request('password'),
      'created_by' => Auth::user()->id,
      'updated_by' => Auth::user()->id
    ]);

    return redirect('user/admin')->with('success','Admin berhasil disimpan.');
    }


    public function show($id)
    {
      $admin = Admin::find($id);
      return view('user.admin_detail', compact('admin'));
    }

    public function edit($id)
    {
    $data = Admin::findOrFail($id);
    return view('user.admin_edit',compact('data'));
    //print_r($data);
    }

    public function update(Request $request,$id)
    {
      $this->validate($request, [
      'name' => 'required|regex:/^[\pL\s\-]+$/u|string|max:100',
      'email' => 'required|email|unique:users|max:255',
      'username' => 'required|string|unique:users|max:255',
      'nik' => 'required|max:18|unique:users,nik,'.$request->id,
      'tanggal_lahir' => 'required|date',
      'jenis_kelamin' => 'required|string|max:10',
      'alamat' => 'required|string|max:255',
      'no_telepon' => 'required|regex:/^[0-9]+$/|max:25',
      'foto' => 'required|max:2000',
    ],
    [
      'name.required' => 'Nama tidak boleh kosong!',
      'name.regex' => 'Nama tidak boleh angka saja!',
      'email.required' => 'Email tidak boleh kosong!',
      'email.unique' => 'Email sudah digunakan!',
      'username.required' => 'Username tidak boleh kosong!',
      'username.unique' => 'Username sudah digunakan!',
      'nik.required' => 'NIK tidak boleh kosong!',
      'nik.max' => 'NIK tidak boleh lebih dari 18 angka!',
      'nik.unique' => 'NIK sudah digunakan!',
      'tanggal_lahir.required' => 'Tanggal lahir tidak boleh kosong!',
      'jenis_kelamin.required' => 'Jenis Kelamin tidak boleh kosong!',
      'alamat.required' => 'Alamat tidak boleh kosong!',
      'no_telepon.required' => 'No Telepon tidak boleh kosong!',
      'foto.required' => 'Foto tidak boleh kosong!',
    ]);
      $data= Admin::find($id);
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

      $data->nama=$request->get('nama');
      $data->jenis_kelamin= $request->get('jenis_kelamin');
      $data->tanggal_lahir= Carbon::parse($request->tanggal_lahir);
      $data->nik = $request->get('nik');
      $data->email = $request->get('email');
      $data->no_telepon = $request->get('no_telepon');
      $data->alamat = $request->get('alamat');
      $data->username = $request->get('username');
      $data->password = $request->get('password');
      $data->save();
      return redirect('user/admin')->with('sukses', 'Data Berhasil Diubah!');   
    }

    public function destroy($id)
    {
      $data = Admin::find($id)->delete();
      return redirect('user/admin');
    }
}
