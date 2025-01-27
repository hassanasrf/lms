<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasCompany;

class Agent extends Model
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
        'contact_persons' => 'array',
        'contact_numbers' => 'array',
        'email_ids' => 'array',
        'ports' => 'array',
    ];


    /**
     * Get the shipping lines associated with the agent.
     */
    public function shippingLines(): BelongsToMany
    {
        return $this->belongsToMany(ShippingLine::class, 'shipping_line_agent');
    }
}
