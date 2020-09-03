<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'booking';

    protected $guarded = [];

    public function payment_method()
    {
        return $this->belongsTo(PaymentMethod::class, 'payment_method_id', 'id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'uid', 'id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

    public function staff()
    {
        return $this->belongsTo(User::class, 'staff_id', 'id');
    }

    public function booking_services()
    {
        return $this->hasMany(BookingService::class, 'booking_id', 'id');
    }

    public function messages()
    {
        return $this->hasMany(Message::class, 'booking_id', 'id');
    }

    public function booking_rating()
    {
        return $this->hasOne(BookingRating::class, 'booking_id', 'id');
    }

    public function getImagesAttribute($value)
    {
        return json_decode($value, true);
    }
}
