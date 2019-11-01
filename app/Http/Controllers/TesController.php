<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\Tes;
use Auth;
use File;
use Alert;
use Carbon\Carbon;

class TesController extends Controller
{

    public function tes(){
      $tes = Tes::all();
      return response()->json([
        'status'=>'successsssss',
        'result'=> $tes ,
      ]);
    }

    public function store_api(Request $request)
    {
      $tes = Tes::create([
        'nama' => request('nama'),
        'deskripsi' => request('deskripsi'),
        'harga' => request('harga'),
    ]);
      return response()->json([
        'status'=>'successsssss',
        'result'=> $tes ,
      ]);
    }

    public function update_tes(Request $request,$id)
    {
      $data = Tes::find($id);
      $data->nama=$request->get('nama');
        $data->deskripsi=$request->get('deskripsi');
        $data->harga=$request->get('harga');
        $data->save();
      return response()->json([
        'status'=>'successsssss',
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
        $list = Tes::all()->sortBy('id');
        return view('data.tes_list',compact('list'));
    }    

    public function create()
    {
      return view('data.tes_add');
    }    

    public function store(Request $request)
    {
      $this->validate($request, [
      'nama' => 'required',
      'deskripsi' => 'required',
      'harga' => 'required'
      ],
      [
        'nama.required' => 'Nama tidak boleh kosong!',
        'deskripsi.required' => 'Deskripsi tidak boleh kosong!',
        'harga.required' => 'Harga tidak boleh kosong!',
      ]);

      Tes::create([
        'nama' => request('nama'),
        'deskripsi' => request('deskripsi'),
        'harga' => request('harga')
      ]);
      Alert::success('Berhasil!','Data Berhasil Ditambahkan');
      return redirect('data/tes');
    }   


    
    /*public function detail($id)
    {
      $tes = Tes::find($id);
      return view('data.tes_detail',compact('tes'));
    }*/
    public function edit($id)
    {
    $data = Tes::findOrFail($id);
    return view('data.tes_edit',compact('data'));
    //print_r($data);
    }

    public function update(Request $request,$id)
    {
      $this->validate($request, [
      'nama' => 'required',
      'deskripsi' => 'required',
      'harga' => 'required'
      ],
      [
        'nama.required' => 'Nama tidak boleh kosong!',
        'deskripsi.required' => 'Deskripsi tidak boleh kosong!',
        'harga.required' => 'Harga tidak boleh kosong!',
      ]);
      $data = Tes::find($id);
      $data->nama=$request->get('nama');
      $data->deskripsi=$request->get('deskripsi');
      $data->harga=$request->get('harga');
      $data->save();
      Alert::success('Berhasil!','Data Berhasil Diubah');
      return redirect('data/tes');    
    }
    
    public function destroy($id)
    {
      $data = Tes::find($id)->delete();
      Alert::success('Berhasil!','Data Berhasil Dihapus');
      return response()->json(['success'=>"Data Deleted successfully.", 'tr'=>'tr_'.$id]);
    }

    public function withTrashed()
    {
      $data = Tes::onlyTrashed()->get();
    }

    public function restore($id)
    {
      Tes::withTrashed()->where('id',$id)->restore();
      return "Success restore";
    }

    public function forceDelete($id)
    {
      $data = Tes::onlyTrashed($id)->first()->forceDelete();
      return "Success force delete";
    }
}
