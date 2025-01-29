<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasCompany;

class ShippingLine extends Model
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
        //
    ];


    /**
     * Get the banks associated with the shipping line.
     */
    public function banks(): BelongsToMany
    {
        return $this->belongsToMany(Bank::class, 'shipping_line_bank');
    }

    /**
     * Get the agents associated with the shipping line.
     */
    public function agents(): BelongsToMany
    {
        return $this->belongsToMany(Agent::class, 'shipping_line_agent');
    }

    /**
     * Get the bookings for the shipping line.
     */
    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }
}
