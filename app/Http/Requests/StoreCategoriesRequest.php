<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoriesRequest extends FormRequest
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
            'name' => 'required|string|unique:categories,name',
            'file' => 'required|mimes:jpeg,jpg,png',
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
            'name.required' => 'EL nombre es requerido.',
            'name.unique' => 'Ya existe una categoria con ese nombre.',
            'name.string' => 'El nombre no tiene un formato válido.',
            'file.required' => 'El archivo de imagen es requerido.',
            'file.mimes' => 'El archivo debe estar en fomato .jpg o .png',
            'description.required' => 'La descripción es requerida.',
            'description.string' => 'La descripción no tiene un formato válido.',
            'measure.required' => 'La medida es requerida',
            'unit_id.required' => 'La unidad es requerida.',
            'measure.present' => 'Las medidas son requeridas.',
            'measure.array' => 'Las medidas no tienen un formato válido.',
            'measure.size' => 'Debe indicar al menos una medida.'
        ];
    }
}
