<?php

namespace App\Repository\Eloquent;

use Illuminate\Support\Arr;
use App\Models\ShippingLine;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Http\Resources\ShippingLineResource;
use App\Repository\Contracts\ShippingLineRepositoryInterface;

class ShippingLineRepository extends BaseRepository implements ShippingLineRepositoryInterface
{
    /**
     * ShippingLineRepository constructor.
     *
     * @param ShippingLine $model
     */
    public function __construct(ShippingLine $model)
    {
        $this->model = $model;
        $this->resource = ShippingLineResource::class;
    }

    public function createShippingLine(array $data): ShippingLineResource
    {
        $shippingLine = $this->create(Arr::except($data, ['agent_ids','bank_ids']));    
        $shippingLine->agents()->attach(@$data['agent_ids']);
        $shippingLine->banks()->attach(@$data['bank_ids']);

        return $this->resource::make($shippingLine);
    }

    public function updateShippingLine(Model $model, array $data): bool
    {
        if (isset($data['bank_ids'])) {
            $model->banks()->sync($data['bank_ids']);
        }

        if (isset($data['agent_ids'])) {
            $model->agents()->sync($data['agent_ids']);
        }

        $model->update(Arr::except($data, ['agent_ids','bank_ids']));
        return true;
    }

}
