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
}
