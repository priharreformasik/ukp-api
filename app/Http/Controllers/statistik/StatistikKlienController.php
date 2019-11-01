<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\Klien;
use App\Jadwal;
use App\Tes;
use App\User;
use App\Kategori;
use App\Excel\KlienExcel;
use App\Excel\KlienReport;
use Auth;
use File;
use PDF;
use Alert;
use Carbon\Carbon;
use App\Charts\ECharts;
use App\Charts\Chartjs;
use DB;

class StatistikKlienController extends Controller
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

    public function index()
    {
        $klien = User::where('level','Klien')->get()->sortBy('name');
        return view('statistik.statistik_klien_list',compact('klien'));
    }    

// dd($request->from = Carbon::parse($request->from)));
      // dd($request->until = Carbon::parse($request->until)->addDay(1)));
        // dd($request);

    public function report(Request $request){      

        $list = Jadwal::leftjoin('layanan','jadwal.layanan_id','=','layanan.id')
                        ->leftjoin('status','jadwal.status_id','=','status.id')
                        ->leftjoin('ruangan','jadwal.ruangan_id','=','ruangan.id')
                        ->leftjoin('sesi','jadwal.sesi_id','=','sesi.id')
                        ->leftjoin('klien','jadwal.klien_id','=','klien.id')
                        ->leftjoin('psikolog','jadwal.psikolog_id','=','psikolog.id')
                        ->leftjoin('users','klien.user_id','=','users.id')
                        ->where('users.id',$request->klien)
                        ->where('jadwal.tanggal','>=', $request->from = Carbon::parse($request->from))
                        ->where('jadwal.tanggal','<=', $request->until = Carbon::parse($request->until))
                        ->where(function($query){
                            $query->where('status.nama','=','Terjadwal')
                            ->orWhere('status.nama','=','Selesai');
                        })
                        ->select('jadwal.*')
                        ->with(['psikolog', 'layanan',  'status', 'ruangan', 'sesi'])
                        ->orderBy('tanggal','desc')
                        ->get();
        $klien = User::where('id',$request->klien)->first();
        // dd($psikolog);
        // dd($list);
        if($request->from > $request->until){
            Alert::error('Oops', 'Something went wrong!');
            return back()->withInput();
        }else{
            return view('statistik.klien_report',compact('klien','list', 'request'));
        }
    }      

    public function report_all(Request $request){
        $list = Jadwal::leftjoin('layanan','jadwal.layanan_id','=','layanan.id')
                        ->leftjoin('status','jadwal.status_id','=','status.id')
                        ->leftjoin('ruangan','jadwal.ruangan_id','=','ruangan.id')
                        ->leftjoin('sesi','jadwal.sesi_id','=','sesi.id')
                        ->leftjoin('klien','jadwal.klien_id','=','klien.id')
                        ->leftjoin('psikolog','jadwal.psikolog_id','=','psikolog.id')
                        ->leftjoin('users','klien.user_id','=','users.id')
                        ->where('jadwal.tanggal','>=', $request->from = Carbon::parse($request->from))
                        ->where('jadwal.tanggal','<=', $request->until = Carbon::parse($request->until))
                        ->where('status.nama','=','Selesai')                 
                        ->select('jadwal.*')       
                        ->with(['psikolog', 'klien','layanan', 'status', 'ruangan', 'sesi'])
                        ->orderBy('users.name')
                        ->orderBy('tanggal','asc')
                        ->get();

         $data = DB::table('jadwal')
            ->leftjoin('layanan','jadwal.layanan_id','=','layanan.id')
            ->leftjoin('status','jadwal.status_id','=','status.id')
            ->leftjoin('klien','jadwal.klien_id','=','klien.id')
            ->leftjoin('users','klien.user_id','=','users.id')
            ->where('jadwal.tanggal','>=', $request->from = Carbon::parse($request->from))
            ->where('jadwal.tanggal','<=', $request->until = Carbon::parse($request->until))
            ->select([
                DB::raw('count(klien_id) as count'),
                DB::raw(' users.name as tagh'),
                ])
            ->where('status.nama','=','Selesai')
            ->groupBy('jadwal.klien_id' , 'users.name')
            ->orderBy('tagh','asc')
            ->get();
            // dd($data);

        $collection=[];
        $collection2 =[];

        foreach ($data as $key => $value) {
            $collection[$key] = $value->count;
        }
        foreach ($data as $key => $value) {
            $collection2[$key] = $value->tagh;
        }

        $chart = new ECharts;
        $chart->labels($collection2);
        $chart->dataset('Klien', 'bar', $collection);
        $chart->theme('light');

        // dd($list);
        if($request->from > $request->until){
            Alert::error('Oops', 'Something went wrong!');
            return back()->withInput();
        }else{
            return view('statistik.report_all_klien',compact('klien','list', 'request','chart'));
        }
    }      

    public function export_pdf(Request $request)
      {
        // Fetch all customers from database
        $data = Jadwal::leftjoin('layanan','jadwal.layanan_id','=','layanan.id')
                        ->leftjoin('status','jadwal.status_id','=','status.id')
                        ->leftjoin('ruangan','jadwal.ruangan_id','=','ruangan.id')
                        ->leftjoin('sesi','jadwal.sesi_id','=','sesi.id')
                        ->leftjoin('klien','jadwal.klien_id','=','klien.id')
                        ->leftjoin('psikolog','jadwal.psikolog_id','=','psikolog.id')
                        ->leftjoin('users','klien.user_id','=','users.id')
                        // ->where('users.id',$request->klien)
                        ->where('jadwal.tanggal','>=', $request->from = Carbon::parse($request->from))
                        ->where('jadwal.tanggal','<=', $request->until = Carbon::parse($request->until))
                        ->where('status.nama','=','Selesai')
                        ->select('jadwal.*')  
                        ->with(['psikolog', 'klien','layanan', 'status', 'ruangan', 'sesi'])
                        ->orderBy('users.name')
                        ->orderBy('tanggal','asc')
                        ->get();
        // Send data to the view using loadView function of PDF facade
        $pdf = PDF::loadView('pdf.report_klien_pdf', compact('data','request'))->setPaper('a4', 'landscape');
        // If you want to store the generated pdf to the server then you can use the store function
        $pdf->save(storage_path().'_filename.pdf');
        // Finally, you can download the file using download function
        return $pdf->download('Rekap_klien.pdf');
      }

      public function klien_pdf(Request $request)
      {
        // Fetch all customers from database
        $data = Jadwal::leftjoin('layanan','jadwal.layanan_id','=','layanan.id')
                        ->leftjoin('status','jadwal.status_id','=','status.id')
                        ->leftjoin('ruangan','jadwal.ruangan_id','=','ruangan.id')
                        ->leftjoin('sesi','jadwal.sesi_id','=','sesi.id')
                        ->leftjoin('klien','jadwal.klien_id','=','klien.id')
                        ->leftjoin('psikolog','jadwal.psikolog_id','=','psikolog.id')
                        ->leftjoin('users','klien.user_id','=','users.id')
                        ->where('users.id',$request->klien)
                        ->where('jadwal.tanggal','>=', $request->from = Carbon::parse($request->from))
                        ->where('jadwal.tanggal','<=', $request->until = Carbon::parse($request->until))
                        ->where(function($query){
                            $query->where('status.nama','=','Terjadwal')
                            ->orWhere('status.nama','=','Selesai');
                        })
                        ->select('jadwal.*')
                        ->with(['psikolog', 'layanan',  'status', 'ruangan', 'sesi'])
                        ->orderBy('tanggal','desc')
                        ->get();
        $klien = User::where('id',$request->klien)->first();
        // Send data to the view using loadView function of PDF facade
        $pdf = PDF::loadView('pdf.report_perklien_pdf', compact('data','request','klien'))->setPaper('a4', 'landscape');
        // If you want to store the generated pdf to the server then you can use the store function
        $pdf->save(storage_path().'_filename.pdf');
        // Finally, you can download the file using download function
        return $pdf->download('Rekap_perklien.pdf');
      }

      public function export_excel(Request $request)
      {
        // Fetch all customers from database
        $data = Jadwal::leftjoin('layanan','jadwal.layanan_id','=','layanan.id')
                        ->leftjoin('status','jadwal.status_id','=','status.id')
                        ->leftjoin('ruangan','jadwal.ruangan_id','=','ruangan.id')
                        ->leftjoin('sesi','jadwal.sesi_id','=','sesi.id')
                        ->leftjoin('klien','jadwal.klien_id','=','klien.id')
                        ->leftjoin('kategori_klien','kategori_id','=','klien.kategori_id')
                        ->leftjoin('psikolog','jadwal.psikolog_id','=','psikolog.id')
                        ->leftjoin('users as a','psikolog.user_id','=','a.id')
                        ->leftjoin('users as b','klien.user_id','=','b.id')
                        // ->where('users.id',$request->klien)
                        ->where('jadwal.tanggal','>=', $request->from = Carbon::parse($request->from))
                        ->where('jadwal.tanggal','<=', $request->until = Carbon::parse($request->until))
                        ->where('status.nama','=','Selesai')
                        ->select('jadwal.tanggal as tanggal','a.name as psikolog','b.name as klien','b.jenis_kelamin as jenis_kelamin','layanan.nama as layanan','kategori_klien.nama as kategori','sesi.jam as jam')  
                        // ->with(['psikolog', 'klien','layanan', 'tes', 'status', 'ruangan', 'sesi','tes'])
                        ->orderBy('b.name')
                        ->orderBy('tanggal','asc')
                        ->get()
                        ->toArray();

        $collection = [];
        foreach($data as $i => $klien){
            $collection[$i] = [
                'klien' => $klien['klien'],
                'tanggal' => $klien['tanggal'] = Carbon::parse($klien['tanggal'])->format('j F Y'),
                'jam' =>$klien['jam'],
                'jenis_kelamin' => $klien['jenis_kelamin'],
                'kategori' => $klien['kategori'],
                'psikolog' => $klien['psikolog'],
                'layanan' => $klien['layanan']
                // 'psikolog' => $layanan['psikolog']
            ];
        }
        // dd($collection1);
        $request->until = Carbon::parse($request->until)->format('dmY');
        $request->from = Carbon::parse($request->from)->format('dmY');

        $exporter = app()->makeWith(KlienExcel::class, compact('collection'));
        return $exporter->download('report-klien-'.$request->from.'-'.$request->until.'.xlsx');
        
      }

      public function klien_excel(Request $request)
      {
        // Fetch all customers from database
        $data = Jadwal::leftjoin('layanan','jadwal.layanan_id','=','layanan.id')
                        ->leftjoin('status','jadwal.status_id','=','status.id')
                        ->leftjoin('ruangan','jadwal.ruangan_id','=','ruangan.id')
                        ->leftjoin('sesi','jadwal.sesi_id','=','sesi.id')
                        ->leftjoin('klien','jadwal.klien_id','=','klien.id')
                        ->leftjoin('psikolog','jadwal.psikolog_id','=','psikolog.id')  
                        ->leftjoin('users as a','psikolog.user_id','=','a.id')
                        ->leftjoin('users as b','klien.user_id','=','b.id')
                        ->where('b.id',$request->klien)
                        ->where('jadwal.tanggal','>=', $request->from = Carbon::parse($request->from))
                        ->where('jadwal.tanggal','<=', $request->until = Carbon::parse($request->until))
                        ->where(function($query){
                            $query->where('status.nama','=','Terjadwal')
                            ->orWhere('status.nama','=','Selesai');
                        })
                        ->select('jadwal.tanggal as tanggal','a.name as psikolog','b.name as klien','b.jenis_kelamin as jenis_kelamin','layanan.nama as layanan','sesi.jam as jam','ruangan.nama as ruangan', 'status.nama as status','jadwal.keluhan as keluhan')
                        // ->with(['psikolog', 'layanan', 'tes', 'status', 'ruangan', 'sesi','tes'])
                        ->orderBy('tanggal','desc')
                        ->get()
                        ->toArray();
                        // dd($data);
        $klien = User::where('id',$request->klien)->first();
        
        $collection = [];
        foreach($data as $i => $value){
            $collection[$i] = [
                'tanggal' => $value['tanggal'] = Carbon::parse($value['tanggal'])->format('j F Y'),
                'jam' =>$value['jam'],
                'keluhan' => $value['keluhan'],
                'psikolog' => $value['psikolog'],
                'layanan' => $value['layanan'],
                'ruangan' => $value['ruangan'],
                'status' => $value['status']
            ];
        }
        // dd($collection1);
        $request->until = Carbon::parse($request->until)->format('dmY');
        $request->from = Carbon::parse($request->from)->format('dmY');

        $exporter = app()->makeWith(KlienReport::class, compact('collection'));
        return $exporter->download('report-klien-'.$klien->name.'-'.$request->from.'-'.$request->until.'.xlsx');
      }

}
