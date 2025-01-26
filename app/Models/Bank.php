<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasCompany;

class Bank extends Model
{
    use HasFactory, HasCompany, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Get the connected currency for the commodity.
     */
    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }


    /**
     * Get the customer types associated with the bank.
     */
    public function customerTypes(): BelongsToMany
    {
        return $this->belongsToMany(CustomerType::class, 'bank_customer_type');
    }

    /**
     * Get the country that the bank belongs to.
     */
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * Get the city that the bank belongs to.
     */
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }
}
