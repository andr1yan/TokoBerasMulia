<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index() 
    {
        $hari = now();
        $hariIni = $hari->format('Y-m-d');
        $bulanIni = $hari->format('m');
        $tahunIni = $hari->format('Y');

        $masukHariIni = DB::table('keuangan_masuk')
            ->whereDate('created_at', $hariIni)
            ->sum('total_masuk');
        $masukBulanIni = DB::table('keuangan_masuk')
            ->whereMonth('created_at', $bulanIni)
            ->whereYear('created_at', $tahunIni)
            ->sum('total_masuk');
        $masukTahunIni = DB::table('keuangan_masuk')
            ->whereYear('created_at', $tahunIni)
            ->sum('total_masuk');
        $keluarHariIni = DB::table('keuangan_keluar')
            ->whereDate('created_at', $hariIni)
            ->sum('total_keluar');
        $keluarBulanIni = DB::table('keuangan_keluar')
            ->whereMonth('created_at', $bulanIni)
            ->whereYear('created_at', $tahunIni)
            ->sum('total_keluar');
        $keluarTahunIni = DB::table('keuangan_keluar')
            ->whereYear('created_at', $tahunIni)
            ->sum('total_keluar');
        $totalPemasukan = DB::table('keuangan_masuk')
            ->sum('total_masuk');
        $totalPengeluaran = DB::table('keuangan_keluar')
            ->sum('total_keluar');
        
        return view('index', ["mh" => $masukHariIni, "mb" => $masukBulanIni, "mt" => $masukTahunIni, "kh" => $keluarHariIni, "kb" => $keluarBulanIni, "kt" => $keluarTahunIni, "tp" => $totalPemasukan, "tk" =>$totalPengeluaran]);
    }
}
