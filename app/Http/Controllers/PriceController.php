<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Price;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PriceController extends Controller
{
    public function index(){
        $prices = Price::get();
        return view('superadmin.price.index', compact('prices'));
    }
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'price' => 'required|integer',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('notiv', json_encode([
                'status' => 'error',
                'header' => 'Gagal menyimpan price',
                'sub' => 'Silahkan cek semua field sudah di isi dengan benar',
            ]));
        }
        try {
            $save = Price::create($validator->validated());
            if ($save) {
                return redirect()->back()->with('notiv', json_encode([
                    'status' => 'success',
                    'header' => 'Berhasl menyimpan price',
                    'sub' => 'Selamat data anda berhasil di simpan',
                ]));
            }
        } catch (\Exception $err){
            return redirect()->back()->with('notiv', json_encode([
                'status' => 'error',
                'header' => 'Gagal menyimpan kategori',
                'sub' => $err->getMessage(),
            ]));
        }
    }
    public function update(Request $request){

    }
}
