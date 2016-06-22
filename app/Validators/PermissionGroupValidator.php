<?php

namespace CodeBase\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class PermissionGroupValidator extends LaravelValidator {

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'name' => 'required|unique:permissions_group|min:3'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'name' => 'required'
        ],
   ];

    protected $messages = [
        'name.required' => 'O Campo nome é obrigatório!',
        'name.unique' => 'Já possui um registro com esse nome!',
        'name.min' => 'O Campo deve ter no mínimo 3 caracteres'
    ];

}