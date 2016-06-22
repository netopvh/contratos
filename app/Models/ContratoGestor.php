<?php

namespace CodeBase\Models;

use Illuminate\Database\Eloquent\Model;

class ContratoGestor extends Model
{

    protected $table = 'contratos_gestores';

    protected $fillable = [
        'contrato_id', 'user_id'
    ];

}
