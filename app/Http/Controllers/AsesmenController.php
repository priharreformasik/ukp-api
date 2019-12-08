<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AsesmenCharge;
use App\Layanan;
use Alert;

class AsesmenController extends Controller
{
    public function index()
    {
        $list = AsesmenCharge::all()->sortBy('id');
        return view('data.asesmen_list',compact('list'));
    } 

    public function create()
    {
      $layanan = Layanan::all()->sortBy('id');
      $asesmen = AsesmenCharge::all()->sortBy('id');
      return view('data.asesmen_add', compact('layanan','asesmen'));
    }

    public function store(Request $request)
    {
      $this->validate($request, [
        'nama' => 'required|unique:asesmen_charge,nama',
        'deskripsi' => 'required',
        'harga' => 'required|regex:/^[0-9]+$/',
        'layanan_id' => 'required'
      ],
      [
        'nama.required' => 'Nama tidak boleh kosong!',
        'nama.unique' => 'Nama sudah tersedia!',
        'deskripsi.required' => 'Deskripsi tidak boleh kosong!',
        'harga.required' => 'Harga tidak boleh kosong!',
        'harga.regex' => 'Format harga tidak valid!',
        'layanan_id.required' => 'Layanan tidak boleh kosong!',
      ]);
      AsesmenCharge::create([
        'nama' => request('nama'),
        'deskripsi' => request('deskripsi'),
        'harga' => request('harga'),        
        'layanan_id' => request('layanan_id')
      ]);
      Alert::success('Berhasil!','Data Berhasil Ditambahkan');
      return redirect('data/asesmen');
    }  

    public function edit($id)
    {
	    $data = AsesmenCharge::findOrFail($id);
	    $layanan = Layanan::all();
	    return view('data.asesmen_edit',compact('data', 'layanan'));
    }

    public function update(Request $request,$id)
    {
      $this->validate($request, [
      'nama' => 'required|unique:asesmen_charge,nama,'.$request->id,
      'deskripsi' => 'required',
      'harga' => 'required|regex:/^[0-9]+$/',
      'layanan_id' => 'required'
      ],
      [
        'nama.required' => 'Nama tidak boleh kosong!',
        'deskripsi.required' => 'Deskripsi tidak boleh kosong!',
        'harga.required' => 'Harga tidak boleh kosong!',
        'harga.regex' => 'Format harga tidak valid!',
        'layanan_id.required' => 'Layanan tidak boleh kosong!',
      ]);
      $data = AsesmenCharge::find($id);
      $data->nama=$request->get('nama');
      $data->deskripsi=$request->get('deskripsi');
      $data->harga=$request->get('harga');
      $data->layanan_id=$request->get('layanan_id');
      $data->save();
      Alert::success('Berhasil!','Data Berhasil Diubah');
      return redirect('data/asesmen');   
    }

    public function destroy($id)
    {
      $data = AsesmenCharge::find($id)->delete();
      Alert::success('Berhasil!','Data Berhasil Dihapus');
      return response()->json(['success'=>"Data Deleted successfully.", 'tr'=>'tr_'.$id]);
    }

    public function list_asesmen(Request $request){
      $data = AsesmenCharge::all();
      return response()->json($data);
    }

    public function list_asesmen_harga(Request $request){
      $data = AsesmenCharge::find($request->id);
      return response()->json($data);
    }
}
