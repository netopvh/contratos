<?php

namespace CodeBase\Http\Controllers\Manager;

use CodeBase\Http\Controllers\BaseController;
use CodeBase\Repositories\Contrato\ContratoRepositoryEloquent;
use CodeBase\Repositories\ContratoAditivo\ContratoAditivoRepositoryEloquent;
use Illuminate\Http\Request;

use CodeBase\Http\Requests;
use CodeBase\Http\Controllers\Controller;
use Prettus\Validator\Exceptions\ValidatorException;

class ContratoAditivoController extends BaseController
{

    protected $repository;

    protected $contrato;

    public function __construct(
        ContratoAditivoRepositoryEloquent $repositoryEloquent,
        ContratoRepositoryEloquent $contrato
    )
    {
        parent::__construct();
        $this->repository = $repositoryEloquent;
        $this->contrato = $contrato;
    }

    public function store(Request $request)
    {
        try {
            if (!auth()->user()->can('aditivar-contratos')) {
                abort(403);
            }

            //Atualiza Tabela de Registros
            $this->contrato->setDefaultValues($request->all());

            //Define a contagem de posição
            $data = $this->verificaPosicao($request->get('contrato_id'), $request->all());

            //Cria o Registro
            $this->repository->create($data);

            flash()->success('Cadastro Realizado com sucesso!');
            return redirect()->route('contratos.aditivar.index');
        } catch (ValidatorException $e) {
            flash()->error('Erro:' . $e->getMessage());
            return redirect()->route('contratos.aditivar.index');
        }
    }

    /*
     * Métodos Privados
     */
    private function verificaPosicao($contrato, $request)
    {
        $aditivos = $this->repository->findWhere([
            'contrato_id' => $contrato
        ])->toArray();

        $data = [];
        $data = $request;
        $data['posicao'] = count($aditivos) + 1;

        return $data;

    }

}
