<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Meal;
use App\Models\Food;
use App\Models\MealType;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(!auth()->user()->is_set_up_complete())
        {
            return redirect()->route('weights.index');
        }
        date_default_timezone_set('UTC');
        date_default_timezone_set("America/Mexico_City");
        $date = date('Y-m-d');
        $datacakeexists=0;
        $desayunos=DB::table('Food')
        ->join('meals', 'Food.id', '=', 'Meals.food_id')
        ->where('meals.user_id', auth()->user()->id)
        ->where('meals.date', $date)
        ->where('meals.meal_type_id', '1')
        ->sum('Food.calories');
        $almuerzos=DB::table('Food')
        ->join('meals', 'Food.id', '=', 'Meals.food_id')
        ->where('meals.user_id', auth()->user()->id)
        ->where('meals.date', $date)
        ->where('meals.meal_type_id', '2')
        ->sum('Food.calories');
        $cenas=DB::table('Food')
        ->join('meals', 'Food.id', '=', 'Meals.food_id')
        ->where('meals.user_id', auth()->user()->id)
        ->where('meals.date', $date)
        ->where('meals.meal_type_id', '3')
        ->sum('Food.calories');
        $snacks=DB::table('Food')
        ->join('meals', 'Food.id', '=', 'Meals.food_id')
        ->where('meals.user_id', auth()->user()->id)
        ->where('meals.date', $date)
        ->where('meals.meal_type_id', '4')
        ->sum('Food.calories');
        if($snacks!=0 || $desayunos!=0 ||$almuerzos!=0 ||$cenas!=0 )
        {
            $datacakeexists=1;
        }
        $weekDays = array(
        date("Y-m-d",strtotime($date."- 6 days")), 
        date("Y-m-d",strtotime($date."- 5 days")), 
        date("Y-m-d",strtotime($date."- 4 days")),
        date("Y-m-d",strtotime($date."- 3 days")), 
        date("Y-m-d",strtotime($date."- 2 days")), 
        date("Y-m-d",strtotime($date."- 1 days")), 
        date("Y-m-d"));  
        
        $caloriesxday= array(
            DB::table('Food')->join('meals', 'Food.id', '=', 'Meals.food_id')->where('meals.user_id', auth()->user()->id)->where('meals.date', $weekDays[0])->sum('Food.calories'),
            DB::table('Food')->join('meals', 'Food.id', '=', 'Meals.food_id')->where('meals.user_id', auth()->user()->id)->where('meals.date', $weekDays[1])->sum('Food.calories'),
            DB::table('Food')->join('meals', 'Food.id', '=', 'Meals.food_id')->where('meals.user_id', auth()->user()->id)->where('meals.date', $weekDays[2])->sum('Food.calories'),
            DB::table('Food')->join('meals', 'Food.id', '=', 'Meals.food_id')->where('meals.user_id', auth()->user()->id)->where('meals.date', $weekDays[3])->sum('Food.calories'),
            DB::table('Food')->join('meals', 'Food.id', '=', 'Meals.food_id')->where('meals.user_id', auth()->user()->id)->where('meals.date', $weekDays[4])->sum('Food.calories'),
            DB::table('Food')->join('meals', 'Food.id', '=', 'Meals.food_id')->where('meals.user_id', auth()->user()->id)->where('meals.date', $weekDays[5])->sum('Food.calories'),
            DB::table('Food')->join('meals', 'Food.id', '=', 'Meals.food_id')->where('meals.user_id', auth()->user()->id)->where('meals.date', $weekDays[6])->sum('Food.calories')
        );
        $databarexists = 0;
        foreach($caloriesxday as $cal)
        {
            if($cal != 0)
            {$databarexists = 1;}
        }

        $to = date("Y-m-d"); 
        $from = date("Y-m-d",strtotime($to."- 6 days"));
        $foodRanking=DB::table('Food')
        ->join('Meals', 'Food.id', '=', 'Meals.food_id')    
        ->where('meals.user_id', auth()->user()->id)    
        ->whereBetween('Meals.date', [new Carbon($from), new Carbon($to)])
        ->groupby('Food.name')
        ->where('Food.calories','>','0')
        ->selectRaw('sum(Food.calories) as amount, Food.name')     
        ->orderby('amount','DESC')
        ->take(5)
        ->get();

        $totalCaloriesWeek=DB::table('Food')
        ->join('Meals', 'Food.id', '=', 'Meals.food_id')            
        ->where('meals.user_id', auth()->user()->id)         
        ->whereBetween('Meals.date', [new Carbon($from), new Carbon($to)])
        ->sum('Food.calories');


        return view('home')
        ->with('desayunos', $desayunos)
        ->with('almuerzos', $almuerzos)
        ->with('cenas', $cenas)
        ->with('snacks', $snacks)
        ->with('datacakeexists', $datacakeexists)
        ->with('databarexists', $databarexists)
        ->with('caloriesxday', $caloriesxday)
        ->with('foodRanking',$foodRanking)
        ->with('totalCaloriesWeek', $totalCaloriesWeek)
        ->with('date',$date);
    }

    

}
