<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(){
        $barangs = Barang::with('kategori')->withSum('stock', 'jumlah')->with('harga')->get();
        return view('superadmin.laporan.index', compact('barangs'));
    }
}
