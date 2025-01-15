<?php
namespace App\Repository\Eloquent;

use Exception;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Arr;
use App\Http\Resources\UserResource;
use Illuminate\Database\Eloquent\Model;
use App\Repository\Contracts\UserRepositoryInterface;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{

    /**
     * UserRepository constructor.
     *
     * @param User $model
     */
    public function __construct(User $model)
    {
        $this->model = $model;
        $this->resource = UserResource::class;
    }

    public function createUser(array $data): UserResource
    {
        $user = $this->create(Arr::except($data, ['role_id']));
        $roleId = isset($data['role_id']) ? $data['role_id'] : [];
        $role = Role::findById($roleId, 'api');
        $user->assignRole($role);
        return $this->resource::make($user);
    }

    public function updateUser(Model $model, array $data): bool
    {
        $model->update(Arr::except($data, ['role_id']));
        if (isset($data['role_id'])) {
            $roleId = $data['role_id'];
            $role = Role::findById($roleId, 'api');
            $model->syncRoles([$role]);
        }
        return true;
    }

     /**
     * summary profileUpdate
     *
     * @param array $data
     * @return UserResource
     */
    public function profileUpdate(array $data): UserResource
    {
        $this->update($this->currentUser()->id, $data);
        return $this->resource::make($this->currentUser()->refresh());
    }
}
