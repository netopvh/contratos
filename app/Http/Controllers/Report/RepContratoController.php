<?php

namespace CodeBase\Http\Controllers\Report;

use CodeBase\Http\Controllers\BaseController;
use CodeBase\Repositories\Contrato\ContratoRepositoryEloquent;
use Illuminate\Http\Request;

use CodeBase\Http\Requests;
use CodeBase\Http\Controllers\Controller;

class RepContratoController extends BaseController
{

    protected $contrato;

    public function __construct(ContratoRepositoryEloquent $contrato)
    {
        parent::__construct();
        $this->contrato = $contrato;
    }

    public function index()
    {
        return view('reports.contratos.index');
    }

    public function byData()
    {
        return view('reports.contratos.data');
    }

    public function searchData(Request $request)
    {
        switch($request->get('status')){
            case "T":
                $status = '';
                break;
            case "V":
                $status = "V";
                break;
            case "F":
                $status = "F";
                break;
            case "C":
                $status = "C";
                break;

        }

        $contratos = $this->contrato->with(['empresa','casa'])->findWhere([
            'data_inicio' => $request->get('inicio'),
            'data_fim' => $request->get('fim'),
            'status' => $status
        ]);

        dd($contratos);
    }

}
