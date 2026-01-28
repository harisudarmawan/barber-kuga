<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ServiceCategories extends Model
{
    protected $guarded = ['id'];

    // Satu category bisa memiliki banyak service
    public function services(): HasMany
    {
        return $this->hasMany(Service::class, 'category_id');
    }
}
