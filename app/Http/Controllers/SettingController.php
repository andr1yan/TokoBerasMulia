<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{
    public function index()
    {
        $setting = DB::table('setting')
            ->select("nama_toko", "email", "no_telp", "fax", "alamat")
            ->first();
        return view('admin.index', ["s" => $setting]);
    }

    public function update(Request $request) 
    {
        $namaToko = $request->input('nama_toko');
        $email = $request->input('email');
        $noTelp = $request->input('no_telp');
        $fax = $request->input('fax');
        $alamat = $request->input('alamat');

        DB::table('setting')
        ->update([
            'nama_toko' => $namaToko,
            'email' => $email,
            'no_telp' => $noTelp,
            'fax' => $fax,
            'alamat' => $alamat,

        ]);

        return redirect()->route('setting')->with('updatesetting', 'Berhasil Mengupdate Data Faktur');

    }
}
