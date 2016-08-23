<?php

namespace CodeBase\Http\Controllers;

use CodeBase\Http\Requests;
use Illuminate\Http\Request;
use Auth, Adldap;
use CodeBase\Repositories\Contrato\ContratoRepositoryEloquent;
use CodeBase\Events\MailSendNotification;
use Illuminate\Support\Facades\Event;
use Carbon\Carbon;

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
        if(!auth()->user()->is_super == 1){
            $contratos = $this->contratos->getByVencimentoFilter();
        }else{
            $contratos = $this->contratos->getByVencimento();
        }

        Event::fire(new MailSendNotification($contratos));

        return view('home', compact('contratos'));
    }


}
