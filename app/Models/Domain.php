<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
    use HasFactory;

    protected $fillable = ['company_id', 'name'];

    // Ensure name is always lowercase when stored
    public static function boot()
    {
        parent::boot();
        static::saving(function ($name) {
            $name->name = strtolower($name->name);
        });
    }
}
