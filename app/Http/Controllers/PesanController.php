<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\Pesan;
use Auth;
use File;
use Alert;
use Carbon\Carbon;
use App\User;
use Notification;
use App\Notifications\EmailNotification;
use Symfony\Component\Console\Helper;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;


class PesanController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }
    public function pesan(){
      $pesan = Pesan::all()->orderBy('id','desc');
      return response()->json([
        'status'=>'successsssss',
        'result'=> $pesan ,
      ]);
    }

    public function sendNotification()
    {
        $user = User::where('level','Admin')->get();
        // dd($user);
  
        $details = [
            'greeting' => 'Hi Artisan',
            'body' => 'This is my first notification from ItSolutionStuff.com',
            'thanks' => 'Thank you for using ItSolutionStuff.com tuto!',
            'actionText' => 'View My Site',
            'actionURL' => url('/'),
            'order_id' => 'notification'
        ];
  
        Notification::send($user, new EmailNotification($details));
        return redirect('pengaturan/pesan');
    }

    public function index()
    {
        $list = Pesan::with('user')->get();
        return view('pengaturan.pesan_list',compact('list'));
    }  

    public function create()
    {
      $user = User::where('level','Psikolog')
                    ->orwhere('level','Klien')
                    ->orderBy('name')
                    ->get();
                    // dd($user);
      return view('pengaturan.pesan_add',compact('user'));
    }    

    public function store_api(Request $request)
    {
      $pesan = Pesan::create([
        'subject' => request('subject'),
        'pesan' => request('pesan'),
        ])->user()->attach($request->user_id);

      $optionBuilder = new OptionsBuilder();
      $optionBuilder->setTimeToLive(60*20);

      $notificationBuilder = new PayloadNotificationBuilder('Pesan Baru');
      $notificationBuilder->setBody('Lihat Pesan')
                  ->setSound('default');

      $dataBuilder = new PayloadDataBuilder();
      $dataBuilder->addData(['a_data' => 'my_data']);

      $option = $optionBuilder->build();
      $notification = $notificationBuilder->build();
      $data = $dataBuilder->build();
      // You must change it to get your tokens
      $user = User::find($request->user_id)->pluck('fcm_token')->toArray();
      $tokens = $user;
      // dd($tokens);

      $downstreamResponse = FCM::sendTo($tokens, $option, $notification, $data);
      
      $downstreamResponse->numberSuccess();
      $downstreamResponse->numberFailure();
      $downstreamResponse->numberModification();
      dd($downstreamResponse);
      // Alert::success('Berhasil!','Pesan telah terkirim!');
      // return redirect('pengaturan/pesan');
      return response()->json($pesan);
    }

    public function store(Request $request)
    {
      $pesan = Pesan::create([
        'subject' => request('subject'),
        'pesan' => request('pesan'),
        ])->user()->attach($request->user_id);

      $optionBuilder = new OptionsBuilder();
      $optionBuilder->setTimeToLive(60*20);

      $notificationBuilder = new PayloadNotificationBuilder($request->subject);

      $notificationBuilder->setBody($request->pesan)
                  ->setSound('default');
      $dataBuilder = new PayloadDataBuilder();
      $dataBuilder->addData([
        'subject' => request('subject'),
        'pesan' => request('pesan')
      ]);
      $data = $dataBuilder->build();

      $option = $optionBuilder->build();
      $notification = $notificationBuilder->build();
      // You must change it to get your tokens
      $user = User::find($request->user_id)->pluck('fcm_token')->toArray();
      $tokens = $user;
      // dd($tokens);

      $downstreamResponse = FCM::sendTo($tokens, $option, $notification, $data);

      $downstreamResponse->numberSuccess();
      $downstreamResponse->numberFailure();
      $downstreamResponse->numberModification();
      // dd($downstreamResponse);

      Alert::success('Berhasil!','Pesan telah terkirim!');
      return redirect('pengaturan/pesan');
    }

    public function pesanUser(Request $request){

      $list = Pesan::whereHas('user', function($data) use($request)
      {
        $data->where('user_id', $request->user_id)->orderBy('created_at', 'desc');
      })->get();
      // dd($list);

      return response()->json($list);
    }

    public function edit($id)
    {
    $data = Tes::findOrFail($id);
    return view('data.pesan_edit',compact('data'));
    //print_r($data);
    }

    public function update(Request $request,$id)
    {
      $data = Tes::find($id);
      $data->nama=$request->get('nama');
      $data->deskripsi=$request->get('deskripsi');
      $data->harga=$request->get('harga');
      $data->save();
      Alert::success('Berhasil!','Data Berhasil Diubah');
      return redirect('data/pesan');   
    }
    
    public function destroy($id)
    {
      $data = Pesan::find($id)->delete();
      Alert::success('Berhasil!','Data Berhasil Dihapus');
      return response()->json(['success'=>"Data Deleted successfully.", 'tr'=>'tr_'.$id]);
    }

    public function withTrashed()
    {
      $data = Pesan::onlyTrashed()->get();
    }

    public function restore($id)
    {
      Pesan::withTrashed()->where('id',$id)->restore();
      return "Success restore";
    }

    public function forceDelete($id)
    {
      $data = Pesan::onlyTrashed($id)->first()->forceDelete();
      return "Success force delete";
    }
}
