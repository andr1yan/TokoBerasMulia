<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Yajra\DataTables\Facades\DataTables;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExportLaporanKeluar;
use Illuminate\Support\Facades\Storage;
use PDF;

class KeuanganKeluarController extends Controller
{
    public function index(Request $r) 
    {
        $dateFirst = $r->input('date_first') ?? now()->format('d-m-Y');
        $dateLast = $r->input('date_last') ?? now()->format('d-m-Y');
        return view('data-keuangan.keuangan-keluar.index', ['dateFirst' => $dateFirst,'dateLast' => $dateLast]);
    }

    public function create() 
    {
        return view('data-keuangan.keuangan-keluar.create');
    }

    public function data(Request $r)
    {
        $dateFirstx = $r->input('date_first');
        $dateLastxx = $r->input('date_last');
        $dateFirst  = date_format(date_create($dateFirstx), 'Y-m-d');
        $dateLast  = Carbon::create($dateLastxx)->addDay()->format('Y-m-d');
        
        if($r->ajax())
        {
            
                $data = DB::table('keuangan_keluar as a')
                    ->join('master_beras as b', 'a.id_beras', '=', 'b.id')
                    ->select('a.id','b.nama_beras', 'b.kode_beras', 'b.kategori', 'b.harga_beli', 'a.tanggal', 'a.jumlah_masuk', 'a.total_keluar')
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
                    'jumlah_masuk' => $d->jumlah_masuk,
                    'harga_beli'   => 'Rp. '.$d->harga_beli,
                    'total_keluar'      => 'Rp. '.$d->total_keluar,
                ];
            }
            
            return DataTables::of($data_fix)
            ->addColumn('bukti', function($row){
                $buktiBtn = '<a class="btn btn-secondary" href="'.url('data-keuangan-keluar/show-photo/'.$row['id']).'" target="_blank"><i class="cil-camera"></i></a>
                    ';
                $actionBtn = $buktiBtn;
                return $actionBtn;
            })

            ->rawColumns(['bukti'])->make(true);
        }
    }

    public function downloadpdf(Request $r) 
    {

        $dateFirstx = $r->input('date_first_dd');
        $dateLastxx = $r->input('date_last_dd');
        $dateFirst  = date_format(date_create($dateFirstx), 'Y-m-d');
        $dateLast  = Carbon::create($dateLastxx)->addDay()->format('Y-m-d');

        $data = DB::table('keuangan_keluar as a')
                ->join('master_beras as b', 'a.id_beras', '=', 'b.id')
                ->select('a.created_at','b.nama_beras', 'a.tanggal', 'b.harga_beli', 'a.jumlah_masuk', 'b.kategori', 'a.total_keluar')
                ->whereBetween('a.created_at', [$dateFirst, $dateLast])->get();

        $pdf = Pdf::loadView('data-keuangan.keuangan-keluar.pdff', ['pdf' => $data]);
        return $pdf->download('LaporanKeuanganKeluar_'.$dateFirstx.'_'.$dateLastxx.'.pdf');
    }

    public function downloadexcel(Request $r) 
    {
        $dateFirstx = $r->input('date_first_d');
        $dateLastxx = $r->input('date_last_d');
        $dateFirst  = date_format(date_create($dateFirstx), 'Y-m-d');
        $dateLast  = Carbon::create($dateLastxx)->addDay()->format('Y-m-d');

        $data = DB::table('keuangan_keluar as a')
                ->join('master_beras as b', 'a.id_beras', '=', 'b.id')
                ->select('a.created_at','b.nama_beras', 'a.tanggal', 'b.harga_beli', 'a.jumlah_masuk', 'b.kategori', 'a.total_keluar')
                ->whereBetween('a.created_at', [$dateFirst, $dateLast])->get();

        return Excel::download(new ExportLaporanKeluar($data,$dateFirstx,$dateLastxx), 'LaporanKeuanganKeluar_'.$dateFirstx.'_'.$dateLastxx.'.xlsx');
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

        $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'foto.required' => 'Foto harus diunggah.',
            'foto.image' => 'File yang diunggah harus berupa gambar.',
            'foto.mimes' => 'Foto harus dalam format: jpeg, png atau jpg',
            'foto.max' => 'Ukuran foto tidak boleh lebih dari 2MB.',
        ]);

        $idBeras = $request->input('id_beras');
        $tanggal = $request->input('tanggal');
        $jumlah_masuk = $request->input('jumlah_masuk');
        $foto = $request->input('foto');
        $master = DB::table('master_beras')
            ->select("harga_beli", "jumlah_stok")
            ->where('id', $idBeras)
            ->first();

            $path = $request->file('foto')->store('public/foto');
            $url = Storage::url($path);
            
            $totalKeluar = $master->harga_beli * $jumlah_masuk;
            $jumlahMasuk = $master->jumlah_stok + $jumlah_masuk;

        DB::table('keuangan_keluar')
            ->insert([
                'id_beras' => $idBeras,
                'tanggal' => $tanggal,
                'jumlah_masuk' => $jumlah_masuk,
                'total_keluar' => $totalKeluar,
                'foto' => $url,
                'created_at' => now()
            ]);
        DB::table('master_beras')
            ->where('id', $idBeras)
            ->update([
                'jumlah_stok' => $jumlahMasuk
            ]);

        return redirect()->route('home-keuangan-keluar')->with('successkeluar', 'Berhasil Menambahkan Data');
    }

    public function showPhoto($id)
    {
        $show = DB::table('keuangan_Keluar')
            ->select('foto')
            ->where('id', $id)
            ->first();
        return view('data-keuangan.keuangan-keluar.foto',["path" => $show]);
    }
}
