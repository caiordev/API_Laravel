<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

class TarefaRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'titulo'=>'required',
            'descricao'=>'required'
        ];
    }

    public function messages()
    {
        return [
            'required'=>'Este campo é obrigatório'
        ];
    }
}