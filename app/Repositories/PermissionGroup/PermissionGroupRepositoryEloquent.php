<?php
/**
 * Created by PhpStorm.
 * User: angelo.neto
 * Date: 27/04/2016
 * Time: 09:20
 */

namespace CodeBase\Repositories\PermissionGroup;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodeBase\Models\PermissionGroup;
use CodeBase\Validators\PermissionGroupValidator;
use Codebase\Repositories\PermissionGroup\PermissionGroupRepository;

class PermissionGroupRepositoryEloquent extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return PermissionGroup::class;
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
        return PermissionGroupValidator::class;
    }


    public function getAllGroups($withChildren = false)
    {
        if($withChildren){
            return PermissionGroup::all();
        }

        return PermissionGroup::with('children', 'permissions')
            ->whereNull('parent_id')
            ->orderBy('sort', 'asc')
            ->get();
    }

}