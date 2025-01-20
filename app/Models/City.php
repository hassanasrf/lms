<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasCompany;

class City extends Model
{
    use HasFactory, HasCompany, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Get all the tagging points for the city.
     */
    public function taggingPoints(): HasMany
    {
        return $this->hasMany(TaggingPoint::class);
    }

    /**
     * Get the country associated with the company.
     */
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }
}
