<?php

namespace App\Repository\Eloquent;

use App\Models\ShippingLine;
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

}
