<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasCompany;

class Booking extends Model
{
    use HasFactory, HasCompany, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Get the company that owns the booking.
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Get the customer associated with the booking.
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Get the loading point associated with the booking.
     */
    public function loadingPoint(): BelongsTo
    {
        return $this->belongsTo(TaggingPoint::class, 'loading_point_id');
    }

    /**
     * Get the commodity associated with the booking.
     */
    public function commodity(): BelongsTo
    {
        return $this->belongsTo(Commodity::class);
    }

    /**
     * Get the destination country associated with the booking.
     */
    public function destinationCountry(): BelongsTo
    {
        return $this->belongsTo(TaggingPoint::class, 'destination_country_id');
    }

    /**
     * Get the shipping line associated with the booking.
     */
    public function shippingLine(): BelongsTo
    {
        return $this->belongsTo(ShippingLine::class);
    }

    /**
     * Get the vessel associated with the booking.
     */
    public function vessel(): BelongsTo
    {
        return $this->belongsTo(Vessel::class);
    }

    /**
     * Get the service types associated with the booking.
     */
    public function serviceTypes(): BelongsToMany
    {
        return $this->belongsToMany(ServiceType::class, 'booking_service_type', 'booking_id', 'service_type_id');
    }
}
