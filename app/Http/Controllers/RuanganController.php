<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\Ruangan;
use Auth;
use File;
use Alert;
use Carbon\Carbon;
use App\Layanan;

class RuanganController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function ruangan(){
      $ruangan = Ruangan::all();
      return response()->json([
        'status'=>'successsssss',
        'result'=> $ruangan ,
      ]);
    }

    public function store_api(Request $request)
    {
      $ruangan = Ruangan::create([
        'nama' => request('nama'),
    ]);
      return response()->json([
        'status'=>'successsssss',
        'result'=> $ruangan ,
      ]);
    }

    public function update_api(Request $request,$id)
    {
      $data = Ruangan::find($id);
        $data->nama=$request->get('nama');
        $data->save();
      return response()->json([
        'status'=>'successsssss',
        'result'=> $data ,
      ]);
    }

    public function index()
    {
        $list = Ruangan::all()->sortBy('id');
        return view('data.ruangan_list',compact('list'));
    }    

    public function create()
    {
      $layanan = Layanan::all()->sortBy('id');
      return view('data.ruangan_add', compact('layanan'));
    }

    public function store(Request $request)
    {
      $this->validate($request, [
        'nama' => 'required|unique:ruangan,nama',
        'deskripsi' => 'required'
      ],
      [
        'nama.required' => 'Nama tidak boleh kosong!',
        'nama.unique' => 'Nama sudah tersedia!',
        'deskripsi.required' => 'Deskripsi tidak boleh kosong!',
      ]);
      Ruangan::create([
        'nama' => request('nama'),
        'deskripsi' => request('deskripsi')
      ])->layanan()->attach($request->layanan_id);
      Alert::success('Berhasil!','Data Berhasil Ditambahkan');
      return redirect('data/ruangan');
    }   
    /*
    public function detail($id)
    {
      $layanan = Kategori::find($id);
      return view('data.ruangan_detail',compact('layanan'));
    }*/
    public function edit($id)
    {
    $data = Ruangan::findOrFail($id);
    return view('data.ruangan_edit',compact('data'));
    //print_r($data);
    }

    public function update(Request $request,$id)
    {
      $this->validate($request, [
        'nama' => 'required|unique:ruangan,nama,'.$request->id,
        'deskripsi' => 'required'
      ],
      [
        'nama.required' => 'Nama tidak boleh kosong!',
        'nama.unique' => 'Nama sudah tersedia!',
        'deskripsi.required' => 'Deskripsi tidak boleh kosong!',
      ]);
      $data = Ruangan::find($id);
      $data->nama=$request->get('nama');
      $data->deskripsi=$request->get('deskripsi');
      $data->save();
      Alert::success('Berhasil!','Data Berhasil Diubah');
      return redirect('data/ruangan');
    }

    
    // public function destroy($id)
    // {
    //   $data = Ruangan::find($id)->delete();
    //   Alert::success('Berhasil!','Data Berhasil Dihapus');
    //   return response()->json(['success'=>"Data Deleted successfully.", 'tr'=>'tr_'.$id]);
    // }

    public function destroy($id)
    {
      $data = Ruangan::find($id);
      $ruangan = Jadwal::where('ruangan_id', $data->id)->get()->count();
      if (($ruangan) > 0) {
        return response()->json([
          'status'=>'failed',
          'message'=>'Data sudah digunakan pada tabel lain!'
        ]);
      } else {
        $data->delete();
        return response()->json($data);
      }
    }

    // public function withTrashed()
    // {
    //   $data = Ruangan::onlyTrashed()->get();
    // }

    // public function restore($id)
    // {
    //   Ruangan::withTrashed()->where('id',$id)->restore();
    //   return "Success restore";
    // }

    // public function forceDelete($id)
    // {
    //   $data = Ruangan::onlyTrashed($id)->first()->forceDelete();
    //   return "Success force delete";
    // }
}

