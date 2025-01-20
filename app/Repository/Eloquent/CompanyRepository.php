<?php

namespace App\Repository\Eloquent;

use App\Models\Company;
use Illuminate\Support\Arr;
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

    public function createCompany(array $data): CompanyResource
    {
        $company = $this->create(Arr::except($data, ['company_type_ids', 'domains', 'subdomains']));
        $company->companyTypes()->attach($data['company_type_ids']);
        // dD($data['domains']);
        $company->domains()->createMany($data['domains']);
        $company->subdomains()->createMany($data['subdomains']);

        return $this->resource::make($company);
    }

    public function updateCompany(Model $model, array $data): bool
    {
        // dd($model->domains());

        if (isset($data['company_type_ids'])) {
            $model->companyTypes()->sync($data['company_type_ids']);
        }
        if (isset($data['domains'])) {
            $model->domains()->delete();
            $model->domains()->createMany($data['domains']);
        }
        if (isset($data['subdomains'])) {
            $model->subdomains()->delete();
            $model->subdomains()->createMany($data['subdomains']);
        }

        $model->update(Arr::except($data, ['company_type_ids', 'domains', 'subdomains']));
        return true;
    }

}
