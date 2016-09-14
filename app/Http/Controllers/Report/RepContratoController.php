<?php

namespace CodeBase\Http\Controllers\Report;

use CodeBase\Http\Controllers\BaseController;
use CodeBase\Repositories\Contrato\ContratoRepositoryEloquent;
use Illuminate\Http\Request;

use CodeBase\Http\Requests;
use Barryvdh\DomPDF\PDF;
use App;

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

    public function searchByDate(Request $request)
    {
        $contratos = $this->contrato->getContratoByDate($request->get('inicio'), $request->get('fim'), $request->get('status'));

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('reports.contratos.pdf.lista_data', compact('contratos'));

        return $pdf->stream('lista.pdf');
    }

}
