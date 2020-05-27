<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OwnerRequest extends FormRequest
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
            'name' => 'required|string',
            'email' => 'required|string|email',
            'phone' => 'required',
            'logo' => 'mimes:png',
            'slider_1' => 'mimes:jpg,jpeg'
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
            'email.required' => 'El email es requerido.',
            'email.string' => 'El email no tiene el formato correcto.',
            'email.email' => 'El email no tiene el formato correcto.',
            'phone.required' => 'El teléfono es requerido.',
            'logo.required' => 'El logo es requerido.',
            'logo.mimes' => 'El logo debe ser formato .png',
            'slider_1.required' => 'El slider 1 es requerido.',
            'slider_1.mimes' => 'El slider 1 debe ser formato .jpg o .jpeg'
        ];
    }
}
