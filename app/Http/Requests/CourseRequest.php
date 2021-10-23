<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
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
        $uuid = $this->course ?? '';

        return [
            'name' => ['required', 'min:3', 'max:255', "unique:courses,name,{$uuid},uuid"],
            'description'=>['nullable', 'min:3','max:9999'],
        ];
    }
    public function messages()
    {
        return [
            'name.required'=>'O nome do Curso e de preenchimento obrigatorio',
            'name.min'=>'O nome do Curso deve ter pelo menos 3 caracteres',
            'name.max'=>'O nome do Curso deve ter no maximo 255 caracteres',
            'name.unique'=>'Já existe um curso cadastrado com esse nome',
            'description.min'=>'A descriçaõ do curso deve ter pelo menos 3 caracteres',
            'description.max'=>'A descriçaõ do curso ter no maximo menos 9999 caracteres',
        ];
    }
}
