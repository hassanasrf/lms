<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

trait HasCompany
{
    /**
     * Boot the HasCompany trait and add a global scope to filter by company_id.
     *
     * Automatically applies filtering and handles `company_id` assignment.
     */
    protected static function bootHasCompany()
    {
        // Add a global scope to filter records by the authenticated user's company_id
        static::addGlobalScope('company', function (Builder $builder) {
            if (Auth::check()) {
                $builder->where('company_id', Auth::user()->company_id);
            }
        });

        // Automatically set the company_id during record creation
        static::creating(function ($model) {
            if (Auth::check() && empty($model->company_id)) {
                $model->company_id = Auth::user()->company_id;
            }
        });
    }

    /**
     * Query scope to disable the company_id global filter.
     *
     * Example:
     * City::withoutCompanyFilter()->get();
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithoutCompanyFilter(Builder $query)
    {
        return $query->withoutGlobalScope('company');
    }
}
