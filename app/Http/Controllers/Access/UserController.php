<?php

namespace CodeBase\Http\Controllers\Access;

use Illuminate\Http\Request;
use CodeBase\Http\Requests;
use CodeBase\Repositories\User\UserRepositoryEloquent;
use CodeBase\Http\Controllers\BaseController;
use CodeBase\Repositories\Role\RoleRepositoryEloquent;
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


    public function __construct(
        UserRepositoryEloquent $users,
        RoleRepositoryEloquent $roles
    )
    {
        parent::__construct();
        $this->users = $users;
        $this->roles = $roles;
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
        if (!auth()->user()->can('editar-usuarios')) {
            abort(403);
        }

        $user = $this->users->edit($id);

        $roles = $this->roles->lists('display_name', 'id');

        return view('pages.users.edit', compact('user', 'roles'));
    }

    public function update($id, Request $request)
    {
        if (!auth()->user()->can('editar-usuarios')) {
            abort(403);
        }

        $user = $this->users->find($id);
        $user->is_super = $request->input('is_super');
        $user->is_master = $request->input('is_master');
        $user->save();

        $user->detachRoles();

        $user->attachRole($request->input('role_id'));

        flash()->success('Perfil atribuído com sucesso!');
        return redirect()->route('users.index');
    }

}
