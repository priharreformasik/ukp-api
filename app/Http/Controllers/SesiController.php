<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\Sesi;
use Auth;
use File;
use Carbon\Carbon;
use Alert;
use App\Layanan;

class SesiController extends Controller
{

    public function sesi(){
      $sesi = Sesi::all();
      return response()->json([
        'status'=>'successsssss',
        'sesi'=> $sesi ,
      ]);
    }

    public function store_api(Request $request)
    {
      $data = new Sesi;
      $data -> nama = $request->nama;
      $data -> jam = $request->jam;
      $data-> save();
      
      return response()->json([
        'status'=>'success',
        'result'=> $sesi ,
      ]);
    }

    public function update_api(Request $request,$id)
    {
      $data = Sesi::find($id);
      $data->nama=$request->get('nama');
      $data->jam=$request->get('jam');
      $data->save();
      return response()->json([
        'status'=>'success',
        'result'=> $data ,
      ]);
    }


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
        $list = Sesi::all()->sortBy('id');
        return view('data.sesi_list',compact('list'));
    }    

    public function create()
    {
      $layanan = Layanan::all()->sortBy('id');
      return view('data.sesi_add', compact('layanan'));
    }    

    public function store(Request $request)
    {

      $this->validate($request, [
      'nama' => 'required',
      'jam1' => 'required',
      'jam2' => 'required',
      ],
      [
        'nama.required' => 'Nama tidak boleh kosong!',
        'jam1.required' => 'Jam tidak boleh kosong!',
        'jam2.required' => 'Jam tidak boleh kosong!',
      ]);

      $check = Sesi::where('jam', $request->jam1.' - '.$request->jam2)
                    ->where('nama', $request->nama)
                    ->first();
      if($check) {
        Alert::warning('Peringatan!', 'Data Sudah Tersedia!');
        return redirect('data/sesi');
      }else{
        $data = new Sesi;
        $data -> nama = $request->nama;
        $data -> jam = $request->jam1.' - '.$request->jam2;
        $data-> save();
        $data->layanan()->attach($request->layanan_id);
        Alert::success('Berhasil!','Data Berhasil Ditambahkan');
        return redirect('data/sesi');
        
      }
    }   

    public function edit($id)
    {
    $data = Sesi::findOrFail($id);
    return view('data.sesi_edit',compact('data'));
    //print_r($data);
    }

    public function update(Request $request,$id)
    {
      $this->validate($request, [
        'nama' => 'required|unique:sesi,nama,'.$request->id,
        'jam1' => 'required',
        'jam2' => 'required',
      ],
      [
        'nama.required' => 'Nama tidak boleh kosong!',
        'nama.unique' => 'Nama sudah tersedia!',
        'jam1.required' => 'Jam tidak boleh kosong!',
        'jam2.required' => 'Jam tidak boleh kosong!',
      ]);
      $data = Sesi::find($id);
      $data->nama=$request->get('nama');
      $data->jam=$request->get('jam1').' - '.$request->get('jam2');
      $data->save();
      Alert::success('Berhasil!','Data Berhasil Diubah');
      return redirect('data/sesi');   
    }
    
    public function destroy($id)
    {
      $data = Sesi::find($id)->delete();
      Alert::success('Berhasil!','Data Berhasil Dihapus');
      return response()->json(['success'=>"Data Deleted successfully.", 'tr'=>'tr_'.$id]);
    }
    // public function withTrashed()
    // {
    //   $data = Sesi::onlyTrashed()->get();
    // }

    // public function restore($id)
    // {
    //   Sesi::withTrashed()->where('id',$id)->restore();
    //   return "Success restore";
    // }

    // public function forceDelete($id)
    // {
    //   $data = Sesi::onlyTrashed($id)->first()->forceDelete();
    //   return "Success force delete";
    // }
}
