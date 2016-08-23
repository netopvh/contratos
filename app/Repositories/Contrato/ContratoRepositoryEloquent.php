<?php


namespace CodeBase\Repositories\Contrato;

use CodeBase\Models\Casa;
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

    /**
     * Injeta o repository da Casa
     *
     * @inject
     */
    public function __construct(
        Casa $casa,
        Application $app
    )
    {
        parent::__construct($app);
        $this->app = $app;
        $this->casa = $casa;
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
        $data['homologado'] = $attributes['homologado'];
        $data['executado'] = $attributes['executado'];
        $data['data_inicio'] = $attributes['data_inicio'];
        $data['data_fim'] = $attributes['data_fim'];
        if (!empty($attributes['comentario'])) {
            $data['comentario'] = $attributes['comentario'];
        }
        $gestores = $attributes['gestores'];

        $contrato = $this->model->newInstance($data);
        $contrato->save();
        $this->resetModel();

        $contrato->gestores()->attach($gestores);

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
        $data['homologado'] = $attributes['homologado'];
        $data['executado'] = $attributes['executado'];
        $data['data_inicio'] = $attributes['data_inicio'];
        $data['data_fim'] = $attributes['data_fim'];
        if (!empty($attributes['comentario'])) {
            $data['comentario'] = $attributes['comentario'];
        }
        $gestores = $attributes['gestores'];

        $model = $this->model->findOrFail($id);
        $model->fill($data);
        $model->save();
        $model->gestores()->detach();
        $model->gestores()->attach($gestores);

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

        $casa = $this->casa->where('nome', 'like', auth()->user()->casa)->first();

        if(empty($casa)){
            $query->where('data_fim', '<', $today)
                ->where('status', 'V')
                ->where('casa_id', $casa->id);
        }

         return $query->with(['empresa', 'gestores','casa'])->get();

    }

    public function getByVencimento()
    {
        $todayWithDays = Carbon::now()->addDays(90);
        $today = $todayWithDays->toDateString();

        $query = $this->model->query();

        $query->where('data_fim', '<', $today)
            ->where('status', 'V');

        return $query->with(['empresa', 'gestores','casa'])->get();

    }

}