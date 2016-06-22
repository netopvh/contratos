<?php

namespace CodeBase\Http\Controllers\Manager;

use Adldap\Exceptions\ModelNotFoundException;
use CodeBase\Enum\TipoPessoa;
use CodeBase\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use CodeBase\Http\Requests;
use CodeBase\Repositories\Contrato\ContratoRepositoryEloquent;
use CodeBase\Enum\Status;
use Debubar;
use CodeBase\Repositories\User\UserRepositoryEloquent;


class ContratoController extends BaseController
{

    /*
     *
     */
    protected $contratos;

    /*
     *
     */
    protected $users;

    /*
     * Injeta o Repositório no Controller
     *
     * @inject
     */
    public function __construct(ContratoRepositoryEloquent $contratos, UserRepositoryEloquent $users)
    {
        parent::__construct();
        $this->contratos = $contratos;
        $this->users = $users;
    }

    /*
     * Ação de início
     */
    public function index()
    {
        if(auth()->user()->is_super == 1){



        }else{
            $contratos = $this->contratos->with(['empresa','gestores','casa'])->all();
            $status = Status::getConstants();
        }

        return view('pages.contratos.index', compact('contratos','status'));
    }

    /*
     * Exibe os registro de forma filtrada
     *
     * @return mixed
     */
    public function lists(Request $request)
    {
        $contratos = $this->contratos->search($request->all());
        if(!$contratos){
            flash()->error('Preencha ao menos um campo para pesquisa');
            return redirect()->route('contratos.index');
        }
        $status = Status::getConstants();
        return view('pages.contratos.list', compact('contratos','status'));
    }

    public function create()
    {
        $users = $this->users->lists('name', 'id');

        return view('pages.contratos.create', compact('users'));
    }

    public function store(Request $request)
    {
        $result = $this->contratos->create($request->all());

        if($result){
            flash()->success('Cadastro Realizado com sucesso!');
            return redirect()->route('contratos.index');
        }

        return null;
    }

    /*
     * Buscar registro para exibição individual
     *
     * @return mixed
     */
    public function view($id)
    {
        try{
            $contrato = $this->contratos->find($id);

            $tipo = TipoPessoa::getConstants();

            $status = Status::getConstants();

            return view('pages.contratos.view', compact('contrato', 'tipo', 'status'));
        }catch (ModelNotFoundException $e){
            flash()->error('Erro: '. $e->getMessage());
            return redirect()->route('contratos.index');
        }
    }
    
}
