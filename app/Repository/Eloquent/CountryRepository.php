<?php

namespace App\Repository\Eloquent;

use App\Models\Country;
use Illuminate\Database\Eloquent\Model;
use App\Http\Resources\CountryResource;
use App\Repository\Contracts\CountryRepositoryInterface;

class CountryRepository extends BaseRepository implements CountryRepositoryInterface
{
    /**
     * CountryRepository constructor.
     *
     * @param Country $model
     */
    public function __construct(Country $model)
    {
        $this->model = $model;
        $this->resource = CountryResource::class;
    }

}
