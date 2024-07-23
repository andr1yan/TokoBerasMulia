<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MasterBerasController extends Controller
{
    public function index() 
    {
        $dataStok = DB::table('master_beras')
            ->select("id", "kode_beras", "nama_beras", "jumlah_stok", "kategori", "harga_jual", "harga_beli")
            ->get();
        return view('data-stok.index', ["dataStok" => $dataStok]);
    }

    public function create() 
    {
        return view('data-stok.create');
    }

    public function store(Request $request) 
    {
        $kodeBeras = $request->input('kode_beras');
        $namaBeras = $request->input('nama_beras');
        $jumlahStok = $request->input('jumlah_stok');
        $kategori = $request->input('kategori');
        $hargaJual = $request->input('harga_jual');
        $hargaBeli = $request->input('harga_beli');

        $validasi = DB::table('master_beras')
            ->where('kode_beras', $request->kode_beras)
            ->count();
        if (!empty($validasi)) {
            return redirect()->route('home-stok-beras')->with('error', 'Gagal Menambahkan Data, Data Sudah Ada / Sudah Terdaftar');
        }
    
        DB::table('master_beras')
            ->insert([
                'kode_beras' => $kodeBeras,
                'nama_beras' => $namaBeras,
                'jumlah_stok' => $jumlahStok,
                'kategori' => $kategori,
                'harga_jual' => $hargaJual,
                'harga_beli' => $hargaBeli,
                'created_at' => now()
            ]);

        return redirect()->route('home-stok-beras')->with('success', 'Berhasil Membuat Data Master');
    }

    public function edit($id)
    {
        $dataStok = DB::table('master_beras')
            ->select("kode_beras", "nama_beras", "jumlah_stok", "kategori", "harga_jual", "harga_beli")
            ->where('id',$id)
            ->first();
        return view('data-stok.edit', [
            "dk" => $dataStok,
            "id" => $id
        ]);
    }

    public function update(Request $request) 
    {
        $id = $request->input('id');
        $kodeBeras = $request->input('kode_beras');
        $namaBeras = $request->input('nama_beras');
        $jumlahStok = $request->input('jumlah_stok');
        $kategori = $request->input('kategori');
        $hargaJual = $request->input('harga_jual');
        $hargaBeli = $request->input('harga_beli');

        DB::table('master_beras')
        ->where('id', $id)
        ->update([
            'kode_beras' => $kodeBeras,
            'nama_beras' => $namaBeras,
            'jumlah_stok' => $jumlahStok,
            'kategori' => $kategori,
            'harga_jual' => $hargaJual,
            'harga_beli' => $hargaBeli,
            'created_at' => now()

        ]);

        return redirect()->route('home-stok-beras')->with('editmaster', 'Berhasil Mengedit Data Master');

    }

    public function delete($id) 
    {
        DB::table('master_beras')
            ->where('id', $id)
            ->delete();

        return redirect()->route('home-stok-beras')->with('deletemaster', 'Berhasil Menghapus Data Master');
    }
}
