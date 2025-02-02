<?php

namespace App\Repository\Eloquent;

use App\Models\Voyage;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Model;
use App\Http\Resources\VoyageResource;
use App\Repository\Contracts\VoyageRepositoryInterface;

class VoyageRepository extends BaseRepository implements VoyageRepositoryInterface
{
    /**
     * VoyageRepository constructor.
     *
     * @param Voyage $model
     */
    public function __construct(Voyage $model)
    {
        $this->model = $model;
        $this->resource = VoyageResource::class;
    }

    public function createVoyage(array $data): VoyageResource
    {
        $data['company_id'] = auth()->user()?->company_id;
        $voyage = $this->create(Arr::except($data, ['routing_ids']));
        $voyage->routings()->attach(@$data['routing_ids']);

        return $this->resource::make($voyage);
    }

    public function updateVoyage(Model $model, array $data): bool
    {
        $data['company_id'] = auth()->user()?->company_id;

        if (isset($data['routing_ids'])) {
            $model->routings()->sync($data['routing_ids']);
        }

        $model->update(Arr::except($data, ['routing_ids']));
        return true;
    }

}
