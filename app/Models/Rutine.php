<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rutine extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'exercise_id',
        'how_much_play',
        'date',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function exercise(){
        return $this->belongsTo(Exercise::class, 'exercise_id');
    }
}
