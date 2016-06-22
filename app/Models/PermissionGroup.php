<?php

namespace CodeBase\Models;

use Illuminate\Database\Eloquent\Model;

class PermissionGroup extends Model
{

    protected $table = 'permissions_group';

    protected $fillable = [
        'parent_id','name','sort'
    ];

    public function children()
    {
        return $this->hasMany(PermissionGroup::class, 'parent_id', 'id');
    }

    public function permissions()
    {
        return $this->hasMany(Permission::class, 'group_id');
    }

}
