<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuperadminController extends Controller
{
    public function Home(){
        $user = User::where('id', Auth::id())->with('detail')->first()->toJson();
        return view('Superadmin.home', compact('user'));
    }
}
