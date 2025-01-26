<?php

namespace App\Repository\Eloquent;

use App\Models\Bank;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\BankResource;
use Illuminate\Database\Eloquent\Model;
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

    public function createBank(array $data): BankResource
    {
        $bank = $this->create(Arr::except($data, ['type_ids']));
        
        if (!empty($data['type_ids'])) {
            $bank->customerTypes()->attach($data['type_ids']);
        } else {
            $allCustomerTypes = DB::table('customer_types')->pluck('id');
            $bank->customerTypes()->attach($allCustomerTypes);
        }

        return $this->resource::make($bank);
    }

    public function updateBank(Model $model, array $data): bool
    {
        if (!empty($data['type_ids'])) {
            $model->customerTypes()->sync($data['type_ids']);
        } else {
            $allCustomerTypes = DB::table('customer_types')->pluck('id');
            $model->customerTypes()->sync($allCustomerTypes);
        }

        $model->update(Arr::except($data, ['type_ids']));
        return true;
    }

}
