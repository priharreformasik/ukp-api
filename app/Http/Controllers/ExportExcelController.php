<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ExportExcelController extends Controller
{
    function index()
    {
    	$psikolog_data = DB:table('psikolog')->get();
    }
}
