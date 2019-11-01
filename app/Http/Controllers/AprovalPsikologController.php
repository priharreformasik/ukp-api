<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Psikolog;
use Alert;

class AprovalPsikologController extends Controller
{
    public function index()
    {
        $list = User::all()
        			->where('level','Psikolog')
        			->where('status','Not Approved')
        			->sortBy('name');
        $counter = 1;
        return view('pengaturan.psikolog_aproval_list', compact('list', 'counter'));
        //dd($list);
    } 

    public function show($id)
    {
      $user = User::where('id', $id)
                    ->with('psikolog.layanan')
                    ->first();
                    // dd($user);
      return view('pengaturan.psikolog_aproval_detail', compact('user'));
    }

    public function status(Request $request, $id)
    {
        $psikolog = User::find($id);
        if($psikolog['status']=='Approved'){
          $psikolog->status = 'Not Approved';
        }
        else{
          $psikolog->status = 'Approved';
          $psikolog->isActive = 'Aktif';
        }
        $psikolog->save();

        Alert::success('Berhasil!','Status Psikolog Telah Aktif');
        return redirect('pengaturan/aproval/psikolog/'.$psikolog->id.'/detail');
    }

    public function destroy($id)
    {
      $psikolog_id = Psikolog::where('user_id',$id)->delete();
      $data = User::find($id)->delete();
      Alert::success('Berhasil!','Data Berhasil Dihapus');
      return response()->json(['success'=>"Data Deleted successfully.", 'tr'=>'tr_'.$id]);
    }

    public function withTrashed()
    {
      $data = User::onlyTrashed()->get();
    }

    public function restore($id)
    {
      User::withTrashed()->where('id',$id)->restore();
      return "Success restore";
    }

    public function forceDelete($id)
    {
      $data = User::onlyTrashed($id)->first()->forceDelete();
      return "Success force delete";
    }
}
