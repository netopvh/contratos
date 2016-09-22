<?php

namespace CodeBase\Http\Controllers;

use CodeBase\Http\Requests;
use Illuminate\Http\Request;
use Auth, Adldap;
use CodeBase\Repositories\Contrato\ContratoRepositoryEloquent;

class HomeController extends BaseController
{
    /*
     *
     */
    protected $contratos;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ContratoRepositoryEloquent $contratos)
    {
        parent::__construct();
        $this->contratos = $contratos;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->is_super == 1){
            $contratos = $this->contratos->getByVencimento();
        }
        else if(auth()->user()->is_master == 1) {
            $contratos = $this->contratos->getByVencimentoFilter();
        }
        else
        {
            $contratos = $this->contratos->getByVencimentoFilterUnidade();
        }

        return view('home', compact('contratos'));
    }


}
