<?php

namespace CodeBase\Http\Controllers\Manager;

use CodeBase\Http\Controllers\BaseController;
use CodeBase\Repositories\Casa\CasaRepositoryEloquent;
use Illuminate\Http\Request;

use CodeBase\Http\Requests;
use CodeBase\Http\Controllers\Controller;
use Prettus\Validator\Exceptions\ValidatorException;

class CasaController extends BaseController
{

    protected $casas;

    public function __construct(CasaRepositoryEloquent $casas)
    {
        parent::__construct();
        $this->casas = $casas;
    }

    public function index()
    {
        if (!auth()->user()->can('ver-casas')) {
            abort(403);
        }

        $casas = $this->casas->all();

        return view('pages.casas.index', compact('casas'));
    }

    public function create()
    {
        if (!auth()->user()->can('add-casas')) {
            abort(403);
        }

        return view('pages.casas.create');
    }

    public function store(Request $request)
    {
        try{

            if (!auth()->user()->can('add-casas')) {
                abort(403);
            }

            $this->casas->create($request->all());

            flash()->success('Contratante cadastrado com sucesso!');
            return redirect()->route('casas.index');
        } catch(ValidatorException $e){
            flash()->error("<b> Erro:</b>".$e->getMessageBag()->first());
            return redirect()->route('casas.index');
        }
    }

    public function edit($id)
    {
        if (!auth()->user()->can('editar-casas')) {
            abort(403);
        }

        $casa = $this->casas->find($id);

        return view('pages.casas.edit', compact('casa'));
    }

    public function update($id, Request $request)
    {
        try{

            if (!auth()->user()->can('editar-casas')) {
                abort(403);
            }

            $this->casas->update($request->all(),$id);

            flash()->success('Contratante atualizado com sucesso!');
            return redirect()->route('casas.index');

        }catch (ValidatorException $e){
            flash()->error("<b> Erro:</b>".$e->getMessageBag()->first());
            return redirect()->route('casas.index');
        }
    }

    public function destroy($id)
    {
        if (!auth()->user()->can('deletar-casas')) {
            abort(403);
        }

        $result = $this->casas->delete($id);
        if(! $result){
            flash()->error('Erro ao excluir contratante');
            return redirect()->route('casas.index');
        }
        flash()->success('Contratante removido com sucesso!');
        return redirect()->route('casas.index');
    }
}
