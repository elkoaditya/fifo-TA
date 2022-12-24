<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\History;
use App\Models\Kategori;
use App\Models\StockBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BarangController extends Controller
{
    public function index(){
        $barangs = Barang::with('kategori')->withSum('stock', 'jumlah')->get();
        $kategoris = Kategori::all();
        return view('superadmin.barang.index', compact('barangs', 'kategoris'));
    }
    public function create(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'harga' => 'required|integer',
            'kategori_id' => 'required|integer',
            'jumlah' => 'required|integer',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('notiv', json_encode([
                'status' => 'error',
                'header' => 'Gagal menyimpan kategori',
                'sub' => 'Silahkan cek semua field sudah di isi dengan benar',
            ]));
        }
        try {
            // Create Barang
            $save_barang = Barang::create([
                'kategori_id' => $validator->validate()['kategori_id'],
                'name' => $validator->validate()['name'],
                'harga' => $validator->validate()['harga'],
            ]);
            if ($save_barang) {
                $save_stock_barang = StockBarang::create([
                    'barang_id' => $save_barang->id,
                    'jumlah' => $validator->validate()['jumlah'],
                ]);
                if ($save_stock_barang){
                    $save_history = History::create([
                        'barang_id' => $save_barang->id,
                        'status' => 'add'
                    ]);
                    if ($save_history){
                        return redirect()->back()->with('notiv', json_encode([
                            'status' => 'sucess',
                            'header' => 'berhasil menambah barang',
                            'sub' => 'Barang yang anda masukan berhasil di simpan',
                        ]));
                    } else {
                        return redirect()->back()->with('notiv', json_encode([
                            'status' => 'error',
                            'header' => 'Gagal saat menyimpan',
                            'sub' => 'Silahkan hubungi administrator',
                        ]));
                    }
                } else {
                    return redirect()->back()->with('notiv', json_encode([
                        'status' => 'error',
                        'header' => 'Gagal saat menambah stock',
                        'sub' => 'Silahkan hubungi administrator',
                    ]));
                }
            } else {
                return redirect()->back()->with('notiv', json_encode([
                    'status' => 'error',
                    'header' => 'Gagal saat menyimpan barang',
                    'sub' => 'Silahkan hubungi administrator',
                ]));
            }
        } catch (\Exception $err){
            return redirect()->back()->with('notiv', json_encode([
                'status' => 'error',
                'header' => 'Gagal menyimpan barang',
                'sub' => 'Silahkan hubungi administrator',
            ]));
        }
    }
    public function show($id){
        $barang = Barang::where('id', $id)->with('kategori')->withSum('stock', 'jumlah')->with('stock')->first();
        return view('superadmin.barang.show', compact('barang'));
    }
}
