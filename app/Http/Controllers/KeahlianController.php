<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\Keahlian;
use Auth;
use File;
use Alert;
use Carbon\Carbon;

class KeahlianController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function keahlian(){
      $keahlian = Keahlian::all();
      return response()->json([
        'status'=>'success',
        'result'=> $keahlian ,
      ]);
    }

    public function store_api(Request $request)
    {
      $keahlian = Keahlian::create([
        'nama' => request('nama'),
    ]);
      return response()->json([
        'status'=>'success',
        'result'=> $keahlian ,
      ]);
    }

    public function update_api(Request $request,$id)
    {
      $data = Keahlian::find($id);
        $data->nama=$request->get('nama');
        $data->save();
      return response()->json([
        'status'=>'success',
        'result'=> $data ,
      ]);
    }


    public function index()
    {
        $list = Keahlian::all()->sortBy('id');
        return view('data.keahlian_list',compact('list'));
    }    

    public function create()
    {
      return view('data.keahlian_add');
    }

    public function store(Request $request)
    {
      $this->validate($request, [
      'nama' => 'required',
      ],
      [
        'nama.required' => 'Nama tidak boleh kosong!',
      ]);

      Keahlian::create([
        'nama' => request('nama')
      ]);
      Alert::success('Berhasil!','Data Berhasil Ditambahkan');
      return redirect('data/keahlian');
    }   
    /*
    public function detail($id)
    {
      $Keahlian = Kategori::find($id);
      return view('data.Keahlian_detail',compact('Keahlian'));
    }*/
    public function edit($id)
    {
    $data = Keahlian::findOrFail($id);
    return view('data.keahlian_edit',compact('data'));
    //print_r($data);
    }

    public function update(Request $request,$id)
    {
      $this->validate($request, [
      'nama' => 'required',
      ],
      [
        'nama.required' => 'Nama tidak boleh kosong!',
      ]);

      $data = Keahlian::find($id);
      $data->nama=$request->get('nama');
      $data->save();
      Alert::success('Berhasil!','Data Berhasil Diubah');
      return redirect('data/keahlian');   
    }

    
    public function destroy($id)
    {
      $data = Keahlian::find($id)->delete();
      Alert::success('Berhasil!','Data Berhasil Dihapus');
      return response()->json(['success'=>"Data Deleted successfully.", 'tr'=>'tr_'.$id]);
    }

    public function withTrashed()
    {
      $data = Keahlian::onlyTrashed()->get();
    }

    public function restore($id)
    {
      Keahlian::withTrashed()->where('id',$id)->restore();
      return "Success restore";
    }

    public function forceDelete($id)
    {
      $data = Keahlian::onlyTrashed($id)->first()->forceDelete();
      return "Success force delete";
    }
}
