<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\Status;
use Auth;
use File;
use Carbon\Carbon;
use Alert;

class StatusController extends Controller
{

    public function status(){
      $status = Status::all();
      return response()->json([
        'status'=>'successsssss',
        'result'=> $status ,
      ]);
    }

    public function store_api(Request $request)
    {
      $status = Status::create([
        'nama' => request('nama'),
        'deskripsi' => request('deskripsi'),
    ]);
      return response()->json([
        'status'=>'successsssss',
        'result'=> $status ,
      ]);
    }

    public function update_api(Request $request,$id)
    {
        $data = Status::find($id);
        $data->nama=$request->get('nama');
         $data->deskripsi=$request->get('deskripsi');
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
        $list = Status::all()->sortBy('nama');
        return view('data.status_list',compact('list'));
    }    

    public function create()
    {
      return view('data.status_add');
    }    

    public function store(Request $request)
    {
      $this->validate($request, [
        'nama' => 'required|unique:status,nama',
        'deskripsi' => 'required'
      ],
      [
        'nama.required' => 'Nama tidak boleh kosong!',
        'nama.unique' => 'Nama sudah tersedia!',
        'deskripsi.required' => 'Deskripsi tidak boleh kosong!',
      ]);

      Status::create([
        'nama' => request('nama'),
        'deskripsi' => request('deskripsi')
      ]);
      Alert::success('Berhasil!','Data Berhasil Disimpan!');
      return redirect('data/status');

    }   


    
    /*public function detail($id)
    {
      $tes = Tes::find($id);
      return view('data.tes_detail',compact('tes'));
    }*/
    public function edit($id)
    {
    $data = Status::findOrFail($id);
    return view('data.status_edit',compact('data'));
    //print_r($data);
    }

    public function update(Request $request,$id)
    {
      $this->validate($request, [
        'nama' => 'required|unique:status,nama,'.$request->id,
        'deskripsi' => 'required'
      ],
      [
        'nama.required' => 'Nama tidak boleh kosong!',
        'nama.unique' => 'Nama sudah tersedia!',
        'deskripsi.required' => 'Deskripsi tidak boleh kosong!',
      ]);

      $data = Status::find($id);
      $data->nama=$request->get('nama');
      $data->deskripsi=$request->get('deskripsi');
      $data->save();
      Alert::success('Berhasil!','Data Berhasil Diubah');
      return redirect('data/status'); 
    }
    
    public function destroy($id)
    {
      $data = Status::find($id)->delete();
      Alert::success('Berhasil!','Data Berhasil Dihapus');
      // return redirect('data/status');
      return response()->json(['success'=>"Data Deleted successfully.", 'tr'=>'tr_'.$id]);
    }

    // public function withTrashed()
    // {
    //   $data = Status::onlyTrashed()->get();
    // }

    // public function restore($id)
    // {
    //   Status::withTrashed()->where('id',$id)->restore();
    //   return "Success restore";
    // }

    // public function forceDelete($id)
    // {
    //   $data = Status::onlyTrashed($id)->first()->forceDelete();
    //   return "Success force delete";
    // }
}
