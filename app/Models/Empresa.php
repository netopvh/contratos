<?php

namespace CodeBase\Models;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $fillable = [
        'razao','fantasia','tipo_pessoa','cpf_cnpj','responsavel','email'
    ];
}
