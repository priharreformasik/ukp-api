<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\Jadwal;
use App\Psikolog;
use App\Keahlian;
use App\User;
use App\Excel\PsikologExcel;
use App\Excel\PsikologReport;
use Auth;
use File;
use PDF;
use Alert;
use Carbon\Carbon;
use App\Charts\ECharts;
use App\Charts\Chartjs;
use DB;

class StatistikPsikologController extends Controller
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
        $psikolog = User::where('level','Psikolog')->get()->sortBy('name');
        return view('statistik.statistik_psikolog_list',compact('psikolog'));
        //dd($list);
    }    

    public function report(Request $request){

        if($request->from > $request->until){
            Alert::error('Oops', 'Input tanggal tidak sesuai!');
            return redirect()->back();
        }else{        
            $list = Jadwal::leftjoin('layanan','jadwal.layanan_id','=','layanan.id')
                            ->leftjoin('status','jadwal.status_id','=','status.id')
                            ->leftjoin('ruangan','jadwal.ruangan_id','=','ruangan.id')
                            ->leftjoin('sesi','jadwal.sesi_id','=','sesi.id')
                            ->leftjoin('klien','jadwal.klien_id','=','klien.id')
                            ->leftjoin('psikolog','jadwal.psikolog_id','=','psikolog.id')
                            ->leftjoin('users','psikolog.user_id','=','users.id')
                            ->where('users.id',$request->psikolog)
                            ->where('jadwal.tanggal','>=', $request->from = Carbon::parse($request->from))
                            ->where('jadwal.tanggal','<=', $request->until = Carbon::parse($request->until))
                            ->where(function($query){
                                $query->where('status.nama','=','Terjadwal')
                                ->orWhere('status.nama','=','Selesai');
                            })
                            ->with(['klien', 'layanan', 'status', 'ruangan', 'sesi'])
                            ->select('jadwal.*')
                            ->orderBy('tanggal','desc')
                            ->orderBy('users.name')
                            ->get();

            if (empty($list[0]->id)) {
                Alert::error('Oops', 'Data tidak tersedia!');
                return back()->withInput();                 
            } 
            $psikolog = User::where('id',$request->psikolog)->first();
            return view('statistik.psikolog_report',compact('psikolog','list', 'request','user'));
        }
    }   
     public function report_all(Request $request){

        if($request->from > $request->until){
            Alert::error('Oops', 'Input tanggal tidak sesuai!');
            return redirect()->back();
        }else{
            $list = Jadwal::leftjoin('layanan','jadwal.layanan_id','=','layanan.id')
                            ->leftjoin('status','jadwal.status_id','=','status.id')
                            ->leftjoin('ruangan','jadwal.ruangan_id','=','ruangan.id')
                            ->leftjoin('sesi','jadwal.sesi_id','=','sesi.id')
                            ->leftjoin('klien','jadwal.klien_id','=','klien.id')
                            ->leftjoin('psikolog','jadwal.psikolog_id','=','psikolog.id')
                            ->leftjoin('users','psikolog.user_id','=','users.id')
                            ->where('jadwal.tanggal','>=', $request->from = Carbon::parse($request->from))
                            ->where('jadwal.tanggal','<=', $request->until = Carbon::parse($request->until))
                            ->where('status.nama','=','Selesai')
                            ->select('jadwal.*')  
                            ->with(['psikolog','klien', 'layanan',  'status', 'ruangan', 'sesi'])
                            ->orderBy('users.name')
                            ->orderBy('tanggal','asc')
                            ->get();
        // $psikolog = User::where('id',$request->psikolog)->first();
        // dd($psikolog);
            if (empty($list[0]->id)) {
                Alert::error('Oops', 'Data tidak tersedia!');
                return back()->withInput();                 
            } 

            $data = DB::table('jadwal')
                ->leftjoin('layanan','jadwal.layanan_id','=','layanan.id')
                ->leftjoin('status','jadwal.status_id','=','status.id')
                ->leftjoin('psikolog','jadwal.psikolog_id','=','psikolog.id')
                ->leftjoin('users','psikolog.user_id','=','users.id')
                ->where('jadwal.tanggal','>=', $request->from = Carbon::parse($request->from))
                ->where('jadwal.tanggal','<=', $request->until = Carbon::parse($request->until))
                ->select([
                    DB::raw('count(psikolog_id) as count'),
                    DB::raw('users.name as tagh'),
                    ])
                ->where('status.nama','=','Selesai')
                // ->whereYear('jadwal.tanggal', '=', date('Y'))
                ->groupBy('jadwal.psikolog_id','users.name')
                ->orderBy('count','desc')
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
            $chart->dataset('Jumlah Konsultasi Berdasarkan Psikolog', 'bar', $collection);
            $chart->theme('light');
            $chart->options([
                            'xAxis' => [
                                'name' => 'Nama Psikolog' // or false, depending on what you want.
                            ],
                            'yAxis' => [
                                'name' => 'Jumlah Konsultasi' // or false, depending on what you want.
                            ]
                        ]);
                
            return view('statistik.report_all_psikolog',compact('psikolog','list', 'request','user','chart'));
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
                        ->leftjoin('users','psikolog.user_id','=','users.id')
                        ->where('jadwal.tanggal','>=', $request->from = Carbon::parse($request->from))
                        ->where('jadwal.tanggal','<=', $request->until = Carbon::parse($request->until))
                        ->where('status.nama','=','Selesai')
                        ->select('jadwal.*')  
                        // ->select('users.id', 'jadwal.tanggal','jadwal.klien_id as klien','layanan.nama as layanan','tes.nama as tes','status.nama as status','ruangan.nama as ruangan', 'sesi.jam as sesi')
                        ->with(['psikolog','klien', 'layanan',  'status', 'ruangan', 'sesi'])
                        ->orderBy('users.name')
                        ->orderBy('tanggal','asc')
                        ->get();
        // Send data to the view using loadView function of PDF facade
        $pdf = PDF::loadView('pdf.report_psikolog_pdf', compact('data','request'))->setPaper('a4', 'landscape');
        // If you want to store the generated pdf to the server then you can use the store function
        $pdf->save(storage_path().'_filename.pdf');
        // Finally, you can download the file using download function
        return $pdf->download('Rekap_psikolog.pdf');
      }  

    public function psikolog_pdf(Request $request)
      {
        // Fetch all customers from database
        $data = Jadwal::leftjoin('layanan','jadwal.layanan_id','=','layanan.id')
                        ->leftjoin('status','jadwal.status_id','=','status.id')
                        ->leftjoin('ruangan','jadwal.ruangan_id','=','ruangan.id')
                        ->leftjoin('sesi','jadwal.sesi_id','=','sesi.id')
                        ->leftjoin('klien','jadwal.klien_id','=','klien.id')
                        ->leftjoin('psikolog','jadwal.psikolog_id','=','psikolog.id')
                        ->leftjoin('users','psikolog.user_id','=','users.id')
                        ->where('users.id',$request->psikolog)
                        ->where('jadwal.tanggal','>=', $request->from = Carbon::parse($request->from))
                        ->where('jadwal.tanggal','<=', $request->until = Carbon::parse($request->until))
                        ->where(function($query){
                            $query->where('status.nama','=','Terjadwal')
                            ->orWhere('status.nama','=','Selesai');
                        })
                        // ->with(['klien', 'layanan', 'tes', 'status', 'ruangan', 'sesi'])
                        ->select('jadwal.*')
                        ->orderBy('tanggal','desc')
                        ->orderBy('users.name')
                        ->get();
        $psikolog = User::where('id',$request->psikolog)->first();
        $pdf = PDF::loadView('pdf.report_perpsikolog_pdf', compact('data','request','psikolog'))->setPaper('a4', 'landscape');
        // If you want to store the generated pdf to the server then you can use the store function
        $pdf->save(storage_path().'_filename.pdf');
        // Finally, you can download the file using download function
        return $pdf->download('Rekap_perpsikolog.pdf');
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
                        ->select('jadwal.tanggal as tanggal','a.name as psikolog','b.name as klien','layanan.nama as layanan','sesi.jam as jam')  
                        // ->with(['psikolog', 'klien','layanan', 'tes', 'status', 'ruangan', 'sesi','tes'])
                        ->orderBy('tanggal','asc')
                        ->get()
                        ->toArray();

        $collection = [];
        foreach($data as $i => $psikolog){
            $collection[$i] = [
                'psikolog' => $psikolog['psikolog'],
                'tanggal' => $psikolog['tanggal'],
                'jam' =>$psikolog['jam'],
                'klien' => $psikolog['klien'],
                'layanan' => $psikolog['layanan']
                // 'psikolog' => $layanan['psikolog']
            ];
        }
        // dd($collection1);
        $request->until = Carbon::parse($request->until)->format('dmY');
        $request->from = Carbon::parse($request->from)->format('dmY');

        $exporter = app()->makeWith(PsikologExcel::class, compact('collection'));
        return $exporter->download('report-psikolog'.$request->from.'-'.$request->until.'.xlsx');
        
      }

      public function psikolog_excel(Request $request)
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
                        ->where('a.id',$request->psikolog)
                        ->where('jadwal.tanggal','>=', $request->from = Carbon::parse($request->from))
                        ->where('jadwal.tanggal','<=', $request->until = Carbon::parse($request->until))
                        ->where(function($query){
                            $query->where('status.nama','=','Terjadwal')
                            ->orWhere('status.nama','=','Selesai');
                        })
                        // ->with(['klien', 'layanan', 'tes', 'status', 'ruangan', 'sesi'])
                        ->select('jadwal.tanggal as tanggal','a.name as psikolog','b.name as klien','layanan.nama as layanan','sesi.jam as jam','ruangan.nama as ruangan','status.nama as status')
                        ->orderBy('tanggal','desc')
                        ->orderBy('a.name')
                        ->get()
                        ->toArray();
                        // dd($data);
        $psikolog = User::where('id',$request->psikolog)->first();
        
        $collection = [];
        foreach($data as $i => $value){
            $collection[$i] = [
                'tanggal' => $value['tanggal'],
                'jam' =>$value['jam'],
                'klien' => $value['klien'],
                'layanan' => $value['layanan'],
                'ruangan' => $value['ruangan'],
                'status' => $value['status']
            ];
        }
        // dd($collection);
        $request->until = Carbon::parse($request->until)->format('dmY');
        $request->from = Carbon::parse($request->from)->format('dmY');

        $exporter = app()->makeWith(PsikologReport::class, compact('collection'));
        return $exporter->download('report-psikolog-'.$psikolog->name.'-'.$request->from.'-'.$request->until.'.xlsx');
      }
                                                                                     
}
