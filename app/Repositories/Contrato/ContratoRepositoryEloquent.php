<?php


namespace CodeBase\Repositories\Contrato;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodeBase\Repositories\Contrato\ContratoRepository;
use CodeBase\Models\Contrato;
use CodeBase\Models\ContratoGestor;
use CodeBase\Validators\ContratoValidator;
use Carbon\Carbon;

class ContratoRepositoryEloquent extends BaseRepository implements ContratoRepository
{

    /**
     * Especifica o nome da Classe Model
     *
     * @return string
     */
    public function model()
    {
        return Contrato::class;
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
        return ContratoValidator::class;
    }

    public function search($input)
    {
        foreach ($input as $key => $value) {
            if($value != ''){
                $fields[$key] = $value;
            }
        }

        if(empty($fields)){
            return false;
        }

        $query = $this->model->query();

        foreach ($fields as $key => $value) {
            $query->orWhere($key, 'LIKE', $value);
            if(is_int($value)){
                $query->orWhere($key, $value);
            }
            if(strtotime($value)){
                $value = Carbon::createFromFormat('d/m/Y', $value);
                $query->orWhere($key, $value);
            }
        }

        return $query->with(['empresa','gestores','casa'])->get();
    }

    public function create(array $attributes)
    {
        try{
            $data['numero'] = $attributes['numero'];
            $data['ano'] = $attributes['ano'];
            $data['casa_id'] = $attributes['casa_id'];
            if(! empty($attributes['unidade_id'])){
                $data['unidade_id'] = $attributes['unidade_id'];
            }
            $data['empresa_id'] = $attributes['empresa_id'];
            $data['homologado'] = $attributes['homologado'];
            $data['executado'] = $attributes['executado'];
            $data['data_inicio'] = $attributes['data_inicio'];
            $data['data_fim'] = $attributes['data_fim'];
            if(! empty($attributes['comentario'])){
                $data['comentario'] = $attributes['comentario'];
            }
            $gestores = $attributes['gestores'];

            $contrato = $this->model->create($data);

            $contrato->gestores()->attach($gestores);

            return true;
        }catch (\Exception $e){
            flash()->error("Erro: ". $e->getMessage());
            return redirect()->route('contratos.index');
        }

    }

}