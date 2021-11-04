<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\MealType;


class MealTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $descriptions = ['Desayuno', 'Almuerzo', 'Merienda', 'Cena'];

        foreach ($descriptions as $descripion) {
            MealType::create([
                'description' => $descripion
            ]);
        }

    }
}
