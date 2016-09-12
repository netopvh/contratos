<?php

namespace CodeBase\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Contrato extends Model
{

    /*
     * Colunas que poderão inserir registros no banco de dados
     */
    protected $fillable = [
        'casa_id','unidade_id','numero','aditivado','ano','tipo','total', 'arquivo', 'empresa_id','data_inicio','data_fim','origem','encerramento','valor_origem','status','comentario'
    ];

    /*
     * Especificação dos campos datas para formatação
     */
    protected $dates = ['data_inicio', 'data_fim', 'origem', 'encerramento'];

    /*
     * @function Relactionamento entre as tabelas de Contratos e Aditivos
     *
     *  @return mixed
     */
    public function aditivo()
    {
        return $this->hasMany(ContratoAditivo::class,'contrato_id','id');
    }

    /*
     * @function Relactionamento entre as tabelas de Contratos e Usuários
     *
     *  @return mixed
     */
    public function gestores()
    {
        return $this->belongsToMany(User::class,'contratos_gestores','contrato_id', 'user_id');
    }

    /*
    * @function Relactionamento entre as tabelas de Contratos e Usuários
    *
    *  @return mixed
    */
    public function fiscais()
    {
        return $this->belongsToMany(User::class,'contratos_fiscais','contrato_id', 'user_id');
    }

    /*
     * @function Relactionamento entre as tabelas de Contratos e Empresas
     *
     *  @return mixed
     */
    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    /*
     * @function Relactionamento entre as tabelas de Contratos e Casas
     *
     *  @return mixed
     */
    public function casa()
    {
        return $this->belongsTo(Casa::class);
    }

    public function unidade()
    {
        return $this->belongsTo(Unidade::class);
    }

    public function setDataInicioAttribute($value)
    {
        if(strlen($value) > 0){
            try{
                return $this->attributes['data_inicio'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');

            }catch (\Exception $e){
                return $this->attributes['data_inicio'] = date('Y-m-d');
            }
        }
        return null;
    }

    public function getDataInicioAttribute($value)
    {
        return $this->returnDate($value);
    }

    public function setDataFimAttribute($value)
    {
        if(strlen($value) > 0){
            try{
                return $this->attributes['data_fim'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');

            }catch (\Exception $e){
                return $this->attributes['data_fim'] = date('Y-m-d');
            }
        }
        return null;
    }

    public function getDataFimAttribute($value)
    {
        return $this->returnDate($value);
    }


    public function setOrigemAttribute($value)
    {
        if(strlen($value) > 0){
            try{
                return $this->attributes['origem'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');

            }catch (\Exception $e){
                return $this->attributes['origem'] = date('Y-m-d');
            }
        }
        return null;
    }

    public function getOrigemAttribute($value)
    {
        return $this->returnDate($value);
    }

    public function setEncerramentoAttribute($value)
    {
        if(strlen($value) > 0){
            try{
                return $this->attributes['encerramento'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');

            }catch (\Exception $e){
                return $this->attributes['encerramento'] = date('Y-m-d');
            }
        }
        return null;
    }

    public function getEncerramentoAttribute($value)
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
