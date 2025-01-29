<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasCompany;

class TaggingPoint extends Model
{
    use HasFactory, HasCompany, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Get the city that owns the TaggingPoint.
     */
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    /**
     * Get the country that owns the TaggingPoint.
     */
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function voyagesAsTerminal(): HasMany
    {
        return $this->hasMany(Voyage::class, 'terminal_id');
    }

    public function voyagesAsLastCall(): HasMany
    {
        return $this->hasMany(Voyage::class, 'last_call_id');
    }

    public function voyagesAsNextCall(): HasMany
    {
        return $this->hasMany(Voyage::class, 'next_call_id');
    }

    public function voyages(): BelongsToMany
    {
        return $this->belongsToMany(Voyage::class, 'voyage_routing', 'routing_id', 'voyage_id');
    }
}
