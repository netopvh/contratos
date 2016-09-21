<?php


namespace CodeBase\Repositories\Contrato;

use CodeBase\Models\Casa;
use CodeBase\Models\ContratoAditivo;
use Illuminate\Container\Container as Application;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodeBase\Repositories\Contrato\ContratoRepository;
use CodeBase\Models\Contrato;
use CodeBase\Validators\ContratoValidator;
use Prettus\Validator\Contracts\ValidatorInterface;
use Carbon\Carbon;

class ContratoRepositoryEloquent extends BaseRepository implements ContratoRepository
{

    protected $casa;

    protected $aditivo;

    /**
     * Injeta o repository da Casa
     *
     * @inject
     */
    public function __construct(
        Casa $casa,
        ContratoAditivo $aditivo,
        Application $app
    )
    {
        parent::__construct($app);
        $this->app = $app;
        $this->casa = $casa;
        $this->aditivo = $aditivo;
    }

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
            if ($value != '') {
                $fields[$key] = $value;
            }
        }

        if (empty($fields)) {
            return false;
        }

        $query = $this->model->query();

        foreach ($fields as $key => $value) {
            $query->orWhere($key, 'LIKE', $value);
            if (is_int($value)) {
                $query->orWhere($key, $value);
            }
        }

        return $query->with(['empresa', 'gestores', 'casa'])->get();
    }

    public function create(array $attributes)
    {
        if (!is_null($this->validator)) {

            $attributes = $this->model->newInstance()->forceFill($attributes)->toArray();

            $this->validator->with($attributes)->passesOrFail(ValidatorInterface::RULE_CREATE);
        }

        $data['numero'] = $attributes['numero'];
        $data['ano'] = $attributes['ano'];
        $data['casa_id'] = $attributes['casa_id'];
        if (!empty($attributes['unidade_id'])) {
            $data['unidade_id'] = $attributes['unidade_id'];
        }
        $data['empresa_id'] = $attributes['empresa_id'];
        $data['total'] = $attributes['total'];
        $data['data_inicio'] = $attributes['data_inicio'];
        $data['data_fim'] = $attributes['data_fim'];
        $data['origem'] = $attributes['data_inicio'];
        $data['encerramento'] = $attributes['data_fim'];
        $data['valor_origem'] = $attributes['total'];
        if (!empty($attributes['tipo'])) {
            $data['tipo'] = $attributes['tipo'];
        }
        if (!empty($attributes['arquivo'])) {
            $data['arquivo'] = $attributes['arquivo'];
            $data['arquivo_origem'] = $attributes['arquivo'];
        }
        $data['aditivado'] = 'N';
        if (!empty($attributes['comentario'])) {
            $data['comentario'] = $attributes['comentario'];
            $data['comentario_origem'] = $attributes['comentario'];
        }
        $gestores = $attributes['gestores'];
        $fiscais = $attributes['fiscais'];

        $contrato = $this->model->newInstance($data);
        $contrato->save();
        $this->resetModel();

        $contrato->gestores()->attach($gestores);
        $contrato->fiscais()->attach($fiscais);

        return true;
    }

    public function update(array $attributes, $id)
    {
        if (!is_null($this->validator)) {
            // we should pass data that has been casts by the model
            // to make sure data type are same because validator may need to use
            // this data to compare with data that fetch from database.
            $attributes = $this->model->newInstance()->forceFill($attributes)->toArray();

            $this->validator->with($attributes)->passesOrFail(ValidatorInterface::RULE_UPDATE);
        }
        $data['numero'] = $attributes['numero'];
        $data['ano'] = $attributes['ano'];
        $data['casa_id'] = $attributes['casa_id'];
        if (!empty($attributes['unidade_id'])) {
            $data['unidade_id'] = $attributes['unidade_id'];
        }
        $data['empresa_id'] = $attributes['empresa_id'];
        $data['total'] = $attributes['total'];
        $data['data_inicio'] = $attributes['data_inicio'];
        $data['data_fim'] = $attributes['data_fim'];
        if (!empty($attributes['comentario'])) {
            $data['comentario'] = $attributes['comentario'];
        }
        if (!empty($attributes['arquivo'])) {
            $data['arquivo'] = $attributes['arquivo'];
        }
        if (!empty($attributes['tipo'])) {
            $data['tipo'] = $attributes['tipo'];
        }
        $gestores = $attributes['gestores'];
        $fiscais = $attributes['fiscais'];

        $model = $this->model->findOrFail($id);
        $model->fill($data);
        $model->save();
        $model->gestores()->detach();
        $model->gestores()->attach($gestores);
        $model->fiscais()->detach();
        $model->fiscais()->attach($fiscais);

        return true;
    }

    public function atualizaStatus(array $attributes, $id)
    {
        $model = $this->model->findOrFail($id);
        $model->fill($attributes);
        $model->save();
    }

    public function getByVencimentoFilter()
    {

        $todayWithDays = Carbon::now()->addDays(90);
        $today = $todayWithDays->toDateString();

        $query = $this->model->query();


        $casa = $this->casa->where('nome', '=', auth()->user()->casa)->first();

        if(!empty($casa)){
            $query->where('data_fim', '<', $today)
                ->where('status', 'V')
                ->where('casa_id', $casa->id);
        }

        $contratos = $query->with(['empresa', 'gestores','casa','fiscais'])->get();

        return $contratos;

    }

    public function getByVencimentoTableFilter()
    {
        $query = $this->model->query();


        $casa = $this->casa->where('nome', '=', auth()->user()->casa)->first();

        if(!empty($casa)){
            $query->where('status', 'V')
                ->where('casa_id', $casa->id);
        }

        $contratos = $query->with(['empresa', 'gestores','casa'])->get();

        return $contratos;
    }

    public function getByVencimento()
    {
        $todayWithDays = Carbon::now()->addDays(90);
        $today = $todayWithDays->toDateString();

        $query = $this->model->query();

        $query->where('data_fim', '<', $today)
            ->where('status', 'V');

        return $query->with(['empresa','gestores','casa','fiscais'])->get();

    }

    public function getContratoView($id)
    {
        $contrato = $this->model->find($id);
        $aditivo = $contrato->aditivo()->where('posicao');

        //$query = $this->model->query();

        //$contrato = $this->model->with('aditivo')->where('id', $id)->first();

        return $contrato;
    }

    public function setDefaultValues(array $attributes)
    {

        $contrato = $this->model->find($attributes['contrato_id']);
        $contrato->aditivado = 'S';
        $contrato->data_inicio = $attributes['inicio'];
        $contrato->data_fim = $attributes['fim'];
        $contrato->total = $attributes['total'];
        $contrato->comentario = $attributes['comentario'];
        $contrato->arquivo = $attributes['arquivo'];
        $contrato->save();
    }

    public function getContratoByDate($inicio, $fim, $status)
    {
        $dataInicio = Carbon::createFromFormat('d/m/Y', $inicio)->format('Y-m-d');
        $dataFim = Carbon::createFromFormat('d/m/Y', $fim)->format('Y-m-d');

        if(empty($status)){
            $contratos = $this->model->with(['empresa','casa'])->whereBetween('data_inicio', [$dataInicio, $dataFim])
                ->orWhereBetween('data_fim', [$dataInicio, $dataFim])
                ->get();
        }else{
            $contratos = $this->model->with(['empresa','casa'])->whereBetween('data_inicio', [$dataInicio, $dataFim])
                ->orWhereBetween('data_fim', [$dataInicio, $dataFim])
                ->where('status', $status)
                ->get();
        }
        return $contratos;
    }

}