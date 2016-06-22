<?php
/**
 * Created by PhpStorm.
 * User: angelo.neto
 * Date: 25/04/2016
 * Time: 16:22
 */

namespace CodeBase\Models;

use Zizaco\Entrust\EntrustRole;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;


class Role extends EntrustRole implements Transformable
{

    use TransformableTrait;

    protected $fillable = [
        'name','display_name','description'
    ];

    public function users()
    {
        return $this->belongsToMany('CodeBase\Models\User');
    }

}