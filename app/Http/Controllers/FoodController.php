<?php

namespace App\Http\Controllers;
use App\Http\Requests\FoodRequest;
use App\Models\Food;

use DeprecationTests\Foo;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('food.index')->with('foods', Food::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('food.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FoodRequest $request)
    {
        Food::create($request->all());
        return redirect(route('food.index'))->with('result', 'Comida creada exitosamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Food::getById($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('food.create')->with('food', Food::find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FoodRequest $request, $id)
    {
        $data = $request->only([
            "name",
            "calories",
            "unit_of_measure",
            "minimun_value",
        ]);
        Food::where('id', $id)->update($data);
        return redirect(route('food.index'))->with('result', 'Comida actualizada exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Food::find($id)->delete();
        return redirect(route('food.index'))->with('result', 'Comida eliminada exitosamente');
    }
}
