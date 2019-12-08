<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaksi;

class TransaksiController extends Controller
{
    public function index(){
     	$list = Transaksi::all();
        return view('transaksi.transaksi_add',compact('list'));
    }

    public function store(Request $request){
        $data = Transaksi::where('jadwal_id',$request->klien)->first();
        $asesmen = [];

        foreach ($request->daftarAsesmen as $key => $value) {
            $asesmen[] = ['asesmen_id'=>$value];
        }

        $data->transaksi_asesmen()->createMany($asesmen);

        return view('transaksi.transaksi_add');
    }
}
