<?php

namespace App\Repository\Eloquent;

use App\Models\City;
use Illuminate\Database\Eloquent\Model;
use App\Http\Resources\CommodityResource;
use App\Repository\Contracts\CommodityRepositoryInterface;

class CommodityRepository extends BaseRepository implements CommodityRepositoryInterface
{
    /**
     * CommodityRepository constructor.
     *
     * @param Commodity $model
     */
    public function __construct(Commodity $model)
    {
        $this->model = $model;
        $this->resource = CommodityResource::class;
    }

}
