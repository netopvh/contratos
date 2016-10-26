<?php

namespace CodeBase\Http\Controllers\Access;

use Illuminate\Http\Request;
use CodeBase\Http\Requests;
use CodeBase\Repositories\User\UserRepositoryEloquent;
use CodeBase\Http\Controllers\BaseController;
use CodeBase\Repositories\Role\RoleRepositoryEloquent;
use CodeBase\Repositories\Casa\CasaRepositoryEloquent;
use Auth;


class UserController extends BaseController
{
    /*
     * @var
     */
    protected $users;

    /*
     * @var
     */
    protected $roles;

    /**
     * @var
     */
    protected $casas;


    public function __construct(
        UserRepositoryEloquent $users,
        RoleRepositoryEloquent $roles,
        CasaRepositoryEloquent $casas
    )
    {
        parent::__construct();
        $this->users = $users;
        $this->roles = $roles;
        $this->casas = $casas;
    }

    /*
     * O Método efetua a listagem dos registro no banco de dados, caso a request esteja vazia retorná
     * todos os registros, caso venha com valor, irá filtrar
     *
     * @mixed $request
     */
    public function index(Request $request)
    {
        if (!auth()->user()->can('ver-usuarios')) {
            abort(403);
        }

        $users = $this->users->all();
        return view('pages.users.index', compact('users'));

    }

    public function edit($id)
    {
        //Verifica a permissão do Usuário
        if (!auth()->user()->can('editar-usuarios')) {
            abort(403);
        }

        //Efetua a localização do Usuário e habilita em edição
        $user = $this->users->edit($id);

        $roles = $this->roles->all(['id','display_name']);

        $casas = $this->casas->all(['id','nome']);

        foreach ($user->casas->toArray() as $casa){
            $casasAr[] = $casa['id'];
        }

        return view('pages.users.edit', compact('user', 'roles','casas','casasAr'));
    }

    public function update($id, Request $request)
    {
        if (!auth()->user()->can('editar-usuarios')) {
            abort(403);
        }

        $this->users->update($request->all(), $id);


        flash()->success('Perfil atribuído com sucesso!');
        return redirect()->route('users.index');
    }

}
