<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WeightController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $user = auth()->user();
        $data = [
            'weight' => $user->weight,
            'height' => $user->height,
            'ideal_weight' => $user->ideal_weight
        ];

        return view('weight.index')->with($data);
    }


    public function store(Request $request)
    {


        $validation_rules = 'required|integer|min:0';

        $this->validate(
            $request,
            [
                'weight' => $validation_rules,
                'height' => $validation_rules,
                'ideal_weight' => $validation_rules
            ],
            [
                'weight.required' => 'Digite un valor',
                'height.required'  => 'Digite un valor',
                'ideal_weight.required' => 'Digite un valor'
            ]
        );

        $data = $request->only(
            [
                'weight',
                'height',
                'ideal_weight'
            ]
        );

        $user = auth()->user();

        $user->update($data);

        return redirect()->route('home');
    }
}
