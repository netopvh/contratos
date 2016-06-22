<?php

namespace CodeBase\Models;

use Illuminate\Database\Eloquent\Model;

class Unidade extends Model
{

    protected $fillable = [
        'nome',
        'casa_id',
        'email'
    ];


    public function casa()
    {
        return $this->belongsTo(Casa::class);
    }

}
