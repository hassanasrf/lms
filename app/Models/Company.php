<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Eloquent\Model;
use App\Models\Role;

class Company extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Get the city associated with the company.
     */
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    /**
     * Get the country associated with the company.
     */
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * Get the type associated with the company.
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class);
    }

    /**
     * Get the users associated with the company.
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function companyTypes(): BelongsToMany
    {
        return $this->belongsToMany(CompanyType::class, 'company_company_type');
    }

    /**
     * Auto create role and assign all available permissions when a company is created.
     */
    protected static function booted()
    {
        static::created(function ($company) {
            // Create role for this company
            $role = Role::firstOrCreate(
                [
                    'name' => 'super-admin',
                    'guard_name' => 'api',
                    'company_id' => $company->id,
                ]
            );

            // Get all permissions, excluding the specific ones
            $permissions = Permission::whereNotIn('name', [
                'company-read','company-create','company-update','company-delete'
            ])->get();

            // Assign all permissions except the excluded ones to the role
            $role->syncPermissions($permissions);
        });
    }
}
