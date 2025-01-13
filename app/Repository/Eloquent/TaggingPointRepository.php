<?php

namespace App\Repository\Eloquent;

use App\Models\TaggingPoint;
use Illuminate\Database\Eloquent\Model;
use App\Http\Resources\TaggingPointResource;
use App\Repository\Contracts\TaggingPointRepositoryInterface;

class TaggingPointRepository extends BaseRepository implements TaggingPointRepositoryInterface
{
    /**
     * TaggingPointRepository constructor.
     *
     * @param TaggingPoint $model
     */
    public function __construct(TaggingPoint $model)
    {
        $this->model = $model;
        $this->resource = TaggingPointResource::class;
    }

}
