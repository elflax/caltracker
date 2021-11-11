<?php

namespace App\Http\Controllers;

use App\Models\Rutine;
use App\Models\Exercise;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRutineRequest;

class RutineController extends Controller
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
    public function index(Request $request)
    {
        $request->validate([
            'date' => 'date_format:m-d-Y'
        ]);
        if($request->has('date')){
            $date = $request->date;
        }else{
            $date = date('m-d-Y');
        }

        return view('rutine.index')
                ->with('exercises', Exercise::all())
                ->with('date', $date)
                ->with('rutines', Rutine::byDate($date)->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRutineRequest $request)
    {
        $data = $request->only([
            'user_id',
            'exercise_id',
            'how_much_play',
            'date',
        ]);

        $rutine = Rutine::create($data);

        return response()->json($this->default_response($rutine));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rutine  $rutine
     * @return \Illuminate\Http\Response
     */
    public function show(Rutine $rutine)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rutine  $rutine
     * @return \Illuminate\Http\Response
     */
    public function edit(Rutine $rutine)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rutine  $rutine
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rutine $rutine)
    {
        $data = $request->only([
            'user_id',
            'exercise_id',
            'how_much_play',
            'date',
        ]);

        $rutine->update($data);

        return response()->json($this->default_response($rutine));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rutine  $rutine
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rutine $rutine)
    {
        $rutine->delete();

        return response()->json(['done' => 1]);
    }

    private function default_response($rutine)
    {
        return [
            'id' => $rutine->id,
            'exercise_id' => $rutine->exercise->id,
            'exercise' => $rutine->exercise->name,
            'how_much_play' => $rutine->how_much_play,
            'calories' => ($rutine->how_much_play * $rutine->exercise->calories_waste ) / $rutine->exercise->minimun_value,
            'unit_of_measure' => $rutine->exercise->unit_of_measure
        ];
    }
}
