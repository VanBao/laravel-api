<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServicePrice extends Model
{
    protected $table = 'service_prices';

    protected $guarded = [];

    public function service() {
        return $this->belongsTo(Service::class,'service_id','id');
    }

    public function booking_services() {
        return $this->hasMany(BookingService::class, 'service_id', 'id');
    }

    public function getAvatarAttribute($value) {
        return asset('uploads/' . $value);
    }
}
