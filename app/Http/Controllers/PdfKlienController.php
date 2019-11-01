<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use PDF;
use App\Klien;
use App\User;

class PdfKlienController extends Controller
{
	function index(){
    	$list = User::all()->where('level','Klien');
    	return view('pdf/klien_pdf',compact('list'));
	}


    public function export_pdf()
	  {
	    // Fetch all customers from database
	    $data = Klien::leftjoin('users','klien.user_id','=','users.id')
	    				->select('users.id','users.name','users.jenis_kelamin','users.tanggal_lahir','users.nik','users.alamat','users.email','users.no_telepon','klien.anak_ke','klien.jumlah_saudara','klien.pendidikan_terakhir','klien.parent_id','klien.hub_pendaftar')
	    				->where('level','Klien')
	    				->get();
	    // Send data to the view using loadView function of PDF facade
	    $pdf = PDF::loadView('pdf.klien_pdf', compact('data'))->setPaper([0, 0, 595.276,935.433], 'landscape');
	    // If you want to store the generated pdf to the server then you can use the store function
	    $pdf->save(storage_path().'_filename.pdf');
	    // Finally, you can download the file using download function
	    return $pdf->download('Daftar_Klien.pdf');
	  }
}
