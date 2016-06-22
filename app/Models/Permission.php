<?php
/**
 * Created by PhpStorm.
 * User: angelo.neto
 * Date: 25/04/2016
 * Time: 16:23
 */

namespace CodeBase\Models;

use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Zizaco\Entrust\EntrustPermission;

class Permission extends EntrustPermission implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
        'name',
        'group_id',
        'display_name',
        'description',
        'sort'
    ];

    public function group()
    {
        return $this->belongsTo(PermissionGroup::class,'group_id','id');
    }

}