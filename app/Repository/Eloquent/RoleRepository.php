<?php

namespace App\Repository\Eloquent;

use Spatie\Permission\Models\Role;
use App\Http\Resources\RoleResource;
use Illuminate\Database\Eloquent\Model;
use App\Repository\Contracts\RoleRepositoryInterface;
use App\Models\User;

class RoleRepository extends BaseRepository implements RoleRepositoryInterface
{
    /**
     * RoleRepository constructor.
     *
     * @param Role $model
     * @param User $userModel
     */
    public function __construct(Role $model, User $userModel)
    {
        $this->model = $model;
        $this->userModel = $userModel;
        $this->resource = RoleResource::class;
    }

    public function createRole(array $data): RoleResource
    {
        $role = $this->create(['name' => $data['name']]);
        $role->syncPermissions($data['permission']);
        return $this->resource::make($role);
    }

    public function updateRole(Model $model, array $data): bool
    {
        $model->name = $data['name'];
        $model->save();
        $model->syncPermissions($data['permission']);

        // Assign the role to multiple users
        if (isset($data['user_ids'])) {
            $role = $model->name;
            $this->userModel->whereIn('id', $data['user_ids'])->each(function ($user) use ($role) {
                $user->assignRole($role);
            });
        }

        return true;
    }
}
