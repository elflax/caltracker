<?php

namespace App\Http\Controllers\US6;

use Illuminate\Http\Request;
use App\Models\User;
use App\AccountSettings;
use Auth;
use Input;
use App\Http\Controllers\Controller;

class WeightController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }
    

    public function save(Request $request){

        auth()->user()->weight = $request->input('inputweight');
        auth()->user()->height = $request->input('inputheight');
        auth()->user()->ideal_weight = $request->input('inputDreamWeight');
        auth()->user()->save();
        return view('home');
    



    }


}
