<?php

namespace CodeBase\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class UnidadeValidator extends LaravelValidator {

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'nome' => 'required|unique:unidades',
            'casa_id' => 'required',
            'email' => 'email|required'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'nome' => 'required',
            'casa_id' => 'required',
            'email' => 'required'
        ],
   ];

    protected $messages = [
        'nome.required' => 'O Campo nome é obrigatório',
        'nome.unique' => 'Já existe um registro cadastrado',
        'casa_id.required' => 'O Campo casa é obrigatório',
        'email.email' => 'O Campo email está em formato inválido',
        'email.required' => 'O Campo email é obrigatório'
    ];

}