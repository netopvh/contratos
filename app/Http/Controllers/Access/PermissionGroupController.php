<?php

namespace CodeBase\Http\Controllers\Access;

use CodeBase\Http\Controllers\BaseController;
use CodeBase\Repositories\PermissionGroup\PermissionGroupRepositoryEloquent;
use Illuminate\Http\Request;

use CodeBase\Http\Requests;
use CodeBase\Http\Controllers\Controller;
use Prettus\Validator\Exceptions\ValidatorException;

class PermissionGroupController extends BaseController
{

    /*
     * @ver PermissionGroupRepository
     */
    protected $group;

    public function __construct(PermissionGroupRepositoryEloquent $group)
    {
        parent::__construct();
        $this->group = $group;
    }
    
    public function create()
    {

        $groups = $this->group->lists('name','id');

        return view('pages.permission_groups.create', compact('groups'));

    }

    public function store(Request $request)
    {
        try {

            $data['name'] = $request->input('name');
            $request->input('parent_id') == '' ? NULL : $data['parent_id'] = $request->input('parent_id');
            $data['sort'] = $request->input('sort');

            $this->group->create($data);

            flash()->success('Grupo adicionado com sucesso!');
            return redirect()->route('permissions.index');

        } catch (ValidatorException $e) {
            flash()->error('Ocorreu um erro de validação, verifique se o registro já consta no banco de dados');
            return redirect()->route('permissions.index');
        }
    }

    public function edit($id)
    {
        $group = $this->group->find($id);
        $groups = $this->group->lists('name','id');

        return view('pages.permission_groups.edit', compact('group', 'groups'));
    }

    public function update(Request $request, $id)
    {

        $data['name'] = $request->input('name');
        $request->input('parent_id') == '' ? NULL : $data['parent_id'] = $request->input('parent_id');
        $data['sort'] = $request->input('sort');

        $result = $this->group->update($data, $id);
        if (!$result) {
            flash()->error("Erro ao atualizar Grupo");
            return redirect(route('permissions.index'));
        } else {
            flash()->success('Grupo atualizado com sucesso!');
            return redirect(route('permissions.index'));
        }
    }
    
    public function destroy($id)
    {
        $result = $this->group->delete($id);

        if(! $result){
            flash()->error('Erro ao excluir grupo');
            return redirect()->route('permissions.index');
        }

        return redirect()->route('permissions.index');
    }
    
}
