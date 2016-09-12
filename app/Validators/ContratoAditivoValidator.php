<?php

namespace CodeBase\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class ContratoAditivoValidator extends LaravelValidator {

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'contrato_id' => 'required',
            'ano' => 'required',
            'inicio' => 'required',
            'fim' => 'required',
            'total' => 'required'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'contrato_id' => 'required',
            'ano' => 'required',
            'inicio' => 'required',
            'fim' => 'required',
            'total' => 'required'
        ],
   ];

}