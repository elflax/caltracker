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
}
