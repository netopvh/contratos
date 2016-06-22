<?php

namespace CodeBase\Http\Controllers\Manager;

use CodeBase\Http\Controllers\BaseController;
use CodeBase\Repositories\Unidade\UnidadeRepositoryEloquent;
use CodeBase\Repositories\Casa\CasaRepositoryEloquent;
use Illuminate\Http\Request;

use CodeBase\Http\Requests;
use CodeBase\Http\Controllers\Controller;
use Prettus\Validator\Exceptions\ValidatorException;

class UnidadeController extends BaseController
{


    protected $unidades;
    protected $casas;

    public function __construct(UnidadeRepositoryEloquent $unidades, CasaRepositoryEloquent $casas)
    {
        parent::__construct();
        $this->unidades = $unidades;
        $this->casas = $casas;
    }
    
    public function index()
    {
        if (!auth()->user()->can('ver-unidades')) {
            abort(403);
        }

        $unidades = $this->unidades->with('casa')->all();

        return view('pages.unidades.index', compact('unidades'));
    }

    public function create(Request $request)
    {
        if (!auth()->user()->can('add-unidades')) {
            abort(403);
        }

        $casas = $this->casas->lists('nome', 'id');

        return view('pages.unidades.create', compact('casas'));

    }

    public function store(Request $request)
    {
        try{

            if (!auth()->user()->can('add-unidades')) {
                abort(403);
            }

            $this->unidades->create($request->all());

            flash('')->success("Unidade cadastrada com sucesso!");
            return redirect()->route('unidades.index');

        }catch (ValidatorException $e){
            flash('')->error("<b>Erro: </b>" . $e->getMessageBag()->first());
            return redirect()->route('unidades.create');
        }
    }

    public function edit($id)
    {

        if (!auth()->user()->can('editar-unidades')) {
            abort(403);
        }

        $unidade = $this->unidades->find($id);
        $casas = $this->casas->lists('nome', 'id');

        return view('pages.unidades.edit', compact('unidade','casas'));
    }

    public function update($id, Request $request)
    {

       try{

           if (!auth()->user()->can('editar-unidades')) {
               abort(403);
           }

           $this->unidades->update($request->all(), $id);

           flash('')->success("Unidade atualizada com sucesso!");
           return redirect()->route('unidades.index');
       }catch (ValidatorException $e){
           flash('')->error("<b>Erro: </b>" . $e->getMessageBag()->first());
           return redirect()->route('unidades.create');
       }

    }

    public function destroy($id)
    {
        $result = $this->unidades->delete($id);

        if (!auth()->user()->can('deletar-unidades')) {
            abort(403);
        }

        if(! $result){
            flash('')->error("Erro ao remover unidade");
            return redirect()->route('unidades.index');
        }

        flash('')->success("Unidade removida com sucesso!");
        return redirect()->route('unidades.index');
    }

}
