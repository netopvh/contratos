<?php


namespace CodeBase\Repositories\ContratoAditivo;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodeBase\Repositories\Contrato\ContratoRepository;
use CodeBase\Models\ContratoAditivo;
use CodeBase\Validators\ContratoAditivoValidator;
use DB;

class ContratoAditivoRepositoryEloquent extends BaseRepository implements ContratoRepository
{

    /**
     * Especifica o nome da Classe Model
     *
     * @return string
     */
    public function model()
    {
        return ContratoAditivo::class;
    }

    /**
     * Inicia o repository, instanciando a criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function validator()
    {
        return ContratoAditivoValidator::class;
    }

    public function getAllAditivos($contrato, $ano)
    {
        $aditivos = DB::table('contrato_aditivos')
            ->where('contrato_id', $contrato)
            ->where('ano', $ano)
            ->first();

        return $aditivos;
    }




}