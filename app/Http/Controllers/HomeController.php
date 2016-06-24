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
        $contratos = $this->contratos->with('empresa')->all();

        return view('home', compact('contratos'));
    }



}
