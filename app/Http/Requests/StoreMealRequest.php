<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMealRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_id' => 'required|integer|min:1',
            'food_id' => 'required|integer|min:1',
            'meal_type_id' => 'required|integer|min:1',
            'date' => 'required|date_format:Y-m-d',
            'how_much_ate' => 'required|integer|min:1',
        ];
    }

    public function messages()
    {
        return [
            'user_id.required' => 'User_id es requerido',
            'user_id.integer' => 'User_id debe ser un numero entero',
            'user_id.min' => 'User_id debe ser mayor a 0',
            'food_id.required' => 'food_id es requerido',
            'food_id.integer' => 'food_id debe ser un numero entero',
            'food_id.min' => 'food_id debe ser mayor a 0',
            'meal_type_id.required' => 'meal_type_id es requerido',
            'meal_type_id.integer' => 'meal_type_id debe ser un numero entero',
            'meal_type_id.min' => 'meal_type_id debe ser mayor a 0',
            'date.required' => 'La fecha es requerido',
            'date.date_format' => 'La fecha debe ser del formato Y-m-d',
            'how_much_ate.required' => 'El numero de raciones es requerido',
            'how_much_ate.integer' => 'El numero de raciones debe ser un numero entero',
            'how_much_ate.min' => 'El numero de raciones debe ser mayor a 0',
        ];
    }
}
