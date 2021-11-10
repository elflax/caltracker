<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRutineRequest extends FormRequest
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
            'exercise_id' => 'required|integer|min:1',
            'how_much_play' => 'required|integer|min:1',
            'date' => 'required|date_format:Y-m-d'
        ];
    }

    public function messages()
    {
        return [
            'user_id.required' => 'User_id es requerido',
            'user_id.integer' => 'User_id debe ser un numero entero',
            'user_id.min' => 'User_id debe ser mayor a 0',
            'exercise_id.required' => 'exercise_id es requerido',
            'exercise_id.integer' => 'exercise_id debe ser un numero entero',
            'exercise_id.min' => 'exercise_id debe ser mayor a 0',
            'date.required' => 'La fecha es requerido',
            'date.date_format' => 'La fecha debe ser del formato Y-m-d',
            'how_much_play.required' => 'El valor es requerido',
            'how_much_play.integer' => 'El valor debe ser un numero entero',
            'how_much_play.min' => 'El valor debe ser mayor a 0',
        ];
    }
}
