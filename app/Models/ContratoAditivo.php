<?php

namespace CodeBase\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ContratoAditivo extends Model
{
    protected $fillable = [
        'contrato_id', 'posicao', 'ano', 'inicio', 'fim', 'total','arquivo','comentario'
    ];


    public function contrato()
    {
        $this->belongsTo(Contrato::class, 'contrato_id','id');
    }


    public function setInicioAttribute($value)
    {
        if(strlen($value) > 0){
            try{
                return $this->attributes['inicio'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');

            }catch (\Exception $e){
                return $this->attributes['inicio'] = date('Y-m-d');
            }
        }
        return null;
    }

    public function getInicioAttribute($value)
    {
        return $this->returnDate($value);
    }

    public function setFimAttribute($value)
    {
        if(strlen($value) > 0){
            try{
                return $this->attributes['fim'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');

            }catch (\Exception $e){
                return $this->attributes['fim'] = date('Y-m-d');
            }
        }
        return null;
    }

    public function getFimAttribute($value)
    {
        return $this->returnDate($value);
    }

    /*
     * Função que retorna a data formatada
     *
     * @return date
     */
    private function returnDate($value)
    {
        if (strlen($value) > 0) {
            return (new Carbon($value))->format('d/m/Y');
        } else {
            return null;
        }
    }
}
