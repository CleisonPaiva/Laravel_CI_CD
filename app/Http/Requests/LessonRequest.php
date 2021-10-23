<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LessonRequest extends FormRequest
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
        $uuid = $this->lesson ?? '';

        return [
            'module' => ['required', 'exists:modules,uuid'],
            'name' => ['required', 'min:3', 'max:255', "unique:lessons,name,{$uuid},uuid"],
            'video' => ['required', 'min:3', 'max:255', "unique:lessons,video,{$uuid},uuid"],
            'description' => ['nullable', 'min:3', 'max:9999'],
        ];
    }

    public function messages( )
    {
        return [
            'module.required'=>'O nome do Modulo do Curso não foi informado.',
            'name.required'=>'O nome da Aula do Modulo e de preenchimento obrigatorio.',
            'name.min'=>'O nome do Curso deve ter pelo menos 3 caracteres.',
            'name.max'=>'O nome do Curso deve ter no maximo 255 caracteres.',
            'name.unique'=>'Já existe uma Aula cadastrada nesse Modulo com esse nome.',
            'video.unique'=>'Já existe um Video cadastrado nesse Modulo com esse nome.',
            'description.min'=>'A descriçaõ do curso deve ter pelo menos 3 caracteres.',
            'description.max'=>'A descriçaõ do curso ter no maximo menos 9999 caracteres.',
        ];
    }
}
