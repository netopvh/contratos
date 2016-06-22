<?php
/**
 * Created by PhpStorm.
 * User: angelo.neto
 * Date: 27/04/2016
 * Time: 09:20
 */

namespace CodeBase\Repositories\Empresa;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Codebase\Repositories\Empresa\EmpresaRepository;
use CodeBase\Models\Empresa;
use CodeBase\Validators\EmpresaValidator;
use Illuminate\Database\Eloquent\Collection;

class EmpresaRepositoryEloquent extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Empresa::class;
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
        return EmpresaValidator::class;
    }

    /**
     * get top permissions
     * @return mixed
     */
    public function topPermissions()
    {
        return $this->model->all();
    }


    public function getEmpresasList()
    {
        $empresas = $this->model->all(['id','cpf_cnpj','razao']);

        return $empresas;
    }

}