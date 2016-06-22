<?php

namespace CodeBase\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class CasaValidator extends LaravelValidator {

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'nome' => 'required|unique:casas'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'nome' => 'required'
        ],
   ];

    protected $messages = [
        'nome.required' => 'O Campo nome é obrigatório',
        'nome.unique' => 'Já existe um registro no banco de dados'
    ];

}