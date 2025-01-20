<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasCompany;

class VesselVoy extends Model
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
        'routing' => 'array',
        'additional_ports' => 'array',
        'via_ports' => 'array',
        'slot_partners' => 'array',
    ];

    /**
     * The shipping line associated with the vessel voyage.
     */
    public function shippingLine()
    {
        return $this->belongsTo(ShippingLine::class, 'shipping_line_id');
    }

    /**
     * The agent associated with the vessel voyage.
     */
    public function agent()
    {
        return $this->belongsTo(Agent::class, 'agent_id');
    }

    /**
     * The country associated with the vessel voyage.
     */
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    // /**
    //  * The routing ports associated with the vessel voyage.
    //  */
    // public function routingCountries()
    // {
    //     return $this->hasManyThrough(Country::class, Routing::class, 'vessel_voy_id', 'id', 'id', 'country_id');
    // }

    // /**
    //  * The additional ports associated with the vessel voyage.
    //  */
    // public function additionalPorts()
    // {
    //     return $this->hasManyThrough(Country::class, AdditionalPort::class, 'vessel_voy_id', 'id', 'id', 'country_id');
    // }

    // /**
    //  * The via ports associated with the vessel voyage.
    //  */
    // public function viaPorts()
    // {
    //     return $this->hasManyThrough(Country::class, ViaPort::class, 'vessel_voy_id', 'id', 'id', 'country_id');
    // }

    // /**
    //  * The slot partners associated with the vessel voyage.
    //  */
    // public function slotPartners()
    // {
    //     return $this->hasMany(SlotPartner::class, 'vessel_voy_id');
    // }
}
