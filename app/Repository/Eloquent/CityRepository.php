<?php

namespace App\Repository\Eloquent;

use App\Models\City;
use Illuminate\Database\Eloquent\Model;
use App\Http\Resources\CityResource;
use App\Repository\Contracts\CityRepositoryInterface;

class CityRepository extends BaseRepository implements CityRepositoryInterface
{
    /**
     * CityRepository constructor.
     *
     * @param City $model
     */
    public function __construct(City $model)
    {
        $this->model = $model;
        $this->resource = CityResource::class;
    }

}
