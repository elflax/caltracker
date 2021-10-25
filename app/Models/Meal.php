<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'food_id',
        'meal_type_id',
        'date',
        'how_much_ate',
    ];

    public function users(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function food(){
        return $this->belongsTo(Food::class, 'food_id');
    }

    public function meal_type(){
        return $this->belongsTo(MealType::class, 'meal_type_id');
    }

    public static function create($request){
        $meal = new Meal;
        $meal->user_id = $request->user_id;
        $meal->food_id = $request->food_id;
        $meal->meal_type_id = $request->meal_type_id;
        $meal->date = $request->date;
        $meal->how_much_ate = $request->how_much_ate;
        $meal->save();

        return ['food' => $meal->food->name, 'how_much_ate' => $meal->how_much_ate, 'calories' => ($meal->how_much_ate * $meal->food->calories ) / $meal->food->minimun_value];
    }

    public static function getByDate($date){
        return Meal::whereDate('date', $date)->get();
    }

    public static function del($id){
        $ids = explode('_', $id);
        Meal::where('user_id', $ids[0])
            ->where('food_id', $ids[1])
            ->where('meal_type_id', $ids[2])
            ->where('date', $ids[3])
            ->delete();
        return ['done' => 1];
    }
}
