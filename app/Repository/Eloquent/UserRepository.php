<?php
namespace App\Repository\Eloquent;

use Exception;
use App\Models\User;
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
        $user = $this->create(Arr::except($data, ['role','company_id']));
        $role = isset($data['role']) ? $data['role'] : [];
        $user->company()->associate($data['company_id']);
        $user->syncRoles($role);
        return $this->resource::make($user);
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
