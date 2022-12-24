<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Env;
use Illuminate\Support\Facades\Validator;

class ManagementUsersController extends Controller
{
    public function index(){
        $users = User::all();
        return view('superadmin.management-users.index', compact('users'));
    }
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'username' => 'required|string',
            'role' => 'required|string',
            'password' => 'required|string',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('notiv', json_encode([
                'status' => 'error',
                'header' => 'Gagal menyimpan user',
                'sub' => 'Silahkan cek semua field sudah di isi dengan benar',
            ]));
        }
        try {
            $save = User::create([
                'name' => $request->name,
                'username' => $request->username,
                'role' => $request->role,
                'password' => md5(Env::get('HASH', 'null').md5($validator->validated()['password']).md5(Env::get('HASH2', 'null')))
            ]);
            if ($save){
                // create profile
                $save_profile = UserProfile::create([
                    'id_user' => $save->id,
                ]);
                return redirect()->back()->with('notiv', json_encode([
                    'status' => 'success',
                    'header' => 'Berhasil menyimpan user',
                    'sub' => 'User baru berhasil disimpan',
                ]));
            }
        } catch (\Exception $err){
            return redirect()->back()->with('notiv', json_encode([
                'status' => 'error',
                'header' => 'Gagal menyimpan user',
                'sub' => $err->getMessage(),
            ]));
        }
    }
    public function delete($id){
        $delete = User::where('id', $id)->delete();
        if ($delete) {
            $delete_profile = UserProfile::where('id_user', $id)->delete();
            return true;
        }else{
            return false;
        }
    }
}
