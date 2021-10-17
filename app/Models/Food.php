<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'calories',
        'unit_of_measure',
        'minimun_value',
    ];

    public function meals(){
        return $this->hasMany(Meal::class);
    }
}
