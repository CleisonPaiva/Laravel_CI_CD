<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ModuleRequest extends FormRequest
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
            'name' => ['required', 'min:3', 'max:255'],
            'course' => ['required', 'exists:courses,uuid'],
        ];
    }

    public function messages(  )
    {
        return [
            'course.required'=>'O nome do Curso não foi informado.',
            'name.required'=>'O nome do Modulo do Curso e de preenchimento obrigatorio.',
            'name.min'=>'O nome do Curso deve ter pelo menos 3 caracteres.',
            'name.max'=>'O nome do Curso deve ter no maximo 255 caracteres.',

        ];
    }
}
