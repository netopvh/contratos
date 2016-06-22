<?php

namespace CodeBase\Http\Controllers\Access;

use CodeBase\Repositories\Permission\PermissionRepositoryEloquent;
use CodeBase\Repositories\PermissionGroup\PermissionGroupRepositoryEloquent;
use CodeBase\Repositories\Role\RoleRepositoryEloquent;
use Illuminate\Http\Request;
use CodeBase\Http\Requests;
use CodeBase\Http\Controllers\BaseController;
use Breadcrumbs;
use Prettus\Validator\Exceptions\ValidatorException;

class RoleController extends BaseController
{

    protected $role;
    protected $permission;
    protected $group;

    public function __construct(
        RoleRepositoryEloquent $role,
        PermissionRepositoryEloquent $permission,
        PermissionGroupRepositoryEloquent $group
    )
    {
        parent::__construct();
        $this->role = $role;
        $this->permission = $permission;
        $this->group = $group;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!auth()->user()->can('ver-perfis')) {
            abort(403);
        }

        $roles = $this->role->all();
        return view('pages.roles.index', compact('roles'));
    }

    public function create()
    {
        if (!auth()->user()->can('add-perfis')) {
            abort(403);
        }

        return view('pages.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {

            if (!auth()->user()->can('add-perfis')) {
                abort(403);
            }

            $this->role->create($request->all());

            flash()->success('Perfil adicionado com sucesso!');
            return redirect()->route('roles.index');

        } catch (ValidatorException $e) {
            flash()->error('Ocorreu um erro de validação, verifique se o registro já consta no banco de dados');
            return redirect()->route('roles.index');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!auth()->user()->can('editar-perfis')) {
            abort(403);
        }

        $role = $this->role->find($id);

        return view('pages.roles.edit')->with('role', $role);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (!auth()->user()->can('editar-perfis')) {
            abort(403);
        }

        $result = $this->role->update($request->all(), $id);
        if (!$result['status']) {
            flash()->error($result['msg']);
            return redirect(route('roles.edit', ['id' => $id]));
        } else {
            flash()->success('Perfil atualizado com sucesso!');
            return redirect(route('roles.index'));
        }

    }

    public function permissions($id)
    {
        if (!auth()->user()->can('definir-perfis')) {
            abort(403);
        }

        $role = $this->role->find($id);
        $permissions = $this->permission->topPermissions();
        $rolePermissions = $this->role->rolePermissions($id);
        $groups = $this->group->getAllGroups();

        return view('pages.roles.permissions', compact('role', 'permissions', 'rolePermissions', 'groups'));
    }

    public function storePermissions($id, Request $request)
    {
        if (!auth()->user()->can('definir-perfis')) {
            abort(403);
        }

        $result = $this->role->savePermissions($id, $request->input('permissions', []));

        if ($result) {
            flash()->success('Permissões Inseridas com Sucesso');
        } else {
            flash()->error('Erro ao Atribuir Permissões');
        }

        return redirect()->route('roles.index');
    }

}
