<?php


namespace CodeBase\Repositories\ContratoAditivo;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodeBase\Repositories\Contrato\ContratoRepository;
use CodeBase\Models\ContratoAditivo;
use CodeBase\Validators\ContratoAditivoValidator;
use Carbon\Carbon;

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




}