<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KategoriController extends Controller
{
    public function index(){
        $kategoris = Kategori::all();

        return view('superadmin.kategori.index', compact('kategoris'));
    }
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'description' => 'required|string',
            'code' => 'required|string',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('notiv', json_encode([
                'status' => 'error',
                'header' => 'Gagal menyimpan kategori',
                'sub' => 'Silahkan cek semua field sudah di isi dengan benar',
            ]));
        }
        try {
            $save = Kategori::create([
                'name' => $request->name,
                'description' => $request->description,
                'code' => $request->code,
            ]);
            if ($save){
                return redirect()->back()->with('notiv', json_encode([
                    'status' => 'success',
                    'header' => 'Berhasil menyimpan kategori',
                    'sub' => 'Kategori baru berhasil disimpan',
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
    public function delete($id){
        $delete = Kategori::where('id', $id)->forceDelete();
        if ($delete) {
            return redirect()->back()->with('notiv', json_encode([
                'status' => 'success',
                'header' => 'Berhasil menghapus kategori',
                'sub' => 'Kategori berhasil dihapus',
            ]));
        }
    }
}
