<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Riwayat;

class RiwayatController extends Controller
{
    public function show(Request $request){
       $data = Riwayat::whereYear('tanggal', $request->tahun)->whereMonth('tanggal', $request->bulan)->first();
      
       return view('riwayat.index', compact('data', $data));
    }

    public function index()
    {
        return view('riwayat.index');
    }
}
