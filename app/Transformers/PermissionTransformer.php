<?php

namespace CodeBase\Transformers;

use League\Fractal\TransformerAbstract;
use CodeBase\Models\Permission;

/**
 * Class PermissionTransformer
 * @package namespace CodeBase\Transformers;
 */
class PermissionTransformer extends TransformerAbstract
{

    /**
     * Transform the \Permission entity
     * @param \Permission $model
     *
     * @return array
     */
    public function transform(Permission $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
