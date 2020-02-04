<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\Jadwal;
use App\Klien;
use App\Layanan;
use App\Ruangan;
use App\Psikolog;
use App\Sesi;
use App\Status;
use App\User;
use App\Transaksi;
use Auth;
use File;
use Alert;
use Carbon\Carbon;
use Symfony\Component\Console\Helper;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;
use DB;

class JadwalController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     // $this->middleware('auth');
    // }

    public function jadwal(){
      $jadwal = Jadwal::all();
      $jadwal = Jadwal::with('sesi','layanan','klien','psikolog','ruangan','status','tes')->get();
      
      return response()->json([
        'status'=>'successsssss',
        'result'=> $jadwal ,
      ]);
    }

    public function store_api(Request $request){

      $ruangan = [];
      $status_terjadwal = Status::where('nama','Terjadwal')->first()->id;
      $status_menunggu = Status::where('nama','Menunggu Konfirmasi')->first()->id;
      $id = [$status_terjadwal,$status_menunggu];

      $ruangan_layanan = Jadwal::select('ruangan_id')->where('layanan_id',$request->layanan_id)->where('tanggal',$request->tanggal)->where('sesi_id',$request->sesi_id)->get();
      
      foreach ($ruangan_layanan as $key => $value) {
        $ruangan[] = $value->ruangan_id;
      }

      $list = Ruangan::whereHas('layanan', function ($layanan) use ($request,$ruangan) 
      {
        $layanan->where('layanan_id', $request->layanan_id)
                ->whereNotIn('ruangan_id',$ruangan);
      })->get();

      if ($list->isEmpty()) {
          return response()->json([
            'status'=>'success',
            'result'=>'Jadwal tidak tersedia'
          ]);
      } else {
      $jadwal = Jadwal::create([
              'tanggal' =>$request->tanggal,
              'sesi_id' => request('sesi_id'),
              'keluhan' => request('keluhan'),
              'layanan_id' => request('layanan_id'),
              'ruangan_id' => $list[0]->id,
              'psikolog_id' => request('psikolog_id'),
              'status_id' => 6,
              'status_id' => $status_menunggu,
              'klien_id' => request('klien_id'),
              ]);

              $optionBuilder = new OptionsBuilder();
                 $optionBuilder->setTimeToLive(60*20);

                 $notificationBuilder = new PayloadNotificationBuilder('Permintaan Konsultasi Baru');
                 $notificationBuilder->setBody('Silahkan Melakukan Konfirmasi')
                             ->setSound('default');

                 $dataBuilder = new PayloadDataBuilder();
                 $dataBuilder->addData(['a_data' => 'my_data']);

                 $option = $optionBuilder->build();
                 $notification = $notificationBuilder->build();
                 $data = $dataBuilder->build();
                 // You must change it to get your tokens
                 $psikolog = Psikolog::find($request->psikolog_id);
                 $tokens = [$psikolog->user->fcm_token];

                 $downstreamResponse = FCM::sendTo($tokens, $option, $notification, $data);

                 $downstreamResponse->numberSuccess();
                 $downstreamResponse->numberFailure();
                 $downstreamResponse->numberModification();
              return response()->json([
                'status'=>'success',
                'result'=>$jadwal
        ]);
      }
    }

    public function update_api(Request $request, $id){
      
      $data = Jadwal::find($id);
      $data->tanggal=$request->get('tanggal');
      $data->sesi_id=$request->get('sesi_id');
      $data->klien_id = $request->get('klien_id');
      $data->keluhan=$request->get('keluhan');
      $data->layanan_id=$request->get('layanan_id');
      // $data->ruangan_id=$request->get('ruangan_id');
      $data->psikolog_id = $request->get('psikolog_id');
      $data->status_id = $request->get('status_id');
      $data->save();

      $optionBuilder = new OptionsBuilder();
      $optionBuilder->setTimeToLive(60*20);

      if($request->status_id == 5){
        $notificationBuilder = new PayloadNotificationBuilder('Pengalihan Psikolog');
        $notificationBuilder->setBody('Psikolog akan dialihkan')
                  ->setSound('default');
      }else if($request->status_id == 7){
        $notificationBuilder = new PayloadNotificationBuilder('Konsultasi Telah Terjadwal');
        $notificationBuilder->setBody('Silahkan cek detail jadwal')
                  ->setSound('default');
      }

      $option = $optionBuilder->build();
      $notification = $notificationBuilder->build();
      // You must change it to get your tokens
      $tokens=null;
      if($request->status_id == 5){
        $psikolog = User::where('level','Psikolog')->pluck('fcm_token')->toArray();
        $klien = Klien::find($request->klien_id)->user->fcm_token;
        array_push($psikolog, $klien);
        $tokens = $psikolog;//karena $klien udh di push di $psikolog
      }else if($request->status_id == 7){
        $psikolog = Psikolog::find($request->psikolog_id);
        $tokens = [$psikolog->user->fcm_token];
      }      
      $downstreamResponse = FCM::sendTo($tokens, $option, $notification);
  
      return response()->json([
        'status'=>'success',
        'result'=>$data
      ]); 
    }

    public function updateJadwal_psikolog(Request $request, $id){
        $data = Jadwal::find($id);
        $data->psikolog_id = $request->get('psikolog_id');
        $data->status_id = $request->get('status_id');
        $data->save();
        return response()->json([
                  'status'=>'success',
                  'jadwal'=>$data
          ]);
      }

     public function updateJadwal_psikolog5(Request $request, $id){
        $data = Jadwal::find($id);
        $data->psikolog_id = $request->get('psikolog_id');
        $data->status_id = $request->get('status_id');
        $data->save();
                
                 $optionBuilder = new OptionsBuilder();
        
        
                $optionBuilder->setTimeToLive(60*20);

                $notificationBuilder = new PayloadNotificationBuilder('Konsultasi Baru');
                $notificationBuilder->setBody('Terdapat Konsultasi Baru, Segera Konfirmasi')
                         ->setSound('default');

                 $dataBuilder = new PayloadDataBuilder();
                 $dataBuilder->addData(['a_data' => 'my_data']);

                 $option = $optionBuilder->build();
                 $notification = $notificationBuilder->build();
                 $datas = $dataBuilder->build();
                // You must change it to get your tokens
                //$psikolog = Psikolog::find($request->psikolog_id);
                 //$tokens = [$psikolog->user->fcm_token];
                 
                 $psikolog = User::where('level','Psikolog')->pluck('fcm_token')->toArray();
                 $tokens =$psikolog;

                 $downstreamResponse = FCM::sendTo($tokens, $option, $notification, $datas);

                 $downstreamResponse->numberSuccess();
                 $downstreamResponse->numberFailure();
                 $downstreamResponse->numberModification();
                 
                 return response()->json([
                  'status'=>'success',
                  'jadwal'=>$data,
          ]);
      }

   
       public function updateJadwal_psikolog7(Request $request, $id){
        $data = Jadwal::find($id);
        $data->psikolog_id = $request->get('psikolog_id');
        $data->klien_id = $request->get('klien_id');
        $data->status_id = $request->get('status_id');
        $data->save();
         
       
           $optionBuilder = new OptionsBuilder();
                 $optionBuilder->setTimeToLive(60*20);

                 $notificationBuilder = new PayloadNotificationBuilder('Jadwal Konsultasi Telah Terjadwal');
                 $notificationBuilder->setBody('Silahkan cek jadwal konsultasi')
                           ->setSound('default');

                 $dataBuilder = new PayloadDataBuilder();
                 $dataBuilder->addData(['a_data' => 'my_data']);

                 $option = $optionBuilder->build();
                 $notification = $notificationBuilder->build();
                 $datas = $dataBuilder->build();
               // You must change it to get your tokens
                 $psikolog =  Psikolog::find($request->psikolog_id)->user->fcm_token;
                 $klien = Klien::find($request->klien_id)->user->fcm_token;
                 $tokens = array($psikolog, $klien);
               
                 $downstreamResponse = FCM::sendTo($tokens, $option, $notification, $datas);

                 $downstreamResponse->numberSuccess();
                 $downstreamResponse->numberFailure();
                 $downstreamResponse->numberModification();
                
                  return response()->json([
                  'status'=>'success',
                  'jadwal'=>$data
          ]);
          
      }
       public function updateJadwal_psikolog10(Request $request, $id){
        $data = Jadwal::find($id);
        $data->psikolog_id = $request->get('psikolog_id');
        $data->klien_id = $request->get('klien_id');
        $data->status_id = $request->get('status_id');
        $data->save();
          
       
                $optionBuilder = new OptionsBuilder();
                 $optionBuilder->setTimeToLive(60*20);

                $notificationBuilder = new PayloadNotificationBuilder('Konsultasi Telah Selesai');
                $notificationBuilder->setBody('Terima Kasih Telah Atas Kepercayaan Anda')
                         ->setSound('default');

                 $dataBuilder = new PayloadDataBuilder();
                 $dataBuilder->addData(['a_data' => 'my_data']);

                 $option = $optionBuilder->build();
                 $notification = $notificationBuilder->build();
                 $datas = $dataBuilder->build();
               // You must change it to get your tokens
                 $psikolog =  Psikolog::find($request->psikolog_id)->user->fcm_token;
                 $klien = Klien::find($request->klien_id)->user->fcm_token;
                 $tokens = array($psikolog, $klien);
               
                 $downstreamResponse = FCM::sendTo($tokens, $option, $notification, $datas);

                 $downstreamResponse->numberSuccess();
                 $downstreamResponse->numberFailure();
                 $downstreamResponse->numberModification();
                 
                  
                 
                  return response()->json([
                  'status'=>'success',
                  'jadwal'=>$data
          ]);
      }
       public function updateJadwal_psikolog12(Request $request, $id){
        $data = Jadwal::find($id);
        $data->psikolog_id = $request->get('psikolog_id');
        $data->klien_id = $request->get('klien_id');
        $data->status_id = $request->get('status_id');
        $data->save();
        
        
                $optionBuilder = new OptionsBuilder();
                $optionBuilder->setTimeToLive(60*20);

                $notificationBuilder = new PayloadNotificationBuilder('Konsultasi Tidak Dikonfirmasi Psikolog');
                $notificationBuilder->setBody('Konfirmasi Pengalihan Psikolog')
                         ->setSound('default');


                 $dataBuilder = new PayloadDataBuilder();
                 $dataBuilder->addData(['a_data' => 'my_data']);

                 $option = $optionBuilder->build();
                 $notification = $notificationBuilder->build();
                 $datas = $dataBuilder->build();
               // You must change it to get your tokens
                $klien = Klien::find($request->klien_id);
                 $tokens = [$klien->user->fcm_token];
               
                 $downstreamResponse = FCM::sendTo($tokens, $option, $notification, $datas);

                 $downstreamResponse->numberSuccess();
                 $downstreamResponse->numberFailure();
                 $downstreamResponse->numberModification();
                 
                return response()->json([
                  'status'=>'success',
                  'jadwal'=>$data
                ]);
          
      }
    public function updateJadwal_psikolog13(Request $request, $id){
        $data = Jadwal::find($id);
        $data->psikolog_id = $request->get('psikolog_id');
        $data->klien_id = $request->get('klien_id');
        $data->status_id = $request->get('status_id');
        $data->save();
          
                  $optionBuilder = new OptionsBuilder();
                 $optionBuilder->setTimeToLive(60*20);

                 $notificationBuilder = new PayloadNotificationBuilder('Konsultasi Baru');
                 $notificationBuilder->setBody('Jadwal telah dibatalkan oleh klien')
                         ->setSound('default');


                 $dataBuilder = new PayloadDataBuilder();
                 $dataBuilder->addData(['a_data' => 'my_data']);

                 $option = $optionBuilder->build();
                 $notification = $notificationBuilder->build();
                 $datas = $dataBuilder->build();
               // You must change it to get your tokens
                // $psikolog =  Psikolog::find($request->psikolog_id)->user->fcm_token;
                 $klien = Klien::find($request->klien_id)->user->fcm_token;
                 $tokens =  $klien;
               
                 $downstreamResponse = FCM::sendTo($tokens, $option, $notification, $datas);

                 $downstreamResponse->numberSuccess();
                 $downstreamResponse->numberFailure();
                 $downstreamResponse->numberModification(); 
                 
                 return response()->json([
                  'status'=>'success',
                  'jadwal'=>$data
          ]);
      }




    public function show_klien($id){
      //$jadwal = Jadwal::where('id',$id)->with('klien')->first();
      $jadwal = Status::where('id',$id)
                      ->with('jadwal.status','jadwal.layanan', 'jadwal.klien.user','jadwal.sesi', 'jadwal.ruangan')
                      ->first();
      if (! $jadwal) {
          return response()->json([
             'message' => 'Konsultasi not found'
          ]);
      }
       return $jadwal;
    }

    public function index(Request $request)
    {
      if($request->status == 'all' || !($request->status)){
        $list= Jadwal::leftjoin('status','jadwal.status_id','=','status.id')
                      ->select('jadwal.tanggal_asesmen', 'jadwal.tanggal_konsultasi','jadwal.id','jadwal.sesi_id','jadwal.klien_id','jadwal.ruangan_id','jadwal.psikolog_id', 'status.nama','jadwal.layanan_id','jadwal.keluhan')
                      ->Where('status.nama','=','Selesai')
                      ->orWhere('status.nama','=','Terjadwal')
                      ->orWhere('status.nama','=','Dibatalkan')
                      ->orderBy('status.nama','=','Terjadwal')
                      ->orderBy('tanggal_asesmen','desc')
                      ->get();
        }else{
          $list= Jadwal::leftjoin('status','jadwal.status_id','=','status.id')
                      ->select('jadwal.tanggal_asesmen', 'jadwal.tanggal_konsultasi', 'jadwal.id','jadwal.sesi_id','jadwal.klien_id','jadwal.ruangan_id','jadwal.psikolog_id', 'status.nama','jadwal.layanan_id','jadwal.keluhan')
                      ->Where('status.nama',$request->status)
                      ->orderBy('tanggal_asesmen','desc')
                      ->get();
        }

        // dd($list);
        $counter = 1;
        return view('jadwal.jadwal_list',compact('list','counter'));
    }    

    public function create(Request $request)
    {
      $sesi = Sesi::all()->sortBy('id');
      $klien = Klien::all();
      // $klien = User::all()->where('level','Klien')->sortBy('name');
      $layanan = Layanan::all()->sortBy('id');
      // $tes = Tes::all()->sortBy('id');
      $ruangan = Ruangan::all()->sortBy('id')->sortBy('name');
      $psikolog = Psikolog::with('layanan')->get();
      // dd(@count($psikolog));
      // $arr_layanan = [];
      // foreach ($psikolog as $key => $val) {
      //   $arr_layanan[$key] = "";
      // }
      // foreach ($psikolog as $key => $val) {
      //   foreach ($val->layanan as $key2 => $lynan) {
      //     $arr_layanan[$key] = $arr_layanan[$key].$lynan->id."\\";
      //   }
      // }
      // $x = 0;
      // dd($arr_layanan);
      // $psikolog = User::all()->where('level','Psikolog')->sortBy('name');
      $status = Status::where('nama','Terjadwal')->orWhere('nama','Selesai')->orWhere('nama','Dibatalkan')->get();
      return view('jadwal.jadwal_add' , compact('sesi','klien','layanan', 'ruangan','psikolog','status','request'));
    }   

    

      // $list = Psikolog::whereHas('layanan', function($data) use($request)
      // {
      //   $data->where('layanan_id', $request->layanan_id)->orderBy('nama', 'asc');
      // })->whereHas('user', function($data) use($request)
      // {
      //   $data->where('isActive', 'Aktif');
      // })->with('user','layanan')->get();
    
    public function layananPsikolog(Request $request){

      $list = User::where('isActive', 'Aktif')->whereHas('psikolog', function ($psikolog) use ($request) 
      {
        $psikolog->whereHas('layanan', function ($layanan) use ($request)
        {
          $layanan->where('layanan_id', $request->layanan_id);
        });
      })->with('psikolog')->orderBy('name', 'asc')->get();

      return response()->json(
          ['psikolog'=>$list]
        );
    }
    
    public function layananPsikolog_web(Request $request){

      $list = User::where('isActive', 'Aktif')->whereHas('psikolog', function ($psikolog) use ($request) 
      {
        $psikolog->whereHas('layanan', function ($layanan) use ($request)
        {
          $layanan->where('layanan_id', $request->layanan_id);
        });
      })->with('psikolog')->orderBy('name', 'asc')->get();

      return response()->json($list);
    }

    public function layananSesi_web(Request $request){
      $sesi = [];
      $status = Status::where('nama','Terjadwal')->first()->id;
      $jadwal_layanan = Jadwal::select('sesi_id')->where('tanggal',$request->tanggal)->where('psikolog_id',$request->psikolog_id)->where('status_id',$status)->get();
      
      foreach ($jadwal_layanan as $key => $value) {
        $sesi[] = $value->sesi_id;
      }
      
      $list = Sesi::whereHas('layanan', function ($layanan) use ($request,$sesi) 
      {
        $layanan->where('layanan_id', $request->layanan_id)
                ->whereNotIn('sesi_id',$sesi);
      })->get();

      return response()->json($list);
    }

    public function layananRuangan_web(Request $request){
      $ruangan = [];
      $status = Status::where('nama','Terjadwal')->first()->id;
      $ruangan_layanan = Jadwal::select('ruangan_id')->where('layanan_id',$request->layanan_id)->where('tanggal',$request->tanggal)->where('sesi_id',$request->sesi_id)->where('status_id',$status)->get();
      
      foreach ($ruangan_layanan as $key => $value) {
        $ruangan[] = $value->ruangan_id;
      }

      $list = Ruangan::whereHas('layanan', function ($layanan) use ($request,$ruangan) 
      {
        $layanan->where('layanan_id', $request->layanan_id)
                ->whereNotIn('ruangan_id',$ruangan);
      })->get();

      return response()->json($list);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
          'tanggal' => 'required|date',
          'sesi_id' => 'required',
          'keluhan' => 'required',
          'layanan_id' => 'required',
          'ruangan_id' => 'required',
          'status_id' => 'required',
          'klien_id' => 'required',
          'psikolog_id' => 'required'
        ],
        [
          'tanggal.required' => 'Tanggal tidak boleh kosong!',
          'sesi_id.required' => 'Sesi tidak boleh kosong!',
          'keluhan.required' => 'Keluhan tidak boleh kosong!',
          'layanan_id.required' => 'Layanan tidak boleh kosong!',
          'ruangan_id.required' => 'Ruangan tidak boleh kosong!',
          'status_id.required' => 'Status tidak boleh kosong!',
          'klien_id.required' => 'Klien tidak boleh kosong!',
          'psikolog_id.required' => 'Psikolog tidak boleh kosong!',
        ]);        
              
        $data = Jadwal::create([
          'tanggal' =>$request->tanggal,
          'sesi_id' => request('sesi_id'),
          'keluhan' => request('keluhan'),
          'layanan_id' => request('layanan_id'),
          'ruangan_id' => request('ruangan_id'),
          'psikolog_id' => request('psikolog_id'),
          'status_id' => request('status_id'),
          'klien_id' => request('klien_id'),
        ]);

        $transaksi = new Transaksi;
        $transaksi->biaya_registrasi = Layanan::find($data->layanan_id)->first()->harga;
        $transaksi->jadwal_id = $data->id;
        $transaksi->save();

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
        

      Alert::success('Berhasil!','Data Berhasil Ditambahkan');
      return redirect('jadwal/'.$data->id.'/detail');

    }
 
    public function show($id)
    {
      $jadwal = Jadwal::find($id);
                        /*dd($jadwal);*/
      return view('jadwal.jadwal_detail',compact('jadwal'));
    }
    
    public function edit($id)
    {
      $data = Jadwal::find($id);
      $sesi = Sesi::all();
      $klien = Klien::all();
      $layanan = Layanan::all();
      // $tes = Tes::all();
      $ruangan = Ruangan::all();
      $psikolog = Psikolog::all();
      $status = Status::where('nama','Terjadwal')->orWhere('nama','Selesai')->orWhere('nama','Dibatalkan')->get();

      return view('jadwal.jadwal_edit',compact('data','sesi','klien','layanan','ruangan','psikolog','status'));
    //print_r($data);
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
      'sesi_id' => 'required',
      'keluhan' => 'required',
      'layanan_id' => 'required',
      'ruangan_id' => 'required',
      'status_id' => 'required',
      'klien_id' => 'required',
      'psikolog_id' => 'required'
    ],
    [
      'tanggal.required' => 'Tanggal tidak boleh kosong!',
      'sesi_id.required' => 'Sesi tidak boleh kosong!',
      'keluhan.required' => 'Keluhan tidak boleh kosong!',
      'layanan_id.required' => 'Layanan tidak boleh kosong!',
      'ruangan_id.required' => 'Ruangan tidak boleh kosong!',
      'status_id.required' => 'Status tidak boleh kosong!',
      'klien_id.required' => 'Klien tidak boleh kosong!',
      'psikolog_id.required' => 'Psikolog tidak boleh kosong!',
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
      return redirect('jadwal/'.$data->id.'/detail');
      }
      
    }

    public function getSesi(Request $request)
       {
         $klayen = Klien::where('klien.id',$request->klien_id)
                        ->leftJoin('users','users.id','klien.user_id')->first();
         $check = Jadwal::where('tanggal', $request->tanggal)
                          ->where('psikolog_id', $request->psikolog_id)
                          ->where('sesi_id', $request->sesi_id)
                          ->get()
                          ->count();

         $check1 = Jadwal::where('tanggal', $request->tanggal)
                          ->where('sesi_id', $request->sesi_id)
                          ->get()
                          ->count();

         $check2 = Jadwal::where('tanggal', $request->tanggal)
                          ->where('psikolog_id', $request->psikolog_id)
                          ->where('sesi_id', $request->sesi_id)
                          ->first();
                          // dd($check2);
         $check3 = Jadwal::where('tanggal', $request->tanggal)
                          ->where('klien_id', $request->klien_id)
                        //  ->where('status_id', $request->status_id)
                          ->first();

        $check4 = Jadwal::leftjoin('klien','jadwal.klien_id','klien.id')
                        ->leftjoin('users','users.id','klien.user_id')
                        ->where('tanggal', $request->tanggal)
                      //  ->where('status_id', $request->status_id)
                        ->where('users.nik', $klayen->nik)
                        ->first();

         if($check>6) {
           return response()->json([
             'status'  => 'failed',
             'message'=>"Pemilihan Sesi, Psikolog Tersebut Tidak Tersedia!"]);
         } else if($check1>6) {
           return response()->json([
                'status'  => 'failed',
                'message'=>"Pemilihan Sesi Tersebut Tidak Tersedia!"]);
         } else if($check2) {
           return response()->json([
                'status'  => 'failed',
                'message'=>"Pemilihan Psikolog dan Sesi Tersebut Tidak Tersedia!"]);
         } else if($check3) {
           return response()->json([
                'status'  => 'failed',
                'message'=>"Anda Telah Mendaftar Pada Hari Yang Sama!"]);
         }
         else if($check4) {
          return response()->json([
               'status'  => 'failed',
               'message'=>"Klien Tersebut Telah Mendaftar Pada Hari Yang Sama!"]);
        }
          else  {
           return response()->json([
                  'status'  => 'success',
                  'message'=>"Jadwal Tersedia"]);
         }
       }
    
    public function destroy($id)
    {
      $data = Jadwal::find($id)->delete();  
      Alert::success('Berhasil!','Data Berhasil Dihapus');
      return response()->json(['success'=>"Data Deleted successfully.", 'tr'=>'tr_'.$id]);
    }

    public function ubah_status(){
      $jadwal = Jadwal::where('jadwal.tanggal','<',Carbon::now())
                      ->where('status_id',7)
                      ->get();
                      // dd($jadwal);
      foreach ($jadwal as $key => $value) {
        $value->status_id = 10;
        $value->save();
      }
                      // dd($jadwal);

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
