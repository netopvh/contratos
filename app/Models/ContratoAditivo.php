<?php

namespace CodeBase\Models;

use Illuminate\Database\Eloquent\Model;

class ContratoAditivo extends Model
{
    protected $fillable = [
        'contrato_id', 'ano', 'inicio', 'fim', 'homologado', 'executado','comentario'
    ];
}
