<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Layanan;
use App\User;
use App\Klien;
use App\Jadwal;
use App\Status;
use App\Sesi;
use App\Ruangan;
use App\Psikolog;
use App\Tes;
use Alert;
use Carbon\Carbon;
use App\Charts\ECharts;
use App\Charts\Chartjs;
use Charts;
use DB;

class HomeController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pengalihan_psikolog = Jadwal::leftjoin('status','jadwal.status_id','=','status.id')
                                    ->where('status.nama','Pengalihan Psikolog')
                                    ->get();
        $psikolog = User::all()
                      ->where('level','Psikolog')
                      ->where('status','Not Approved')
                      ->sortBy('name');
        $menunggu_konfirmasi = Jadwal::leftjoin('status','jadwal.status_id','=','status.id')
                                    ->where('status.nama','Menunggu Konfirmasi')
                                    ->get();
        $terjadwal = Jadwal::leftjoin('status','jadwal.status_id','=','status.id')
                                    ->where('status.nama','Terjadwal')
                                    ->where('ruangan_id',NULL)
                                    ->get();
        $list= Jadwal::leftjoin('status','jadwal.status_id','=','status.id')
                      ->select('jadwal.tanggal_konsultasi', 'jadwal.id','jadwal.sesi_id','jadwal.klien_id','jadwal.ruangan_id','jadwal.psikolog_id', 'status.nama','jadwal.layanan_id','jadwal.keluhan')
                      ->where('jadwal.tanggal_konsultasi','=',Carbon::today())
                      ->where('status.nama','=','Terjadwal')
                      ->orderBy('status.nama','=','Terjadwal')
                      ->orderBy('tanggal_konsultasi','desc')
                      ->get();

        $counter = 1;
        

        /*=============== START CHARTS ===============*/

        $data = DB::table('jadwal')
            ->leftjoin('layanan','jadwal.layanan_id','=','layanan.id')
            ->leftjoin('status','jadwal.status_id','=','status.id')
            ->select([
                DB::raw('count(layanan_id) as count'),
                DB::raw('layanan.nama as nama'),
                ])
            ->where('status.nama','=','Selesai')
            ->whereYear('jadwal.tanggal_konsultasi', '=', date('Y'))
            ->groupBy('jadwal.layanan_id','layanan.nama')
            // ->orderBy('count','desc')
            ->orderBy('nama','asc')
            ->get();
            // dd($data);

        $collection=[];
        $collection2 =[];

        foreach ($data as $key => $value) {
            $collection[$key] = $value->count;
        }
        foreach ($data as $key => $value) {
            $collection2[$key] = $value->nama;
        }
        
        $chart = new ECharts;
        $chart->labels($collection2);
        $chart->dataset('Layanan', 'pie', $collection)->options([
            'label' => false,            
            // 'radius' => ['50%', '70%'],
        ]);
        $chart->displayAxes(false);
        $chart->theme('light');
        /*=== STATISTIK BULANAN ===*/

        $thisMonth = DB::table('jadwal')
            ->leftjoin('layanan','jadwal.layanan_id','=','layanan.id')
            ->leftjoin('status','jadwal.status_id','=','status.id')
            ->select([
                DB::raw('count(layanan_id) as count'),
                DB::raw('layanan.nama as nama'),
              ])
            ->where('status.nama','=','Selesai')
            ->whereMonth('jadwal.tanggal_konsultasi', '=', date('m'))
            ->groupBy('jadwal.layanan_id','layanan.nama')
            // ->orderBy('count','desc')
            ->orderBy('nama','asc')
            ->get();

        $month=[];
        $month2 =[];

        foreach ($thisMonth as $key => $value) {
            $month[$key] = $value->count;
        }
        foreach ($thisMonth as $key => $value) {
            $month2[$key] = $value->nama;
        }

        $lineChart = new ECharts;
        $lineChart->labels($month2);
        $lineChart->dataset('Layanan', 'pie', $month)->options([
            'label' => false
        ]);
        $lineChart->theme('light');
        $lineChart->displayAxes(false);

        /*=== STATISTIK MINGGUAN ===*/

        $thisWeek = DB::table('jadwal')
            ->leftjoin('layanan','jadwal.layanan_id','=','layanan.id')
            ->leftjoin('status','jadwal.status_id','=','status.id')
            ->select([
                DB::raw('count(layanan_id) as count'),
                DB::raw('layanan.nama as nama'),
              ])
            ->where('status.nama','=','Selesai')
            ->whereBetween('jadwal.tanggal_konsultasi', [Carbon::now()->startOfWeek(),Carbon::now()->endOfWeek()])
            // ->whereDate('jadwal.tanggal_konsultasi', '>=', date('Y-m-d H:i:s',strtotime('-7 days')) )
            ->groupBy('jadwal.layanan_id','layanan.nama')
            // ->orderBy('count','desc')
            ->orderBy('nama','asc')
            ->get();

        $week=[];
        $week2 =[];

        foreach ($thisWeek as $key => $value) {
            $week[$key] = $value->count;
        }
        foreach ($thisWeek as $key => $value) {
            $week2[$key] = $value->nama;
        }

        $barChart = new ECharts;
        $barChart->labels($week2);
        $barChart->dataset('Layanan', 'pie', $week)->options([
            'label' => false,
        ]);
        $barChart->displayAxes(false);
        $barChart->theme('light');

         /*=== STATISTIK BULANAN LINE ===*/

        $thisStatistik = Jadwal::leftjoin('status','jadwal.status_id','=','status.id')
            ->select([
                DB::raw('count(jadwal.id) as jumlah'),
                DB::raw('DATE(jadwal.tanggal_konsultasi) as day'),
              ])
            ->where('status.nama','=','Selesai')
            ->whereMonth('jadwal.tanggal_konsultasi', '=', date('m'))
            ->groupBy('day')
            ->get();


        $statistik=[];
        $statistik2 =[];

        foreach ($thisStatistik as $key => $value) {
            $statistik[$key] = $value['jumlah'];
        }
        foreach ($thisStatistik as $key => $value) {
            $statistik2[$key] = Carbon::parse($value['day'])->format('j F Y');
        }

        $jadwalChart = new ECharts;
        $jadwalChart->labels($statistik2);
        $jadwalChart->dataset('Jumlah Konsultasi Bulan Ini', 'line', $statistik);
        $jadwalChart->displayAxes(true);
        $jadwalChart->theme('light');
        $jadwalChart->options([
                            'xAxis' => [
                                'name' => 'Tanggal Konsul' // or false, depending on what you want.
                            ],
                            'yAxis' => [
                                'name' => 'Jumlah Konsultasi' // or false, depending on what you want.
                            ]
                        ]);

        return view('index',compact('pengalihan_psikolog','psikolog','menunggu_konfirmasi','terjadwal','list','counter','chart', 'barChart','lineChart','jadwalChart'));
    }
        /*====================end=================*/
        /*=================Jadwal Tahunan==========*/
        // $title = 'Jadwal';
        // $konsultasi1 = Jadwal::leftjoin('status','jadwal.status_id','=','status.id')->where('status.nama','=','Selesai')
        //                   ->whereYear('tanggal_konsultasi', date('Y'))->whereMonth('tanggal_konsultasi','01')->count();
        // $konsultasi2 = Jadwal::leftjoin('status','jadwal.status_id','=','status.id')->where('status.nama','=','Selesai')
        //                   ->whereYear('tanggal_konsultasi', date('Y'))->whereMonth('tanggal_konsultasi','02')->count();
        // $konsultasi2= Jadwal::leftjoin('status','jadwal.status_id','=','status.id')->where('status.nama','=','Selesai')
        //                   ->whereYear('tanggal_konsultasi', date('Y'))->whereMonth('tanggal_konsultasi','03')->count();
        // $konsultasi3 = Jadwal::leftjoin('status','jadwal.status_id','=','status.id')->where('status.nama','=','Selesai')
        //                   ->whereYear('tanggal_konsultasi', date('Y'))->whereMonth('tanggal_konsultasi','04')->count();
        // $konsultasi4 = Jadwal::leftjoin('status','jadwal.status_id','=','status.id')->where('status.nama','=','Selesai')
        //                   ->whereYear('tanggal_konsultasi', date('Y'))->whereMonth('tanggal_konsultasi','05')->count();
        // $konsultasi5 = Jadwal::leftjoin('status','jadwal.status_id','=','status.id')->where('status.nama','=','Selesai')
        //                   ->whereYear('tanggal_konsultasi', date('Y'))->whereMonth('tanggal_konsultasi','06')->count();
        // $konsultasi6 = Jadwal::leftjoin('status','jadwal.status_id','=','status.id')->where('status.nama','=','Selesai')
        //                   ->whereYear('tanggal_konsultasi', date('Y'))->whereMonth('tanggal_konsultasi','07')->count();
        // $konsultasi7 = Jadwal::leftjoin('status','jadwal.status_id','=','status.id')->where('status.nama','=','Selesai')
        //                   ->whereYear('tanggal_konsultasi', date('Y'))->whereMonth('tanggal_konsultasi','08')->count();
        // $konsultasi8 = Jadwal::leftjoin('status','jadwal.status_id','=','status.id')->where('status.nama','=','Selesai')
        //                   ->whereYear('tanggal_konsultasi', date('Y'))->whereMonth('tanggal_konsultasi','09')->count();
        // $konsultasi9 = Jadwal::leftjoin('status','jadwal.status_id','=','status.id')->where('status.nama','=','Selesai')
        //                   ->whereYear('tanggal_konsultasi', date('Y'))->whereMonth('tanggal_konsultasi','10')->count();
        // $konsultasi10 = Jadwal::leftjoin('status','jadwal.status_id','=','status.id')->where('status.nama','=','Selesai')
        //                   ->whereYear('tanggal_konsultasi', date('Y'))->whereMonth('tanggal_konsultasi','11')->count();
        // $konsultasi12 = Jadwal::leftjoin('status','jadwal.status_id','=','status.id')->where('status.nama','=','Selesai')
        //                   ->whereYear('tanggal_konsultasi', date('Y'))->whereMonth('tanggal_konsultasi','12')->count();
        
        //                   // dd($jadwal1);
        // $chart1 = \Charts::title([
        //   'text' => 'Grafik Konsultasi Per Bulan',
        //   ])
        // ->chart([
        //     'type' => 'line',
        //     'renderTo' => 'chart1',
        //   ])
        // ->subtitle([
        //   'text' => 'UKP UGM'
        //   ])
        // ->colors([
        //   '#0c2959'
        //   ])
        // ->xaxis([
        //     'categories'=>[
        //       'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        //     ],
        //     'labels'=>[
        //       'rotation'=>15,
        //       'align'=>'top',
        //       'formatter'=>'startJs:function(){return this.value}:endJs',
        //     ],
        //     'title'=>[
        //       'text'=>'Bulan'
        //     ]
        //   ])
        // ->yaxis([
        //     'title'=>[
        //       'text'=>'Nilai'
        //     ]
        //   ])
        // ->legend([
        //     'layout'=>'vertikel',
        //     'align'=>'right',
        //     'verticalAlign'=>'middle',
        //   ])
        // ->credits([
        //     'disable'
        //   ])
        // ->series([
        //     [
        //       'name'=> 'Konsultasi',
        //       'data'=>[$konsultasi1, $konsultasi2, $konsultasi3, $konsultasi4, $konsultasi5, $konsultasi6, $konsultasi7, $konsultasi8, $konsultasi9, $konsultasi10, $konsultasi11, $konsultasi12]
        //     ]
        //   ])
        // ->display();
        /*=================End Jadwal Tahunan==========*/
        

    public function konfirmasi(){
      $konfirmasi = Jadwal::leftjoin('status','jadwal.status_id','=','status.id')
                                    ->where('status.nama','Konfirmasi')
                                    ->count()
                                    ->get();
                                    // dd($konfirmasi);
      return response()->json([
        'status'=>'success',
        'result'=>$konfirmasi,
      ]); 
    }

    /*========= KONSULTASI HARI INI============*/

        public function show($id)
        {
          $jadwal = Jadwal::find($id);
          return view('index_detail',compact('jadwal'));
        }
        public function edit($id)
        {
          $data = Jadwal::findOrFail($id);
          $sesi = Sesi::all();
          $klien = Klien::all();
          $layanan = Layanan::all();
          $ruangan = Ruangan::all();
          $psikolog = Psikolog::all();
          $status = Status::all();

          return view('index_edit',compact('data','sesi','klien','layanan','ruangan','psikolog','status'));
        //print_r($data);
        }

        public function update(Request $request,$id)
        {
           $check = Jadwal::where('tanggal_konsultasi', $request->tanggal_konsultasi)
                           ->where('psikolog_id', $request->psikolog_id)
                           ->where('sesi_id', $request->sesi_id)
                           ->where('ruangan_id', $request->ruangan_id)
                           ->where('status_id', $request->status_id)
                           ->where('jadwal.id','!=',$request->id)
                           ->first();

          $check1 = Jadwal::where('tanggal_konsultasi', $request->tanggal_konsultasi)
                           ->where('psikolog_id', $request->psikolog_id)
                           ->where('sesi_id', $request->sesi_id)
                           ->where('status_id', $request->status_id)
                           ->where('jadwal.id','!=',$request->id)
                           ->first();

          $check2 = Jadwal::where('tanggal_konsultasi', $request->tanggal_konsultasi)
                           ->where('sesi_id', $request->sesi_id)
                           ->where('ruangan_id', $request->ruangan_id)
                           ->where('status_id', $request->status_id)
                           ->where('jadwal.id','!=',$request->id)
                           ->first();


          // // dd($query1, $request);
          // // dd($check);
          if($check) {
            Alert::warning('Peringatan!', 'Data Sudah Tersedia!');
            return redirect()->back();
          } else if ($check1) {
            Alert::warning('Peringatan!', 'Data Sudah Tersedia!');
            return redirect()->back();
          } else if ($check2) {
            Alert::warning('Peringatan!', 'Data Sudah Tersedia!');
            return redirect()->back();
          } else {
          $this->validate($request, [
          'tanggal_konsultasi' => 'required|date',
          'sesi_id' => 'required',
          'keluhan' => 'required',
          'layanan_id' => 'required',
          'ruangan_id' => 'required',
          'status_id' => 'required'
        ],
        [
          'tanggal_konsultasi.required' => 'Tanggal tidak boleh kosong!',
          'sesi_id.required' => 'Sesi tidak boleh kosong!',
          'keluhan.required' => 'Keluhan tidak boleh kosong!',
          'layanan_id.required' => 'Layanan tidak boleh kosong!',
          'ruangan_id.required' => 'Ruangan tidak boleh kosong!',
          'status_id.required' => 'Status tidak boleh kosong!',
        ]);
          $data = Jadwal::find($id);
          $data->tanggal_konsultasi=$request->tanggal_konsultasi;
          $data->sesi_id=$request->get('sesi_id');
          $data->klien_id = $request->get('klien_id');
          $data->keluhan=$request->get('keluhan');
          $data->layanan_id=$request->get('layanan_id');
          $data->ruangan_id=$request->get('ruangan_id');
          $data->psikolog_id = $request->get('psikolog_id');
          $data->status_id = $request->get('status_id');
          $data->save();
          Alert::success('Berhasil!','Data Berhasil Diubah');
          return redirect('/home');
          }
          
        }
}
