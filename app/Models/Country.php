<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasCompany;

class Country extends Model
{
    use HasFactory, HasCompany, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Get all the tagging points for the country.
     */
    public function taggingPoints(): HasMany
    {
        return $this->hasMany(TaggingPoint::class);
    }

    /**
     * Get all the cities for the country.
     */
    public function cities(): HasMany
    {
        return $this->hasMany(City::class);
    }

    /**
     * Get all the agents for the country.
     */
    public function agents(): HasMany
    {
        return $this->hasMany(Agent::class);
    }
}
