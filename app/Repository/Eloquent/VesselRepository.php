<?php

namespace App\Repository\Eloquent;

use App\Models\Vessel;
use Illuminate\Database\Eloquent\Model;
use App\Http\Resources\VesselResource;
use App\Repository\Contracts\VesselRepositoryInterface;

class VesselRepository extends BaseRepository implements VesselRepositoryInterface
{
    /**
     * VesselRepository constructor.
     *
     * @param Vessel $model
     */
    public function __construct(Vessel $model)
    {
        $this->model = $model;
        $this->resource = VesselResource::class;
    }

}
