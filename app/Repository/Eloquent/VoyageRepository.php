<?php

namespace App\Repository\Eloquent;

use App\Models\Voyage;
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

}
