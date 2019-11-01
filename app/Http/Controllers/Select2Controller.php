<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;

class Select2Controller extends Controller
{
    public function index()
    {
        return view('pengaturan/autocomplete');
    }

    public function loadData(Request $request)
    {
        $search = $request->get('term');
      
          $result = User::where('name', 'LIKE', '%'. $search. '%')->get();
 
          return response()->json($result);
            
        // if ($request->has('q')) {
        //     $cari = $request->q;
        //     $data = DB::table('users')->select('id', 'email')->where('email', 'LIKE', '%$cari%')->get();
        //     return response()->json($data);
        // }
    }
}