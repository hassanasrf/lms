<?php

namespace App\Repository\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;
use App\Http\Resources\PermissionResource;
use App\Repository\Contracts\PermissionRepositoryInterface;

class PermissionRepository extends BaseRepository implements PermissionRepositoryInterface
{
    /**
     * PermissionRepository constructor.
     *
     * @param Permission $model
     */
    public function __construct(Permission $model)
    {
        $this->model = $model;
        $this->resource = PermissionResource::class;
    }

}
