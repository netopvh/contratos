<?php

namespace CodeBase\Models;

use Illuminate\Database\Eloquent\Model;

class ContratoFiscal extends Model
{
    protected $table = 'contratos_fiscais';

    protected $fillable = [
        'contrato_id', 'user_id'
    ];
}
