<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\Jadwal;
use App\Klien;
use App\Layanan;
use App\Tes;
use App\Ruangan;
use App\Psikolog;
use App\Sesi;
use App\Status;
use App\User;
use Auth;
use File;
use Alert;
use Carbon\Carbon;
use DB;
use Symfony\Component\Console\Helper;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;

class AprovalController extends Controller
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

    public function jadwal(){
      $jadwal = Jadwal::all();
      $jadwal = Jadwal::with('sesi')->get();
      return response()->json([
        'status'=>'successsssss',
        'result'=> $jadwal ,
      ]);
    }

    public function index()
    {
        $list= Jadwal::leftjoin('status','jadwal.status_id','=','status.id')
                      ->select('jadwal.tanggal', 'jadwal.id','jadwal.sesi_id','jadwal.klien_id','jadwal.ruangan_id','jadwal.psikolog_id', 'status.nama','jadwal.keluhan','jadwal.layanan_id','jadwal.created_at')
                      ->Where('status.nama','=','Pengalihan Psikolog')
                      ->orWhere('status.nama','=','Menunggu Konfirmasi')
                      ->orWhere('status.nama','=','Konfirmasi')
                      ->orderBy('jadwal.created_at','desc')
                      ->orderBy('tanggal','desc')
                      ->get();

        $counter = 1;
        return view('pengaturan.aproval_list',compact('list','counter'));
    }    
 
    
    public function show($id)
    {
      $jadwal = Jadwal::find($id);
                        // dd($jadwal);
      return view('pengaturan.aproval_detail',compact('jadwal'));
    }
    public function edit($id)
    {
      $data = Jadwal::find($id);
      $sesi = Sesi::all();
      $klien = Klien::all();
      $layanan = Layanan::all();
      $ruangan = Ruangan::all();
      $psikolog = Psikolog::all();
      $status = Status::where('nama','Terjadwal')->orWhere('nama','Dibatalkan')->orWhere('nama','Pengalihan Psikolog')->get();

      return view('pengaturan.aproval_edit',compact('data','sesi','klien','layanan','ruangan','psikolog','status'));
    }

    public function update(Request $request,$id)
    {
      $check = Jadwal::where('tanggal', $request->tanggal)
                       ->where('psikolog_id', $request->psikolog_id)
                       ->where('sesi_id', $request->sesi_id)
                       ->where('ruangan_id', $request->ruangan_id)
                       ->where('status_id', $request->status_id)
                       ->where('jadwal.id','!=',$request->id)
                       ->first();

      $check1 = Jadwal::where('tanggal', $request->tanggal)
                       ->where('psikolog_id', $request->psikolog_id)
                       ->where('sesi_id', $request->sesi_id)
                       ->where('status_id', $request->status_id)
                       ->where('jadwal.id','!=',$request->id)
                       ->first();

      $check2 = Jadwal::where('tanggal', $request->tanggal)
                       ->where('sesi_id', $request->sesi_id)
                       ->where('ruangan_id', $request->ruangan_id)
                       ->where('status_id', $request->status_id)
                       ->where('jadwal.id','!=',$request->id)
                       ->first();

      // // dd($query1, $request);
      // // dd($check);
      if($check) {
        Alert::warning('Peringatan!', 'Data Sudah Tersedia!');
        return redirect()->back();
      } else if ($check1) {
        Alert::warning('Peringatan!', 'Psikolog dan sesi tidak tersedia!');
        return redirect()->back();
      } else if ($check2) {
        Alert::warning('Peringatan!', 'Ruangan dan sesi tidak tersedia!');
        return redirect()->back();
      } else {
      $this->validate($request, [
      'tanggal' => 'required|date',
      'keluhan' => 'required',
      'layanan_id' => 'required',
      'status_id' => 'required',
      'psikolog_id' => 'required',
      'ruangan_id' => 'required'
    ],
    [
      'tanggal.required' => 'Tanggal tidak boleh kosong!',
      'keluhan.required' => 'Keluhan tidak boleh kosong!',
      'layanan_id.required' => 'Layanan tidak boleh kosong!',
      'status_id.required' => 'Status tidak boleh kosong!',      
      'psikolog_id.required' => 'Psikolog tidak boleh kosong!',
      'ruangan_id.required' => 'Ruangan tidak boleh kosong!'
    ]);

      $data = Jadwal::find($id);
      $data->tanggal=$request->tanggal;
      $data->sesi_id=$request->get('sesi_id');
      $data->klien_id = $request->get('klien_id');
      $data->keluhan=$request->get('keluhan');
      $data->layanan_id=$request->get('layanan_id');
      $data->ruangan_id=$request->get('ruangan_id');
      $data->psikolog_id = $request->get('psikolog_id');
      $data->status_id = $request->get('status_id');
      $data->save();

      if($request->status_id == 7){

      $optionBuilder = new OptionsBuilder();
      $optionBuilder->setTimeToLive(60*20);

      $notificationBuilder = new PayloadNotificationBuilder('Konsultasi Telah Terjadwal');
      $notificationBuilder->setBody('Silahkan cek jadwal konsultasi')
                  ->setSound('default');

      $option = $optionBuilder->build();
      $notification = $notificationBuilder->build();

      // You must change it to get your tokens
      $psikolog =  Psikolog::find($request->psikolog_id)->user->fcm_token;
      $klien = Klien::find($request->klien_id)->user->fcm_token;
      $tokens = array($psikolog, $klien);

      $downstreamResponse = FCM::sendTo($tokens, $option, $notification);
      
      }

      Alert::success('Berhasil!','Data Berhasil Diubah');
      return redirect('pengaturan/aproval/'.$data->id.'/detail');
      }
    }


    public function layananPsikolog(Request $request){

      $list = User::where('isActive', 'Aktif')->whereHas('psikolog', function ($psikolog) use ($request) 
      {
        $psikolog->whereHas('layanan', function ($layanan) use ($request)
        {
          $layanan->where('layanan_id', $request->layanan_id);
        });
      })->with('psikolog')->orderBy('name', 'asc')->get();

      return response()->json($list);
    }
    
    public function destroy($id)
    {
      $data = Jadwal::find($id)->delete();  
      Alert::success('Berhasil!','Data Berhasil Dihapus');
      return response()->json(['success'=>"Data Deleted successfully.", 'tr'=>'tr_'.$id]);
    }

    // public function withTrashed()
    // {
    //   $data = Jadwal::onlyTrashed()->get();
    // }

    // public function restore($id)
    // {
    //   Jadwal::withTrashed()->where('id',$id)->restore();
    //   return "Success restore";
    // }

    // public function forceDelete($id)
    // {
    //   $data = Jadwal::onlyTrashed($id)->first()->forceDelete();
    //   return "Success force delete";
    // }
}
