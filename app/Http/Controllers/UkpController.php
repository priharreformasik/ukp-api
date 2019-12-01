<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Models\Province;
// use App\Models\Regency;
// use App\Models\District;
use App\Ukp;

class UkpController extends Controller
{
    public function list(Request $request)
    {
        // $ukp = Ukp::orWhere('kecamatan_id',$request->kecamatan_id)->where('kabupaten_id',$request->kabupaten_id)->get();
        $a = $request->kabupaten_id;
        $b = $request->kecamatan_id;
        $ukp = Ukp::where(function ($query) use ($a,$b) 
        {
            if ($b == null) {
                $query->where('kabupaten_id', $a);
            } else {
                $query->where('kabupaten_id', $a)
                      ->where('kecamatan_id', $b);
            }    
        })->get();

        return response()->json([
            'status'=> 'success',
            'data'=> $ukp
        ]);

    }
}
