<?php

namespace CodeBase\Http\Controllers\Access;

use CodeBase\Repositories\Permission\PermissionRepositoryEloquent;
use CodeBase\Repositories\PermissionGroup\PermissionGroupRepositoryEloquent;
use Illuminate\Http\Request;
use CodeBase\Http\Controllers\BaseController;

use CodeBase\Http\Requests;

class PermissionController extends BaseController
{

    /*
     * @var PermissionRepositoryEloquent
     */
    protected $permission;

    /*
     * @var PermissionGroupRepositoryEloquent
     */
    protected $group;

    public function __construct(
        PermissionRepositoryEloquent $permission,
        PermissionGroupRepositoryEloquent $group)
    {
        parent::__construct();
        $this->permission = $permission;
        $this->group = $group;
    }

    public function index()
    {
        if (!auth()->user()->can('ver-permissoes')) {
            abort(403);
        }

        $permissions = $this->permission->with('group')->all();
        $groups = $this->group->getAllGroups();

        return view('pages.permissions.index', compact('permissions', 'groups'));
    }

    public function create(Request $request)
    {
        if (!auth()->user()->can('add-permissoes')) {
            abort(403);
        }

        $groups = $this->group->lists('name', 'id');

        return view('pages.permissions.create', compact('groups'));
    }

    public function store(Request $request)
    {
        if (!auth()->user()->can('add-permissoes')) {
            abort(403);
        }

        $permission = $this->permission->create($request->all());

        if(! $permission){
            flash()->error('Erro ao Inserir Permissão');
            return redirect(route('permissions.create'));
        }

        flash()->success('Permissão atribuida com sucesso!');
        return redirect()->route('permissions.create');
    }

    public function edit($id)
    {
        if (!auth()->user()->can('editar-permissoes')) {
            abort(403);
        }

        $permission = $this->permission->find($id);

        return view('pages.permissions.edit', compact('permission'));
    }

    public function update($id, Request $request)
    {
        if (!auth()->user()->can('editar-permissoes')) {
            abort(403);
        }

        $result = $this->permission->update($request->all(), $id);

        if(!$result['status']) {
            flash()->error($result['msg']);
            return redirect(route('permissions.edit', ['id' => $id]));
        } else {
            flash()->success('Permissão atualizada com sucesso!');
            return redirect(route('permissions.index'));
        }
    }
}
