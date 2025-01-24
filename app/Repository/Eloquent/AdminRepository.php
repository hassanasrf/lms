<?php
namespace App\Repository\Eloquent;

use Exception;
use App\Models\Admin;
use App\Http\Resources\AdminResource;
use Illuminate\Database\Eloquent\Model;
use App\Repository\Contracts\AdminRepositoryInterface;

class AdminRepository extends BaseRepository implements AdminRepositoryInterface
{
    /**
     * AdminRepository constructor.
     *
     * @param Admin $model
     */
    public function __construct(Admin $model)
    {
        $this->model = $model;
        $this->resource = AdminResource::class;
    }
}
