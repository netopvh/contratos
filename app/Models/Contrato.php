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
        'casa_id','unidade_id','numero','ano','homologado','executado','empresa_id','data_inicio','data_fim','status'
    ];

    /*
     * Especificação dos campos datas para formatação
     */
    protected $dates = ['data_inicio', 'data_fim'];

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

    public function scopeSearch($query, $keyword)
    {
        if (is_array($keyword)) {
            $query->where(function ($query) use ($keyword) {
                    $query->where("casa", "=","$keyword")
                        ->orWhere("email", "LIKE", "%$keyword%")
                        ->orWhere("blood_group", "LIKE", "%$keyword%")
                        ->orWhere("phone", "LIKE", "%$keyword%");

            });
        }
        return $query;
    }

    public function setDataInicioAttribute($value)
    {
        if(strlen($value) > 0){
            try{
                return $this->attributes['data_inicio'] = Carbon::createFromFormat('d/m/Y', $value);
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
                return $this->attributes['data_fim'] = Carbon::createFromFormat('d/m/Y', $value);
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

    public function returnDate($value)
    {
        if (strlen($value) > 0) {
            return (new Carbon($value))->format('d/m/Y');
        } else {
            return null;
        }
    }


}
