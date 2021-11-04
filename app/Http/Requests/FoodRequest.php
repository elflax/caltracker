<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FoodRequest extends FormRequest
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
            'name' => 'required|regex:/^[a-zA-Z ]+$/u',
            'calories' => 'required|integer|min:1',
            'unit_of_measure' => 'required|regex:/^[a-zA-Z ]+$/u|size:2',
            'minimun_value' => 'required|integer|min:1',
        ];
    }

    public function messages(){
        return [
            'name.required' => 'El nombre es requerido',
            'name.regex' => 'El nombre solo puede tener letras',
            'calories.required' => 'Las calorias son requeridas',
            'calories.integer' => 'Las calorias solo pueden ser un numero entero',
            'calories.min' => 'Las calorias deben ser mayores a 0',
            'unit_of_measure.required' => 'La unidad de medida es requerida',
            'unit_of_measure.regex' => 'La unidad de medida solo pueden tener letras',
            'unit_of_measure.size' => 'La unidad de medida deben tener un tamaño de 2 letras',
            'minimun_value.required' => 'El valor minimo es requerido',
            'minimun_value.integer' => 'El valor minimo debe ser un numero entero',
            'minimun_value.min' => 'El valor minimo debe ser mayor a 0',
        ];
    }
}
