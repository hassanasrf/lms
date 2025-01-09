<?php

namespace App\Repository\Eloquent;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Model;
use App\Http\Resources\CustomerResource;
use App\Repository\Contracts\CustomerRepositoryInterface;

class CustomerRepository extends BaseRepository implements CustomerRepositoryInterface
{
    /**
     * CustomerRepository constructor.
     *
     * @param Customer $model
     */
    public function __construct(Customer $model)
    {
        $this->model = $model;
        $this->resource = CustomerResource::class;
    }

}
