<?php

namespace App\Repository\Eloquent;

use App\Models\Company;
use Illuminate\Database\Eloquent\Model;
use App\Http\Resources\CompanyResource;
use App\Repository\Contracts\CompanyRepositoryInterface;

class CompanyRepository extends BaseRepository implements CompanyRepositoryInterface
{
    /**
     * CompanyRepository constructor.
     *
     * @param Company $model
     */
    public function __construct(Company $model)
    {
        $this->model = $model;
        $this->resource = CompanyResource::class;
    }

}
