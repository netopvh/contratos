<?php

namespace CodeBase\Http\Controllers\Manager;

use CodeBase\Http\Controllers\BaseController;
use CodeBase\Repositories\ContratoAditivo\ContratoAditivoRepositoryEloquent;
use Illuminate\Http\Request;

use CodeBase\Http\Requests;
use CodeBase\Http\Controllers\Controller;
use Prettus\Validator\Exceptions\ValidatorException;

class ContratoAditivoController extends BaseController
{

    protected $repository;

    public function __construct(ContratoAditivoRepositoryEloquent $repositoryEloquent)
    {
        $this->repository = $repositoryEloquent;
    }

    public function store(Request $request)
    {
        try {
            if (!auth()->user()->can('aditivar-contratos')) {
                abort(403);
            }

            $this->repository->create($request->all());

            flash()->success('Cadastro Realizado com sucesso!');
            return redirect()->route('contratos.aditivar.index');
        } catch (ValidatorException $e) {
            flash()->error('Erro:' . $e->getMessage());
            return redirect()->route('contratos.aditivar.index');
        }
    }

}
