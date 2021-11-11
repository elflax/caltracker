<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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

    public function scopeByDate($query, $date)
    {
        return $query->where('user_id', Auth::id())
                    ->whereDate('date', \Carbon\Carbon::createFromFormat('m-d-Y', $date)
                    ->format('Y-m-d'));
    }
}
