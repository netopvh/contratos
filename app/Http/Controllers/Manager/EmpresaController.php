<?php

namespace CodeBase\Http\Controllers\Manager;

use CodeBase\Http\Controllers\BaseController;
use Illuminate\Http\Request;

use CodeBase\Http\Requests;
use CodeBase\Http\Controllers\Controller;
use CodeBase\Repositories\Empresa\EmpresaRepositoryEloquent;
use CodeBase\Enum\TipoPessoa;
use Prettus\Validator\Exceptions\ValidatorException;

class EmpresaController extends BaseController
{

    protected $empresas;

    /*
     *
     */
    public function __construct(EmpresaRepositoryEloquent $empresas)
    {
        parent::__construct();
        $this->empresas = $empresas;
    }

    /*
     *
     */
    public function index()
    {
        if (!auth()->user()->can('ver-fornecedores')) {
            abort(403);
        }

        $empresas = $this->empresas->all();

        return view('pages.empresas.index', compact('empresas'));
    }

    /*
     *
     */
    public function create()
    {
        if (!auth()->user()->can('add-fornecedores')) {
            abort(403);
        }

        $tipos = TipoPessoa::getConstants();

        return view('pages.empresas.create', compact('tipos'));
    }

    /*
     *
     */
    public function store(Request $request)
    {
        try{

            if (!auth()->user()->can('ver-fornecedores')) {
                abort(403);
            }

            $this->empresas->create($request->all());

            flash()->success('Contratado cadastrado com sucesso!');
            return redirect()->route('empresas.index');

        }catch (ValidatorException $e){
            flash()->error("<b> Erro:</b>".$e->getMessageBag()->first());
            return redirect()->route('empresas.index');
        }
    }

    /*
     * 
     */
    public function edit($id)
    {
        if (!auth()->user()->can('editar-fornecedores')) {
            abort(403);
        }

        $empresa = $this->empresas->find($id);
        $tipos = TipoPessoa::getConstants();

        return view('pages.empresas.edit', compact('empresa', 'tipos'));
    }

    /*
     *
     */
    public function update(Request $request, $id)
    {
        try{

            if (!auth()->user()->can('editar-fornecedores')) {
                abort(403);
            }

            $this->empresas->update($request->all(),$id);

            flash()->success('Contratado atualizado com sucesso!');
            return redirect()->route('empresas.index');

        }catch (ValidatorException $e){
            flash()->error("<b> Erro:</b>".$e->getMessageBag()->first());
            return redirect()->route('empresas.index');
        }
    }

    public function destroy($id)
    {
        if (!auth()->user()->can('deletar-fornecedores')) {
            abort(403);
        }

        $result = $this->empresas->delete($id);

        if(! $result){
            flash()->error('Erro ao excluir contratado');
            return redirect()->route('empresas.index');
        }
        flash()->success('Contratado removido com sucesso!');
        return redirect()->route('empresas.index');
    }
}
