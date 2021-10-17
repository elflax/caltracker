<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMealsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meals', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('food_id')->constrained('food');
            $table->foreignId('meal_type_id')->constrained('meal_types');
            $table->date('date');
            $table->integer('how_much_ate')->nullable();
            $table->primary(['user_id', 'food_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meals');
    }
}
