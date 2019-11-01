<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\Layanan;
use App\User;
use Auth;
use File;
use Alert;
use Symfony\Component\Console\Helper;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;

class LayananController extends Controller
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


    public function layanan(){
       $layanan = Layanan::all();
       return response()->json([
         'status'=>'success',
         'layanan'=> $layanan ,
       ]);
     }

    public function store_api(Request $request)
    {
      $layanan = Layanan::create([
        'nama' => request('nama'),
        'deskripsi' => request('deskripsi'),
        'harga' => request('harga'),
        'foto' => request('foto')
      ]);
    
      $optionBuilder = new OptionsBuilder();
      $optionBuilder->setTimeToLive(60*20);

      $notificationBuilder = new PayloadNotificationBuilder('notif');
      $notificationBuilder->setBody('cek pesan')
                  ->setSound('default');

      $dataBuilder = new PayloadDataBuilder();
      $dataBuilder->addData(['a_data' => 'my_data']);

      $option = $optionBuilder->build();
      $notification = $notificationBuilder->build();
      $data = $dataBuilder->build();

      $tokens = User::where('fcm_token',$request->fcm_token)->pluck('fcm_token')->first();
      // dd($token);

      $downstreamResponse = FCM::sendTo($tokens, $option, $notification, $data);

      $downstreamResponse->numberSuccess();
      $downstreamResponse->numberFailure();
      $downstreamResponse->numberModification();
      // dd($downstreamResponse);

      return response()->json([
        'status'=>'successsssss',
        'result'=> $layanan ,
        'cek'=>$downstreamResponse
      ]);
    }

    public function update_api(Request $request,$id)
    {
      $data = Layanan::find($id);
      $data->nama=$request->get('nama');
        $data->deskripsi=$request->get('deskripsi');
        $data->harga=$request->get('harga');
        $data->save();
      return response()->json([
        'status'=>'successsssss',
        'result'=> $data ,
      ]);
    }

    public function index()
    {
        $list = Layanan::all()->sortBy('id');
        return view('data.layanan_list',compact('list'));
    }    

    public function create()
    {
      return view('data.layanan_add');
    }

    public function store(Request $request)
    {
      $this->validate($request, [
        'nama' => 'unique:layanan,nama|required',
        'deskripsi' => 'required',
        'harga' => 'required|regex:/^[0-9]+$/',
        'foto' => 'mimes:jpeg,png,jpg|max:2000',
      ],
      [
        'nama.required' => 'Nama tidak boleh kosong!',
        'nama.unique' => 'Nama sudah tersedia!',
        'deskripsi.required' => 'Deskripsi tidak boleh kosong!',
        'harga.required' => 'Harga tidak boleh kosong!',
        'harga.regex' => 'Format harga tidak valid!',
      ]);
      if(!empty($request->foto)){
      $file = $request->file('foto');
      $extension = strtolower($file->getClientOriginalExtension());
      $filename = $request->nama . '.' . $extension;

      Storage::put('images/' . $filename, File::get($file));

      $file_server = Storage::get('images/' . $filename);

        // open and resize an image file
        $img = Image::make($file_server)->resize(128, 128);

        // save file as jpg with medium quality
        $img->save(base_path('public/images/' . $filename));
      }
      $layanan = Layanan::create([
        'nama' => request('nama'),
        'deskripsi' => request('deskripsi'),
        'harga' => request('harga'),
      ]);

      if(!empty($request->foto)){
        $layanan->foto=$filename;
        $layanan->save();
      }else{
        $layanan->foto='layanan.jpg';
        $layanan->save();
      }

      Alert::success('Berhasil!','Data Berhasil Ditambahkan');
      return redirect('data/layanan');
    }   
    
    public function detail($id)
    {
      $layanan = Layanan::find($id);
      return view('data.layanan_detail',compact('layanan'));
    }
    
    public function edit($id)
    {
    $data = Layanan::findOrFail($id);
    return view('data.layanan_edit',compact('data'));
    //print_r($data);
    }

    public function update(Request $request,$id)
    {
      $this->validate($request, [
      'nama' => 'required|unique:layanan,nama,'.$request->id,
      'deskripsi' => 'required',
      'harga' => 'required|regex:/^[0-9]+$/',
      ],
      [
        'nama.required' => 'Nama tidak boleh kosong!',
        // 'nama.unique' => 'Nama sudah tersedia!',
        'deskripsi.required' => 'Deskripsi tidak boleh kosong!',
        'harga.required' => 'Harga tidak boleh kosong!',
        'harga.regex' => 'Format harga tidak valid!',
      ]);
      $data = Layanan::find($id);
      $data->nama=$request->get('nama');
      $data->deskripsi=$request->get('deskripsi');
      $data->harga=$request->get('harga');
      $data->save();
      Alert::success('Berhasil!','Data Berhasil Diubah');
      return redirect('data/layanan');   
    }

    public function edit_foto($id)
    {
    $data = Layanan::findOrFail($id);
    return view('data.layanan_foto',compact('data'));
    }

    public function update_foto(Request $request, $id)
    {
      $this->validate($request, [
      'foto' => 'mimes:jpeg,png,jpg|max:2000',
    ],
    [
      'foto.mimes' => 'Foto hanya boleh format jpeg,png,jpg!',
    ]);
      $data= Layanan::find($id);
      if(!empty($request->foto)){
        $file = $request->file('foto');
        $extension = strtolower($file->getClientOriginalExtension());

        $filename = $data->nama . '.' . $extension;
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
      return redirect('data/layanan/'.$data->id.'/edit');  

    }

    public function destroy($id)
    {
      $data = Layanan::find($id)->delete();
      Alert::success('Berhasil!','Data Berhasil Dihapus');
      return response()->json(['success'=>"Data Deleted successfully.", 'tr'=>'tr_'.$id]);
    }

    // public function withTrashed()
    // {
    //   $data = Layanan::onlyTrashed()->get();
    // }

    // public function restore($id)
    // {
    //   Layanan::withTrashed()->where('id',$id)->restore();
    //   return "Success restore";
    // }

    // public function forceDelete($id)
    // {
    //   $data = Layanan::onlyTrashed($id)->first()->forceDelete();
    //   return "Success force delete";
    // }
}
