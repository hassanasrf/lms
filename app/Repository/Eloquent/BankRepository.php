<?php

namespace App\Repository\Eloquent;

use App\Models\Bank;
use Illuminate\Database\Eloquent\Model;
use App\Http\Resources\BankResource;
use App\Repository\Contracts\BankRepositoryInterface;

class BankRepository extends BaseRepository implements BankRepositoryInterface
{
    /**
     * BankRepository constructor.
     *
     * @param Bank $model
     */
    public function __construct(Bank $model)
    {
        $this->model = $model;
        $this->resource = BankResource::class;
    }

}
