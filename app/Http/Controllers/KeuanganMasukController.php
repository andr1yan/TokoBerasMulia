<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Yajra\DataTables\Facades\DataTables;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExportLaporan;
use PDF;

class KeuanganMasukController extends Controller
{
    public function index(Request $r) 
    {
        $dateFirst = $r->input('date_first') ?? now()->format('d-m-Y');
        $dateLast = $r->input('date_last') ?? now()->format('d-m-Y');
        return view('data-keuangan.keuangan-masuk.index', ['dateFirst' => $dateFirst,'dateLast' => $dateLast]);
    }

    public function data(Request $r)
    {
        $dateFirstx = $r->input('date_first');
        $dateLastxx = $r->input('date_last');
        $dateFirst  = date_format(date_create($dateFirstx), 'Y-m-d');
        $dateLast  = Carbon::create($dateLastxx)->addDay()->format('Y-m-d');
        
        if($r->ajax())
        {
            
                $data = DB::table('keuangan_masuk as a')
                    ->join('master_beras as b', 'a.id_beras', '=', 'b.id')
                    ->select('a.id','b.nama_beras', 'b.kode_beras', 'b.kategori', 'b.harga_jual', 'a.tanggal', 'a.jumlah_keluar', 'a.total_masuk')
                    ->whereBetween('a.created_at', [$dateFirst, $dateLast]);
                $dataCount = $data->count();
                $data      = $data->get();
            

            if(empty($dataCount))
            {
                $data_fix = [];
                return DataTables::of($data_fix)->make(true);
            }

            foreach ( $data as $d ) {
                
                $data_fix[] = [
                    'id'         => $d->id,
                    'kode_beras' => $d->kode_beras,
                    'nama_beras' => $d->nama_beras,
                    'tanggal'    => $d->tanggal,
                    'kategori'   => $d->kategori,
                    'jumlah_keluar' => $d->jumlah_keluar,
                    'harga_jual'   => 'Rp. '.$d->harga_jual,
                    'total_masuk'   => 'Rp. '.$d->total_masuk,
                ];
            }
            
            return DataTables::of($data_fix)
            ->addColumn('faktur', function($row){
                $fakturBtn = '<a class="btn btn-secondary" href="'.url('data-keuangan-masuk/download-pdf/'.$row['id']).'" target="_blank"><i class="cil-print"></i></a>
                    ';
                $actionBtn = $fakturBtn;
                return $actionBtn;
            })

            ->rawColumns(['faktur'])->make(true);
        }
    }

    public function create() 
    {
        return view('data-keuangan.keuangan-masuk.create');
    }

    public function downloadpdf($id) 
    {

        $info = DB::table('setting')
            ->select("nama_toko", "alamat", "no_telp", "fax")
            ->first();
            
        $faktur = DB::table('keuangan_masuk as a')
            ->join('master_beras as b', 'a.id_beras', '=', 'b.id')
            ->select("a.id", "a.id_beras", "a.tanggal", "a.jumlah_keluar", "a.total_masuk", "b.nama_beras", "b.kategori", "b.harga_jual")
            ->where('a.id', $id)
            ->first();

        $pdf = Pdf::loadView('data-keuangan.keuangan-masuk.pdf', ['f' => $faktur, 'i' => $info]);
        return $pdf->download($faktur->nama_beras.'.pdf');
        // return view('qr-generator.pdf',['a' => $anggota1]);
    }

    public function downloadpdff(Request $r) 
    {

        $dateFirstx = $r->input('date_first_dd');
        $dateLastxx = $r->input('date_last_dd');
        $dateFirst  = date_format(date_create($dateFirstx), 'Y-m-d');
        $dateLast  = Carbon::create($dateLastxx)->addDay()->format('Y-m-d');

        $data = DB::table('keuangan_masuk as a')
                ->join('master_beras as b', 'a.id_beras', '=', 'b.id')
                ->select('a.created_at','b.nama_beras', 'a.tanggal', 'b.harga_jual', 'a.jumlah_keluar', 'b.kategori', 'a.total_masuk')
                ->whereBetween('a.created_at', [$dateFirst, $dateLast])->get();

        $pdf = Pdf::loadView('data-keuangan.keuangan-masuk.pdff', ['pdf' => $data]);
        return $pdf->download('LaporanKeuanganMasuk_'.$dateFirstx.'_'.$dateLastxx.'.pdf');
    }

    public function downloadexcel(Request $r) 
    {
        $dateFirstx = $r->input('date_first_d');
        $dateLastxx = $r->input('date_last_d');
        $dateFirst  = date_format(date_create($dateFirstx), 'Y-m-d');
        $dateLast  = Carbon::create($dateLastxx)->addDay()->format('Y-m-d');

        $data = DB::table('keuangan_masuk as a')
                ->join('master_beras as b', 'a.id_beras', '=', 'b.id')
                ->select('a.created_at','b.nama_beras', 'a.tanggal', 'b.harga_jual', 'a.jumlah_keluar', 'b.kategori', 'a.total_masuk')
                ->whereBetween('a.created_at', [$dateFirst, $dateLast])->get();

        return Excel::download(new ExportLaporan($data,$dateFirstx,$dateLastxx), 'LaporanKeuanganMasuk_'.$dateFirstx.'_'.$dateLastxx.'.xlsx');
    }

    public function kode(Request $r) 
    {
        if($r->ajax())
        {
            $data = DB::table('master_beras')
                ->select('id','kode_beras', 'nama_beras')
                ->where('kode_beras','LIKE','%'.$r->term.'%')
                ->orWhere('nama_beras','LIKE','%'.$r->term.'%')
                ->paginate(10, ['*'], 'page', $r->page);

            return response()->json([$data]);
        }
    }

    public function store(Request $request) 
    {

        $idBeras = $request->input('id_beras');
        $tanggal = $request->input('tanggal');
        $jumlah_keluar = $request->input('jumlah_keluar');
        $master = DB::table('master_beras')
            ->select("harga_jual", "jumlah_stok")
            ->where('id', $idBeras)
            ->first();

        $totalMasuk = $master->harga_jual * $jumlah_keluar;
        $jumlahKeluar = $master->jumlah_stok - $jumlah_keluar;
    
        DB::table('keuangan_masuk')
            ->insert([
                'id_beras' => $idBeras,
                'tanggal' => $tanggal,
                'jumlah_keluar' => $jumlah_keluar,
                'total_masuk' => $totalMasuk,
                'created_at' => now()
            ]);
        DB::table('master_beras')
            ->where('id', $idBeras)
            ->update([
                'jumlah_stok' => $jumlahKeluar
            ]);

        return redirect()->route('home-keuangan-masuk')->with('successmasuk', 'Berhasil Menambahkan Data');
    }

}
