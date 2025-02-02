<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasCompany;

class Voyage extends Model
{
    use HasFactory, HasCompany, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

     /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'slot_partners' => 'array',
    ];

    /**
     * The vessel associated with the voyage.
     */
    public function vessel(): BelongsTo
    {
        return $this->belongsTo(Vessel::class);
    }

    /**
     * The teminal associated with the voyage.
     */
    public function terminal(): BelongsTo
    {
        return $this->belongsTo(TaggingPoint::class, 'terminal_id');
    }

    /**
     * The last call associated with the voyage.
     */
    public function lastCall(): BelongsTo
    {
        return $this->belongsTo(TaggingPoint::class, 'last_call_id');
    }

    /**
     * The next call associated with the voyage.
     */
    public function nextCall(): BelongsTo
    {
        return $this->belongsTo(TaggingPoint::class, 'next_call_id');
    }


    /**
     * Get the bookings for the voyage.
     */
    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    /**
     * Get the routings associated with the voyage.
     */
    public function routings(): BelongsToMany
    {
        return $this->belongsToMany(TaggingPoint::class, 'voyage_routing', 'voyage_id', 'routing_id');
    }
}
