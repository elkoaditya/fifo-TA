<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthRole
{

    public function handle(Request $request, Closure $next, ...$role)
    {
        if(auth()->user() != null){
            if(in_array($request->user()->role,$role)){
                return $next($request);
            }
        }else{
            return redirect('/')->with('alert', json_encode([
                'status' => 'warning',
                'message' => 'Silahkan Login kembali'
            ]));
        }
        return redirect()->back()->with('alert', json_encode([
            'status' => 'warning',
            'message' => 'Anda Tidak memiliki akses kesini'
        ]));
    }
}
