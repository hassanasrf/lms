<?php

namespace App\Repository\Eloquent;

use App\Models\Customer;
use Illuminate\Support\Arr;
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

    public function createCustomer(array $data): CustomerResource
    {
        $customer = $this->create(Arr::except($data, ['customer_type_ids']));
        $customer->customerTypes()->attach($data['customer_type_ids']);
        return $this->resource::make($customer);
    }

    public function updateCustomer(Model $model, array $data): bool
    {
        $model->update(Arr::except($data, ['customer_type_ids']));

        if (isset($data['customer_type_ids'])) {
            $model->customerTypes()->sync($data['customer_type_ids']);
        }
        return true;
    }

}
