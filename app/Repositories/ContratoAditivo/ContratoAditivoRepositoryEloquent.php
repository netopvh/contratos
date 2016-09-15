<?php


namespace CodeBase\Repositories\ContratoAditivo;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodeBase\Repositories\Contrato\ContratoRepository;
use CodeBase\Models\ContratoAditivo;
use CodeBase\Validators\ContratoAditivoValidator;
use DB;
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

    public function getAllAditivos($contrato, $ano)
    {
        $aditivos = DB::table('contrato_aditivos')
            ->where('contrato_id', $contrato)
            ->where('ano', $ano)
            ->first();

        return $aditivos;
    }

    public function setAditivoUpdate($attributes, $id)
    {
        $total = $this->model->where('contrato_id', $id)->get()->count();

        $inicio = Carbon::createFromFormat('d/m/Y', $attributes['data_inicio'])->format('Y-m-d');
        $fim = Carbon::createFromFormat('d/m/Y', $attributes['data_fim'])->format('Y-m-d');


        DB::table('contrato_aditivos')
            ->where('contrato_id', $id)
            ->where('posicao', $total)
            ->update([
                'inicio' => $inicio,
                'fim' => $fim,
                'total' => $attributes['total'],
                'comentario' => $attributes['comentario'],
                'updated_at' => Carbon::now()
            ]);

    }


}