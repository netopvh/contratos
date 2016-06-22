<?php

namespace CodeBase\Http\Requests\Role;

use CodeBase\Http\Requests\Request;

class CreateRequest extends Request
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
            'name' => 'required|max:100|unique:roles,name',
            'display_name' => 'sometimes|max:100',
            'description' => 'sometimes|max:100',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nome de Perfil é obrigatório',
            'name.max' => 'Nome do perfil pode ter até 100 caracteres',
            'name.unique' => 'Nome do perfil já existe',
            'display_name.max' => 'Nome de exibição pode ter até 100 caracteres',
            'description.max' => 'Descrição pode ter até 100 caracteres'
        ];
    }
}
