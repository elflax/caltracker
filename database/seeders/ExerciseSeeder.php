<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Exercise;

class ExerciseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Exercise::create([
            'name' => 'Caminar',
            'calories_waste' => 100,
            'unit_of_measure' => 'km',
            'minimun_value' => 1,
        ]);

        Exercise::create([
            'name' => 'Trotar',
            'calories_waste' => 300,
            'unit_of_measure' => 'minutos',
            'minimun_value' => 30,
        ]);

        Exercise::create([
            'name' => 'Correr',
            'calories_waste' => 400,
            'unit_of_measure' => 'minutos',
            'minimun_value' => 30,
        ]);
    }
}
