<?php

namespace App\Http\Controllers;

use App\Models\HistoryLogin;
use App\Models\User;
use App\Models\UserProfile;
use App\Models\UserSetting;
use Illuminate\Support\Env;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function Setting(){
        $user = \App\Models\User::where('id', Auth::id())
            ->with('detail')
            ->first();
        return view('user/setting', compact('user'));
    }
    public function SaveSetting(Request $request){
        $validator = Validator::make($request->all(), [
            'alamat' => 'string',
            'nowa' => 'string',
            'email' => 'string',
            'about' => 'string',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('notiv', json_encode([
                'status' => 'error',
                'header' => 'Gagal menyimpan profile user',
                'sub' => 'Silahkan cek semua field sudah di isi dengan benar',
            ]));
        }
        try {
            $user = User::where('id', Auth::id())->update([
                'username' => $request->username,
                'name' => $request->name,
            ]);
            $profile = UserProfile::where('id_user', Auth::id())->update([
                'alamat' => $request->alamat,
                'nowa' => $request->nowa,
                'email' => $request->email,
                'about' => $request->about,
            ]);
            if ($user && $profile){
                return redirect()->back()->with('notiv', json_encode([
                    'status' => 'success',
                    'header' => 'Berhasil menyimpan',
                    'sub' => 'Berhasil menyimpan profile user!',
                ]));
            }
        } catch (\Exception $err){
            dd($err);
        }
    }
    public function ChangePass(Request $request){
        $validator = Validator::make($request->all(), [
            'oldpassword' => 'required|string|min:6',
            'password' => 'required|confirmed|min:6',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('notiv', json_encode([
                'status' => 'danger',
                'header' => 'Gagal menyimpan profile user',
                'sub' => 'Silahkan cek semua field sudah di isi dengan benar',
            ]));
        }
        try {
            $user = User::where('id', Auth::id())->where('password', md5(Env::get('HASH', 'null').md5($validator->validated()['oldpassword']).md5(Env::get('HASH2', 'null'))))->first();
            if (!$user){
                return redirect()->back()->with('notiv', json_encode([
                    'status' => 'error',
                    'header' => 'Gagal menyimpan password',
                    'sub' => 'Masukan password sebelumnya dengan benar !',
                ]));
            }
            $change = User::where('id', Auth::id())->update([
                'password' => md5(Env::get('HASH', 'null').md5($validator->validated()['password']).md5(Env::get('HASH2', 'null')))
            ]);
            if ($change){
                return redirect()->back()->with('notiv', json_encode([
                    'status' => 'success',
                    'header' => 'Succes mengganti password [ ',
                    'sub' => 'Harap simpan password anda, ini password baru Anda [ '.$request->password.' ]',
                ]));
            }
        } catch (\Exception $err){
            dd($err);
        }
    }
    public function ListOwner(){
        $users = User::where('role', 'owner')->with('setting')->get()->toJson();
        return view('Superadmin.Users.listowner', compact('users'));
    }
    public function CrateOwner(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'username' => 'required|string',
            'password' => 'required|confirmed|min:6',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('notiv', json_encode([
                'status' => 'danger',
                'header' => 'Gagal membikin user Owner',
                'sub' => 'Silahkan cek semua field sudah di isi dengan benar',
            ]));
        }
        try {
            $user = User::create([
                'name' => $validator->validate()['name'],
                'username' => $validator->validate()['username'],
                'role' => 'owner',
                'password' => md5(Env::get('HASH', 'null').md5($validator->validated()['password']).md5(Env::get('HASH2', 'null'))),
            ]);
            if ($user){
                $user_profile = UserProfile::create([
                    'id_user' => $user->id
                ]);
                if ($user_profile){
                    $user_setting = UserSetting::create([
                        'id_user' => $user->id,
                        'status' => 'pending',
                    ]);
                    if ($user_setting){
                        return redirect()->back()->with('notiv', json_encode([
                            'status' => 'success',
                            'header' => 'Berhasil membikin user owner',
                            'sub' => $user->name. ' Bewrhasil di tambahkan, username : '. $user->username.'password : '.$validator->validate()['password'],
                        ]));
                    } else {
                        return redirect()->back()->with('notiv', json_encode([
                            'status' => 'danger',
                            'header' => 'Gagal membikin user Owner',
                            'sub' => 'Silahkan cek semua field sudah di isi dengan benar',
                        ]));
                    }
                } else {
                    return redirect()->back()->with('notiv', json_encode([
                        'status' => 'danger',
                        'header' => 'Gagal membikin user Owner',
                        'sub' => 'Silahkan cek semua field sudah di isi dengan benar',
                    ]));
                }
            } else {
                return redirect()->back()->with('notiv', json_encode([
                    'status' => 'danger',
                    'header' => 'Gagal membikin user Owner',
                    'sub' => 'Silahkan cek semua field sudah di isi dengan benar',
                ]));
            }
        } catch (\Exception $err){
            dd($err);
        }
    }
    public function SettingPassword(){
        $historys = HistoryLogin::where('username', Auth::user()->username)->orderBy('created_at', 'DESC')->take(5)->get();
        return view('user/settingpassword', compact('historys'));
    }
}
