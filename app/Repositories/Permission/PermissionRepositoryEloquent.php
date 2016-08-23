<?php
/**
 * Created by PhpStorm.
 * User: angelo.neto
 * Date: 27/04/2016
 * Time: 09:20
 */

namespace CodeBase\Repositories\Permission;

use Prettus\Repository\Contracts\CacheableInterface;
use Prettus\Repository\Traits\CacheableRepository;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodeBase\Models\Permission;
use CodeBase\Validators\PermissionValidator;

class PermissionRepositoryEloquent extends BaseRepository implements CacheableInterface
{

    use CacheableRepository;
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Permission::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function validator()
    {
        return PermissionValidator::class;
    }

    /**
     * get top permissions
     * @return mixed
     */
    public function topPermissions()
    {
        return $this->model->with('group')->get();
    }

    /**
     * update permission
     * @param array $attributes
     * @param $id
     * @return array
     */
    public function update(array $attributes, $id)
    {
        if(starts_with($attributes['name'], '#')){
            $inputs['name'] = '#-' . time();
        }

        $isAble = $this->model->where('id', '<>', $id)->where('name', $attributes['name'])->count();

        if($isAble) {
            return [
                'status' => false,
                'msg' => 'Rota da permissão foi usada'
            ];
        }

        $result = parent::update($attributes, $id);
        if(!$result) {
            return [
                'status' => false,
                'msg' => 'Atualização de permissões falhou'
            ];
        }

        return ['status' => true];
    }

    /**
     * Destroy permission by id
     * @param int $id
     * @return bool|null
     */
    public function delete($id)
    {
        $permission = $this->model->find($id);
        if(!$permission) {
            return false;
        }
        $permission->roles()->detach();
        return parent::delete($id);
    }

    /**
     * Permission Menus
     * @return array
     */
    public function menus($isAdmin = 0)
    {
        $menus = [];
        $father = $this->model->where('fid', 0)
            ->where('is_menu', 1)
            ->where('is_admin', $isAdmin)
            ->orderBy('sort', 'asc')
            ->orderBy('id', 'asc')->get()->toArray();
        if($father) {
            foreach ($father as $item) {
                if($item['sub_permission']) {
                    foreach ($item['sub_permission'] as $key => $sub) {
                        if($sub['is_menu']) {
                            $item['sub'][] = $sub;
                        }
                    }
                    unset($item['sub_permission']);
                }

                $menus[] = $item;
            }
        }

        return $menus;
    }
}