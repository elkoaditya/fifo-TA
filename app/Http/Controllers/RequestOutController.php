<?php

namespace App\Http\Controllers;

use App\Models\RequestOut;
use Illuminate\Http\Request;

class RequestOutController extends Controller
{
    public function index(Request $request){

        if (count($request->query()) == 0) {
            $requestOuts = RequestOut::where('status', 'pending')->get();
        } else {
            if ($request->query()['filter'] == 'pending') {
                $requestOuts = RequestOut::where('status', 'pending')->get();
            } else if ($request->query()['filter'] == 'deleted') {
                $requestOuts = RequestOut::where('status', 'deleted')->get();
            } else if ($request->query()['filter'] == 'aproved') {
                $requestOuts = RequestOut::where('status', 'filter')->get();
            } else {
                dd('eh ada kecurangan nih');
            }
        }

        return view('master.request.index', compact('requestOuts'));
    }
}
