<?php

namespace CodeBase\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class EmpresaValidator extends LaravelValidator {

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'razao' => 'required|unique:empresas',
            'tipo_pessoa' => 'required',
            'cpf_cnpj' => 'required|unique:empresas',
            'email' => 'email'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'razao' => 'required',
            'tipo_pessoa' => 'required',
            'cpf_cnpj' => 'required',
            'email' => 'email'
        ],
   ];

}