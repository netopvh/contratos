<?php
/**
 * Created by PhpStorm.
 * User: angelo.neto
 * Date: 27/04/2016
 * Time: 09:19
 */

namespace CodeBase\Repositories\PermissionGroup;

use Prettus\Repository\Contracts\RepositoryInterface;


interface PermissionGroupRepository extends RepositoryInterface
{

    public function getAllGroups($withChildren = false);

}