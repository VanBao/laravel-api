<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookingService extends Model
{
    //
    protected $table = 'booking_service';

    protected $guarded = [];

    public $timestamps = false;

    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id', 'id');
    }

    public function service_price()
    {
        return $this->belongsTo(ServicePrice::class, 'service_price_id', 'id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id', 'id');
    }
}
