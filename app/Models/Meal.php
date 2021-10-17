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
}
