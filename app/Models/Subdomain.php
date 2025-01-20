<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Subdomain extends Model
{
    use HasFactory;

    protected $fillable = ['company_id', 'name'];

    /**
     * Get the company associated with the company.
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    // Ensure name is always lowercase when stored
    public static function boot()
    {
        parent::boot();
        static::saving(function ($name) {
            $name->name = strtolower($name->name);
        });
    }
}
