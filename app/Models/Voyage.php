<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Voyage extends Model
{
    use HasFactory, SoftDeletes;

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
     * The vessel associated with the voyage.
     */
    public function vessel()
    {
        return $this->belongsTo(Vessel::class);
    }

    /**
     * The country associated with the voyage.
     */
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }
}
