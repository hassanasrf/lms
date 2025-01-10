<?php

namespace App\Repository\Eloquent;

use App\Models\Currency;
use Illuminate\Database\Eloquent\Model;
use App\Http\Resources\CurrencyResource;
use App\Repository\Contracts\CurrencyRepositoryInterface;

class CurrencyRepository extends BaseRepository implements CurrencyRepositoryInterface
{
    /**
     * CurrencyRepository constructor.
     *
     * @param Currency $model
     */
    public function __construct(Currency $model)
    {
        $this->model = $model;
        $this->resource = CurrencyResource::class;
    }

}
