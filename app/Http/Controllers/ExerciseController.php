<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use Illuminate\Http\Request;
use App\Http\Requests\ExerciseRequest;

class ExerciseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('exercise.index')->with('exercises', Exercise::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('exercise.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExerciseRequest $request)
    {
        Exercise::create($request->all());
        return redirect(route('exercise.index'))->with('result', 'Ejercicio creado exitosamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Exercise  $exercise
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Exercise::getById($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Exercise  $exercise
     * @return \Illuminate\Http\Response
     */
    public function edit(Exercise $exercise)
    {
        return view('exercise.create')->with('exercise', $exercise);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Exercise  $exercise
     * @return \Illuminate\Http\Response
     */
    public function update(ExerciseRequest $request, Exercise $exercise)
    {
        $data = $request->only([
            'name',
            'calories_waste',
            'unit_of_measure',
            'minimun_value'
        ]);

        $exercise->update($data);
        return redirect(route('exercise.index'))->with('result', 'Ejercicio actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Exercise  $exercise
     * @return \Illuminate\Http\Response
     */
    public function destroy(Exercise $exercise)
    {
        $exercise->delete();
        return redirect(route('exercise.index'))->with('result', 'Ejercicio actualizado exitosamente');
    }
}
