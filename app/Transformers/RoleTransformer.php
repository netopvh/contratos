<?php

namespace CodeBase\Transformers;

use League\Fractal\TransformerAbstract;
use CodeBase\Models\Role;

/**
 * Class RoleTransformer
 * @package namespace CodeBase\Transformers;
 */
class RoleTransformer extends TransformerAbstract
{

    /**
     * Transform the \Role entity
     * @param \Role $model
     *
     * @return array
     */
    public function transform(Role $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
