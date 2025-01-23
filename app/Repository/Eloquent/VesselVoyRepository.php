<?php

namespace App\Repository\Eloquent;

use App\Models\Vessel;
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
    public function __construct(Vessel $model)
    {
        $this->model = $model;
        $this->resource = VesselVoyResource::class;
    }

}
