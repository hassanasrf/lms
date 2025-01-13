<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

trait HasCompany
{
    /**
     * Determine if the current guard should bypass the company filter.
     *
     * @return bool
     */
    protected static function shouldBypassCompanyFilter(): bool
    {
        return Auth::guard('admin')->check(); // Adjust this as needed for other bypass conditions
    }

    /**
     * Boot the HasCompany trait and add a global scope to filter by company_id.
     */
    protected static function bootHasCompany()
    {
        static::addGlobalScope('company', function (Builder $builder) {
            // Skip applying the global scope if the guard bypasses it
            if (static::shouldBypassCompanyFilter()) {
                return;
            }

            // Apply the global scope for all other guards
            if (Auth::check()) {
                $builder->where('company_id', Auth::user()->company_id);
            }
        });

        static::creating(function ($model) {
            // Skip setting the company_id if the guard bypasses it
            if (static::shouldBypassCompanyFilter()) {
                return;
            }

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
