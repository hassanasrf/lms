<?php
namespace App\Repository\Eloquent;

use Exception;
use App\Models\User;
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
