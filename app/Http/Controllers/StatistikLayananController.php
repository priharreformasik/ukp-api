<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use App\Layanan;
use Auth;
use PDF;
use App\Jadwal;
use App\Kategori;
use Carbon\Carbon;
use Alert;
use Export;
use App\Excel\LayananReport;
use App\Excel\LayananExcel;
use App\Charts\ECharts;
use App\Charts\Chartjs;
use DB;

class StatistikLayananController extends Controller
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
        $layanan = Layanan::all()->sortBy('nama');
        return view('statistik.statistik_layanan_list',compact('layanan'));
    }    

    public function report(Request $request){

        if($request->from > $request->until){
            Alert::error('Oops', 'Input tanggal salah!');
            return back()->withInput();
        } else{
            $list = Jadwal::leftjoin('layanan','jadwal.layanan_id','=','layanan.id')
                        ->leftjoin('status','jadwal.status_id','=','status.id')
                        ->where('layanan.id',$request->layanan)
                        ->where('jadwal.tanggal','>=', $request->from = Carbon::parse($request->from))
                        ->where('jadwal.tanggal','<=', $request->until = Carbon::parse($request->until))
                        ->where('status.nama','=','Selesai')
                        ->select('jadwal.*')  
                        ->with(['psikolog', 'klien','layanan', 'status', 'ruangan', 'sesi'])
                        ->orderBy('tanggal','desc')
                        ->get();  
                        // dd($list);
            if (empty($list[0]->id)) {
                Alert::error('Oops', 'Data tidak tersedia!');
                return back()->withInput();                 
            }                      
            $layanan = Layanan::where('id',$request->layanan)->first();    
            return view('statistik.layanan_report',compact('request','layanan','list'));
        }
    }

    public function report_all(Request $request){

        if($request->from > $request->until){
            Alert::error('Oops', 'Input tanggal salah!');
            return back()->withInput();
        }else{
                $list = Jadwal::leftjoin('layanan','jadwal.layanan_id','=','layanan.id')
                                ->leftjoin('status','jadwal.status_id','=','status.id')
                                ->leftjoin('ruangan','jadwal.ruangan_id','=','ruangan.id')
                                ->leftjoin('sesi','jadwal.sesi_id','=','sesi.id')
                                ->leftjoin('klien','jadwal.klien_id','=','klien.id')
                                ->leftjoin('psikolog','jadwal.psikolog_id','=','psikolog.id')
                                ->where('status.nama','=','Selesai')
                                ->where('jadwal.tanggal','>=', $request->from = Carbon::parse($request->from))
                                ->where('jadwal.tanggal','<=', $request->until = Carbon::parse($request->until))
                                ->select('jadwal.*')  
                                ->with(['psikolog', 'klien','layanan',  'status', 'ruangan', 'sesi'])
                                ->orderBy('layanan.nama')
                                ->orderBy('tanggal','asc')
                                ->get();
                                // dd($list);
                if (empty($list[0]->id)) {
                    Alert::error('Oops', 'Data tidak tersedia!');
                    return back()->withInput();                 
                } 

                $data = DB::table('jadwal')
                    ->leftjoin('layanan','jadwal.layanan_id','=','layanan.id')
                    ->leftjoin('status','jadwal.status_id','=','status.id')
                    ->where('jadwal.tanggal','>=', $request->from = Carbon::parse($request->from))
                    ->where('jadwal.tanggal','<=', $request->until = Carbon::parse($request->until))
                    ->select([
                        DB::raw('count(layanan_id) as count'),
                        DB::raw('layanan.nama as tagh'),
                        ])
                    ->where('status.nama','=','Selesai')
                    ->groupBy('jadwal.layanan_id','layanan.nama')
                    ->orderBy('count','desc')
                    // ->offset(0)
                    ->limit(30)
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
                $chart->dataset('Jumlah Konsultasi Berdasarkan Jenis Layanan', 'bar', $collection);
                $chart->theme('light');
                $chart->options([
                            'xAxis' => [
                                'name' => 'Jenis Layanan' // or false, depending on what you want.
                            ],
                            'yAxis' => [
                                'name' => 'Jumlah Konsultasi' // or false, depending on what you want.
                            ]
                        ]);
                // $chart->displayAxes(false);

                return view('statistik.report_all_layanan',compact('chart','request','layanan','list'));
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
                        ->where('jadwal.tanggal','>=', $request->from = Carbon::parse($request->from))
                        ->where('jadwal.tanggal','<=', $request->until = Carbon::parse($request->until))
                        ->where('status.nama','=','Selesai')
                        ->select('jadwal.*')  
                        ->with(['psikolog', 'klien','layanan', 'status', 'ruangan', 'sesi'])
                        ->orderBy('layanan.nama')
                        ->orderBy('tanggal','asc')
                        ->get();
        // Send data to the view using loadView function of PDF facade
        $pdf = PDF::loadView('pdf.report_layanan_pdf', compact('data','request'))->setPaper('a4', 'landscape');
        // If you want to store the generated pdf to the server then you can use the store function
        $pdf->save(storage_path().'_filename.pdf');
        // Finally, you can download the file using download function
        return $pdf->download('Rekap layanan.pdf');
      }

       public function layanan_pdf(Request $request)
      {
        // Fetch all customers from database
        $data = Jadwal::leftjoin('layanan','jadwal.layanan_id','=','layanan.id')
                        ->leftjoin('status','jadwal.status_id','=','status.id')
                        ->leftjoin('ruangan','jadwal.ruangan_id','=','ruangan.id')
                        ->leftjoin('sesi','jadwal.sesi_id','=','sesi.id')
                        ->leftjoin('klien','jadwal.klien_id','=','klien.id')
                        ->leftjoin('psikolog','jadwal.psikolog_id','=','psikolog.id')
                        ->where('layanan.id',$request->layanan)
                        ->where('jadwal.tanggal','>=', $request->from = Carbon::parse($request->from))
                        ->where('jadwal.tanggal','<=', $request->until = Carbon::parse($request->until))
                        ->where('status.nama','=','Selesai')
                        ->select('jadwal.*')  
                        ->with(['psikolog', 'klien','layanan', 'status', 'ruangan', 'sesi'])
                        ->orderBy('layanan.nama')
                        ->orderBy('tanggal','desc')
                        ->get();
        $layanan = Layanan::where('id',$request->layanan)->first();
        // Send data to the view using loadView function of PDF facade
        $pdf = PDF::loadView('pdf.report_perlayanan_pdf', compact('data','request','layanan'))->setPaper('a4', 'landscape');
        // If you want to store the generated pdf to the server then you can use the store function
        $pdf->save(storage_path().'_filename.pdf');
        // Finally, you can download the file using download function
        return $pdf->download('Rekap perlayanan.pdf');
      }

    public function export_excel(Request $request)
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
                        ->where('jadwal.tanggal','>=', $request->from = Carbon::parse($request->from))
                        ->where('jadwal.tanggal','<=', $request->until = Carbon::parse($request->until))
                        ->where('status.nama','=','Selesai')
                        ->select('jadwal.tanggal as tanggal','sesi.jam as jam','layanan.nama as nama','layanan.harga as harga','a.name as psikolog','b.name as klien')  
                        ->orderBy('layanan.nama')
                        ->orderBy('tanggal','asc')
                        ->get()
                        ->toArray();
                        // dd($data);
        $collection = [];
        foreach($data as $i => $layanan){
            $collection[$i] = [
                'nama' => $layanan['nama'],
                'jam' => $value['jam'],
                'tanggal' => $layanan['tanggal'],
                'psikolog' => $layanan['psikolog'],
                'klien' => $layanan['klien'],
                'harga' => $layanan['harga'],
            ];
        }
        // dd($collection);
        $request->until = Carbon::parse($request->until)->format('dmY');
        $request->from = Carbon::parse($request->from)->format('dmY');

        $exporter = app()->makeWith(LayananReport::class, compact('collection'));
        return $exporter->download('rekap-layanan-'.$request->from.'-'.$request->until.'.xlsx');
    }

    public function layanan_excel(Request $request)
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
                        ->leftjoin('kategori_klien','klien.kategori_id','=','kategori_klien.id')
                        ->where('layanan.id',$request->layanan)
                        ->where('jadwal.tanggal','>=', $request->from = Carbon::parse($request->from))
                        ->where('jadwal.tanggal','<=', $request->until = Carbon::parse($request->until))
                        ->where('status.nama','=','Selesai')
                        ->select('jadwal.tanggal as tanggal','sesi.jam as jam','a.name as psikolog','b.name as klien','b.jenis_kelamin as jenis_kelamin','kategori_klien.nama as kategori') 
                        ->orderBy('layanan.nama')
                        ->orderBy('tanggal','desc')
                        ->get()
                        ->toArray();

        $layanan = Layanan::where('id',$request->layanan)->first();
        
        $collection = [];
        foreach($data as $i => $value){
            $collection[$i] = [
                'tanggal' => $value['tanggal'],
                'jam' => $value['jam'],
                'psikolog' => $value['psikolog'],
                'klien' => $value['klien'],
                'jenis_kelamin' => $value['jenis_kelamin'],
                'kategori' => $value['kategori']
            ];
        }
        // dd($collection1);
        $request->until = Carbon::parse($request->until)->format('dmY');
        $request->from = Carbon::parse($request->from)->format('dmY');

        $exporter = app()->makeWith(LayananExcel::class, compact('collection'));
        return $exporter->download('rekap-'.$layanan->nama.'-'.$request->from.'-'.$request->until.'.xlsx');
    }

}
