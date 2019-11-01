<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\Kategori;
use Auth;
use File;
use Alert;
use Carbon\Carbon;

class KategoriController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function kategori(){
      $kategori = Kategori::all();
      return response()->json([
        'status'=>'success',
        'result'=> $kategori ,
      ]);
    }

    public function store_api(Request $request)
    {
      $kategori = Kategori::create([
        'nama' => request('nama'),
    ]);
      return response()->json([
        'status'=>'success',
        'result'=> $kategori ,
      ]);
    }

    public function update_api(Request $request,$id)
    {
      $data = Kategori::find($id);
        $data->nama=$request->get('nama');
        $data->save();
      return response()->json([
        'status'=>'success',
        'result'=> $data ,
      ]);
    }

    public function index()
    {
        $list = Kategori::all()->sortBy('id');
        return view('data.kategori_list',compact('list'));
    }    

    public function create()
    {
      return view('data.kategori_add');
    }

    public function store(Request $request)
    {
      $this->validate($request, [
        'nama' => 'required|unique:kategori_klien,nama',
        'deskripsi' => 'required'
      ],
      [
        'nama.required' => 'Nama tidak boleh kosong!',
        'nama.unique' => 'Nama sudah tersedia!',
        'deskripsi.required' => 'Deskripsi tidak boleh kosong!',
      ]);
      Kategori::create([
        'nama' => request('nama'),
        'deskripsi' => request('deskripsi')
      ]);
      Alert::success('Berhasil!','Data Berhasil Ditambahkan');
      return redirect('data/kategori');
    }   
    /*
    public function detail($id)
    {
      $layanan = Kategori::find($id);
      return view('data.layanan_detail',compact('layanan'));
    }*/
    public function edit($id)
    {
    $data = Kategori::findOrFail($id);
    return view('data.kategori_edit',compact('data'));
    //print_r($data);
    }

    public function update(Request $request,$id)
    {
      $this->validate($request, [
        'nama' => 'required|unique:kategori_klien,nama,'.$request->id,
        'deskripsi' => 'required'
      ],
      [
        'nama.required' => 'Nama tidak boleh kosong!',
        'nama.unique' => 'Nama sudah tersedia!',
        'deskripsi.required' => 'Deskripsi tidak boleh kosong!',
      ]);

      $data = Kategori::find($id);
      $data->nama=$request->get('nama');
      $data->deskripsi=$request->get('deskripsi');
      $data->save();
      Alert::success('Berhasil!','Data Berhasil Diubah');
      return redirect('data/kategori');
    }

    
    public function destroy($id)
    {
      $data = Kategori::find($id)->delete();
      Alert::success('Berhasil!','Data Berhasil Dihapus');
      return response()->json(['success'=>"Data Deleted successfully.", 'tr'=>'tr_'.$id]);
    }

    // public function withTrashed()
    // {
    //   $data = Kategori::onlyTrashed()->get();
    // }

    // public function restore($id)
    // {
    //   Kategori::withTrashed()->where('id',$id)->restore();
    //   return "Success restore";
    // }

    // public function forceDelete($id)
    // {
    //   $data = Kategori::onlyTrashed($id)->first()->forceDelete();
    //   return "Success force delete";
    // }
}
