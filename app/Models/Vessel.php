<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasCompany;

class Vessel extends Model
{
    use HasFactory, HasCompany, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

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
     * The company associated with the vessel.
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * The voyages associated with the vessel.
     */
    public function voyages()
    {
        return $this->hasMany(Voyage::class);
    }

}
