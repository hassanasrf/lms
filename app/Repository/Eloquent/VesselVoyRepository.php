<?php

namespace App\Repository\Eloquent;

use App\Models\VesselVoy;
use Illuminate\Database\Eloquent\Model;
use App\Http\Resources\VesselVoyResource;
use App\Repository\Contracts\VesselVoyRepositoryInterface;

class VesselVoyRepository extends BaseRepository implements VesselVoyRepositoryInterface
{
    /**
     * VesselVoyRepository constructor.
     *
     * @param VesselVoy $model
     */
    public function __construct(VesselVoy $model)
    {
        $this->model = $model;
        $this->resource = VesselVoyResource::class;
    }

}
