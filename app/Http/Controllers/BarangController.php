<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\History;
use App\Models\Kategori;
use App\Models\Price;
use App\Models\StockBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BarangController extends Controller
{
    public function index(){
        $barangs = Barang::with('kategori')->withSum('stock', 'jumlah')->get();
        $kategoris = Kategori::all();
        $hargas = Price::all();
        return view('superadmin.barang.index', compact('barangs', 'kategoris', 'hargas'));
    }
    public function create(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'berat' => 'required|integer',
            'kategori_id' => 'required|integer',
            'jumlah' => 'required|integer',
            'harga_id' => 'required|integer',
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
                'berat' => $validator->validate()['berat'],
                'harga_id' => $validator->validate()['harga_id'],
            ]);
            if ($save_barang) {
                $save_stock_barang = StockBarang::create([
                    'barang_id' => $save_barang->id,
                    'jumlah' => $validator->validate()['jumlah'],
                ]);
                if ($save_stock_barang){
                    $save_history = History::create([
                        'barang_id' => $save_barang->id,
                        'status' => 'add',
                        'jumlah' => $validator->validated()['jumlah'],
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
                'sub' => $err->getMessage(),
            ]));
        }
    }
    public function addStock(Request $request){
        $validator = Validator::make($request->all(), [
            'barang_id' => 'required|integer',
            'jumlah' => 'required|integer',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('notiv', json_encode([
                'status' => 'error',
                'header' => 'Gagal menambah stock barang',
                'sub' => 'Silahkan cek semua field sudah di isi dengan benar',
            ]));
        }
        try {
            $add = StockBarang::create($validator->validated());
            if ($add) {
                // Menyimpan history
                $save_hitory = History::create([
                    'barang_id' => $validator->validated()['barang_id'],
                    'jumlah' => $validator->validated()['jumlah'],
                    'status' => 'add'
                ]);
                if ($save_hitory) {
                    return redirect()->back()->with('notiv', json_encode([
                        'status' => 'success',
                        'header' => 'berhasil menambah stock barang',
                        'sub' => 'berhasil menambah stock barang'
                    ]));
                } else {
                    return redirect()->back()->with('notiv', json_encode([
                        'status' => 'error',
                        'header' => 'Gagal menambah stock barang',
                        'sub' => 'gagal saat menyimpan history'
                    ]));
                }

            } else {
                return redirect()->back()->with('notiv', json_encode([
                    'status' => 'error',
                    'header' => 'Gagal menambah stock barang',
                    'sub' => 'gagal saat menyimpan stock'
                ]));
            }
        } catch (\Exception $err){
            return redirect()->back()->with('notiv', json_encode([
                'status' => 'error',
                'header' => 'Gagal menambah stock barang',
                'sub' => $err->getMessage(),
            ]));
        }
    }
    // for view
    public function show($id){
        $barang = Barang::where('id', $id)->with('kategori')->withSum('stock', 'jumlah')->with('stock')->with('harga')->first();
        $stocks = StockBarang::where('barang_id', $id)->orderBy('created_at', 'desc')->get();
        return view('superadmin.barang.show', compact('barang', 'stocks'));
    }
    public function history($id){
        $barang = Barang::where('id', $id)->with('kategori')->withSum('stock', 'jumlah')->with('stock')->with('harga')->first();
        $historys = History::where('barang_id', $id)->orderBy('created_at', 'desc')->get();
        return view('superadmin.barang.history', compact('barang', 'historys'));
    }
    public function stockOut(Request $request){
        $validator = Validator::make($request->all(), [
            'barang_id' => 'required|integer',
            'jumlah' => 'required|integer',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('notiv', json_encode([
                'status' => 'error',
                'header' => 'Gagal mengeluarkan barang',
                'sub' => 'Silahkan cek semua field sudah di isi dengan benar',
            ]));
        }
        try {
            // get stock needed
            $all_stock = StockBarang::where('barang_id', $validator->validated()['barang_id'])->orderBy('created_at', 'desc')->get();
            $ids_stock = [];
            $temp_jumlah = $validator->validated()['jumlah'];
            foreach ($all_stock as $stock){
                if ($temp_jumlah <= 0){
                    break;
                } else {
                    if ($temp_jumlah >= $stock->jumlah){
                        $temp_jumlah = $temp_jumlah - $stock->jumlah;
                        StockBarang::where('id', $stock->id)->delete();
                    } else {
                        StockBarang::find($stock->id)->update([
                            'jumlah' => $stock->jumlah - $temp_jumlah
                        ]);
                        break;
                    }
                }
            }
            $save_hitory = History::create([
                'barang_id' => $validator->validated()['barang_id'],
                'jumlah' => $validator->validated()['jumlah'],
                'status' => 'out'
            ]);


            return redirect()->back()->with('notiv', json_encode([
                'status' => 'success',
                'header' => 'Berhasil mengeluarkan barang',
                'sub' => 'Selamat anda berhasil mengeluarkan barang',
            ]));
        } catch (\Exception $err){
            return redirect()->back()->with('notiv', json_encode([
                'status' => 'error',
                'header' => 'Gagal mengeluarkan barang',
                'sub' => $err->getMessage(),
            ]));
        }
    }

}
