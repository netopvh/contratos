<?php


namespace CodeBase\Repositories\Casa;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodeBase\Repositories\Casa\CasaRepository;
use CodeBase\Models\Casa;
use CodeBase\Validators\CasaValidator;

class CasaRepositoryEloquent extends BaseRepository implements CasaRepository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Casa::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function validator()
    {
        return CasaValidator::class;
    }

}