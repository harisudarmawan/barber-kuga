<?php

namespace App\Models;

use App\Enums\PaymentMethods;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $guarded = [];

    // enum
    protected $casts = [
        'payment_method' => PaymentMethods::class,
    ];

    // relasi dengan barber, satu booking hanya bisa memiliki satu barber
    public function barber()
    {
        return $this->belongsTo(Barber::class);
    }

    // relasi dengan service, satu booking hanya bisa memiliki satu service
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
