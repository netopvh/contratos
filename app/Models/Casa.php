<?php

namespace CodeBase\Models;

use Illuminate\Database\Eloquent\Model;

class Casa extends Model
{

    protected $fillable = [
        'nome'
    ];

    public function unidades()
    {
        return $this->hasMany(Unidade::class);
    }

}
