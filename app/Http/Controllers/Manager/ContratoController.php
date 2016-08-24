<?php

namespace CodeBase\Http\Controllers\Manager;

use Adldap\Exceptions\ModelNotFoundException;
use CodeBase\Enum\TipoPessoa;
use CodeBase\Http\Controllers\BaseController;
use Illuminate\Contracts\Validation\ValidationException;
use Illuminate\Http\Request;
use CodeBase\Http\Requests;
use CodeBase\Repositories\Contrato\ContratoRepositoryEloquent;
use CodeBase\Enum\Status;
use Debubar;
use CodeBase\Repositories\User\UserRepositoryEloquent;
use Psy\Exception\ErrorException;


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
        if (!auth()->user()->can('ver-movimentos')) {
            abort(403);
        }

        if (!auth()->user()->is_super == 1) {
            $contratos = $this->contratos->getByVencimentoFilter();
            $status = Status::getConstants();
        }

        return view('pages.contratos.index', compact('contratos', 'status'));
    }

    /*
     * Exibe os registro de forma filtrada
     *
     * @return mixed
     */
    public function lists(Request $request)
    {
        if (!auth()->user()->can('ver-movimentos')) {
            abort(403);
        }

        $contratos = $this->contratos->search($request->all());
        if (!$contratos) {
            flash()->error('Preencha ao menos um campo para pesquisa');
            return redirect()->route('contratos.index');
        }
        $status = Status::getConstants();
        return view('pages.contratos.list', compact('contratos', 'status'));
    }

    /*
     * Prepara para uma nova inserção no banco de dados
     *
     *
     */
    public function create()
    {
        if (!auth()->user()->can('add-contratos')) {
            abort(403);
        }

        $users = $this->users->all(['id', 'name']);

        return view('pages.contratos.create', compact('users'));
    }

    /*
     * Salva registro no banco de dados
     *
     * @return null
     */
    public function store(Request $request)
    {
        try {
            if (!auth()->user()->can('add-contratos')) {
                abort(403);
            }

            $this->contratos->create($request->all());

            flash()->success('Cadastro Realizado com sucesso!');
            return redirect()->route('contratos.index');
        } catch (ValidationException $e) {
            flash()->error('Erro:' . $e->getMessage());
            return redirect()->route('contratos.create');
        }
    }

    /*
     * Buscar registro para exibição individual
     *
     * @return mixed
     */
    public function view($id)
    {
        try {
            if (!auth()->user()->can('visualizar-contratos')) {
                abort(403);
            }

            $contrato = $this->contratos->find($id);
            $tipo = TipoPessoa::getConstants();
            $status = Status::getConstants();

            return view('pages.contratos.view', compact('contrato', 'tipo', 'status'));
        } catch (ModelNotFoundException $e) {
            flash()->error('Erro: ' . $e->getMessage());
            return redirect()->route('contratos.index');
        }
    }

    public function edit($id)
    {
        try {

            if (!auth()->user()->can('editar-contratos')) {
                abort(403);
            }

            $contrato = $this->contratos->with('gestores')->find($id);
            $users = $this->users->all(['name', 'id']);
            $gestores = [];
            foreach ($contrato->gestores->toArray() as $gestor) {
                $gestores[] = $gestor['id'];
            }

            return view('pages.contratos.edit', compact('contrato', 'users', 'gestores'));

        } catch (ModelNotFoundException $e) {
            flash()->error('Erro: ' . $e->getMessage());
            return redirect()->route('contratos.index');
        }
    }

    public function update($id, Request $request)
    {
        try {

            if (!auth()->user()->can('editar-contratos')) {
                abort(403);
            }

            $this->contratos->update($request->all(), $id);

            flash()->success('Contrato atualizado com sucesso!');
            return redirect()->route('contratos.index');
        } catch (ModelNotFoundException $e) {
            flash()->error('Erro: ' . $e->getMessage());
            return redirect()->route('contratos.index');
        }
    }

    public function getStatus($id)
    {
        try {

            if (!auth()->user()->can('status-contratos')) {
                abort(403);
            }

            $contrato = $this->contratos->with('empresa')->find($id);

            $status = Status::getConstants();

            return view('pages.contratos.status', compact('contrato', 'status'));

        } catch (ModelNotFoundException $e) {
            flash()->error('Erro: ' . $e->getMessage());
            return redirect()->route('contratos.index');
        }
    }

    public function postStatus(Request $request, $id)
    {
        try {
            if (!auth()->user()->can('status-contratos')) {
                abort(403);
            }

            $this->contratos->atualizaStatus($request->only('status'), $id);

            flash()->success('Status atualizado com sucesso!');
            return redirect()->route('contratos.index');

        } catch (ModelNotFoundException $e) {
            flash()->error('Erro: ' . $e->getMessage());
            return redirect()->route('contratos.index');
        }
    }

    public function aditivarIndex()
    {
        return view('pages.contratos.aditivar');
    }

    public function contratoSearch(Request $request)
    {
        try{
            $data = $request->get('contrato');
            $value = explode('/', $data);
            if(count($value) < 2){
                flash()->error('Digite o Numero do contrato e o Ano');
                return redirect()->route('contratos.aditivar.index');
            }
            $numero = $value[0];
            $ano = $value[1];

            $contrato = $this->contratos->with(['empresa'])->findWhere([
                'numero' => $numero,
                'ano' => $ano
            ])->first();

            if(is_null($contrato)){
                flash()->error('Nenhum contato localizado!');
                return redirect()->route('contratos.aditivar.index');
            }

            //dd($contrato);

            return view('pages.contratos.forms.aditivo', compact('contrato'));
        }catch (ErrorException $e){
            flash()->error($e->getMessage());
            return redirect()->route('contratos.aditivar.api');
        }

    }

}
