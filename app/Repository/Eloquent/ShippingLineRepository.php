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
        return DB::transaction(function () use ($data) {
            $shippingLine = $this->create(Arr::except($data, ['agents','bank_ids']));    
            
            if (!empty($data['agents'])) {
                $pivotData = collect($data['agents'])->mapWithKeys(function($agent) {
                    return [
                        $agent['agent_id'] => [
                            'payment_type' => $agent['payment_type'] ?? null,
                            'credit_type'  => $agent['credit_type'] ?? null,
                        ]
                    ];
                })->toArray();

                // Attach all agents with pivot data at once
                $shippingLine->agents()->attach($pivotData);
            }

            $shippingLine->banks()->attach(@$data['bank_ids']);

            return $this->resource::make($shippingLine);
        });
    }

    public function updateShippingLine(Model $model, array $data): bool
    {
        return DB::transaction(function () use ($model, $data) {

            if (isset($data['bank_ids'])) {
                $model->banks()->sync($data['bank_ids']);
            }

            // Sync agents with pivot data
            if (isset($data['agents'])) {
                $pivotData = collect($data['agents'])->mapWithKeys(function ($agent) {
                    return [
                        $agent['agent_id'] => [
                            'payment_type' => $agent['payment_type'] ?? null,
                            'credit_type'  => $agent['credit_type'] ?? null,
                        ]
                    ];
                })->toArray();

                $model->agents()->sync($pivotData);
            }

            $model->update(Arr::except($data, ['agents', 'bank_ids']));

            return true;
        });
    }

}
