<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoriesRequest extends FormRequest
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
            'name' => 'required',
            'description' => 'required|string',
            'measure' => 'required|present|array|size:1',
            'unit_id' => 'required'
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'El nombre es requerido.',
            'description.required' => 'La descripción es requerida.',
            'description.string' => 'La descripción no tiene un formato válido.',
            'measure.required' => 'La medida es requerida.',
            'unit_id.required' => 'La unidad es requerida.',
            'measure.present' => 'Las medidas son requeridas.',
            'measure.array' => 'Las medidas no tienen un formato válido.',
            'measure.size' => 'Debe indicar al menos una medida.'
        ];
    }
}
