<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\History;
use App\Models\StockBarang;
use Illuminate\Http\Request;

class StafController extends Controller
{
    public function index(){
        $barangs = Barang::with('kategori')->withSum('stock', 'jumlah')->with('stock')->with('harga')->get();
        $total['masuk'] = History::where('status', 'add')->get()->count();
        $total['keluar'] = History::where('status', 'out')->get()->count();
        $total['all'] = StockBarang::get()->sum('jumlah');

        return view('master.home.index', compact('barangs', 'total'));
    }
}
