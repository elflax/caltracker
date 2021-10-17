<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'calories_waste',
        'unit_of_measure',
        'minimun_value',
    ];

    public function rutines(){
        return $this->hasMany(Rutine::class);
    }
}
