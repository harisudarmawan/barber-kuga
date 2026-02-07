<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpecialPackage extends Model
{
    protected $fillable = [
        'name',
        'price',
        'features',
        'is_popular',
        'sort_order',
        'period',
    ];

    protected $casts = [
        'features' => 'array',
        'is_popular' => 'boolean',
    ];
}
