<?php

namespace CodeBase\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class ContratoValidator extends LaravelValidator {

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'numero' => 'required|unique:contratos',
            'ano' => 'required',
            'casa_id' => 'required',
            'empresa_id' => 'required',
            'total' => 'required',
            'data_inicio' => 'required',
            'data_fim' => 'required',
            'gestores' => 'required',
            'fiscais' => 'required'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'numero' => 'required',
            'ano' => 'required',
            'casa_id' => 'required',
            'empresa_id' => 'required',
            'total' => 'required',
            'data_inicio' => 'required',
            'data_fim' => 'required',
            'gestores' => 'required',
            'fiscais' => 'required'
        ],
   ];

}