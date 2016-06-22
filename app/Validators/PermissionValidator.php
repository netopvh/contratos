<?php

namespace CodeBase\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class PermissionValidator extends LaravelValidator
{

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'name' => 'required|unique:permissions',
            'display_name' => 'required'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'name' => 'required',
            'display_name' => 'required'
        ],
    ];

    protected $messages = [
        'name.required' => 'O Campo nome é obrigatório!',
        'display_name.required' => 'O Campo nome de Exibição é obrigatório!'
    ];

}