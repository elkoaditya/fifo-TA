<?php

namespace App\Http\Controllers;

use App\Models\HistoryLogin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Env;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Jenssegers\Agent\Agent;

class UserLoginController extends Controller
{
    /**
     * Untuk Melakukan Login User
     *
     * Algoritma untuk Login
     * -- md5(Env::get('HASH', 'null').md5('Justomat1').md5(Env::get('HASH2', 'null'))) --
     */
    public function Login(Request $request){
        $validator = Validator::make($request->all(), [
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $agent = new Agent();

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        try {
            $user = User::where([
                'username' => $validator->validated()['username'],
                'password' => md5(Env::get('HASH', 'null').md5($validator->validated()['password']).md5(Env::get('HASH2', 'null')))
            ])->first();
            if ($user){
                Auth::loginUsingId($user->id);
                if (Auth::user()->role == 'superadmin'){

                    $his = HistoryLogin::create([
                        'browser' => $agent->browser(),
                        'platform' => $agent->platform(),
                        'v_platform' => $agent->version( $agent->platform()),
                        'username' => Auth::user()->username,
                    ]);

                    return redirect('/superadmin/home')->with('notiv', json_encode([
                        'status' => 'success',
                        'header' => 'Success Login !',
                        'sub' => 'Selamat datang '.Auth::user()->name,
                    ]));
                } else if (Auth::user()->role = 'admin'){
                    dd('admin');
                } else {
                    dd('Oh Snapp');
                }
            } else {
                return redirect()->back()->with('alert', json_encode([
                    'status' => 'error',
                    'message' => 'Username atau Password anda salah',
                ]));
            }
        } catch (\Exception $err){
            dd($err);
        }
    }
    public function RegisterUser(){

    }
    public function AdminRegister(){
        try {
            $user = User::create([
                'username' => 'admin',
                'password' => md5(Env::get('HASH', 'null').md5('Justomat1').md5(Env::get('HASH2', 'null'))),
                'role' => 'superadmin',
                'name' => 'Elko Aditya'
            ]);
        } catch (\Exception $err){
            return response()->json([
                'message' => 'Error Menambah data superadmin',
                'error' => $err,
            ]);
        }
    }
    public function Logout(){
        try {
            Auth::logout();
            return redirect('/')->with('alert', json_encode([
                'status' => 'success',
                'message' => 'Log Out Berhasil!'
            ]));
        } catch (\Exception $err){
            return response()->json([
                'message' => 'Error Saat melakukan Logout',
                'error' => $err,
            ]);
        }
    }
}
