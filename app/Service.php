<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $guarded = [];

    public function service_prices()
    {
        return $this->hasMany(ServicePrice::class, 'service_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function created_user()
    {
        return $this->belongsTo(User::class, 'created_id', 'id');
    }

    public function booking()
    {
        return $this->hasMany(Booking::class, 'service_id', 'id');
    }

//    public function booking_services()
//    {
//        return $this->hasMany(BookingService::class, 'service_id', 'id');
//    }

    public function getAvatarAttribute($value)
    {
        return asset('uploads/' . $value);
    }

    public function getBackgroundAttribute($value)
    {
        return asset('uploads/' . $value);
    }

    public function getImagesAttribute($value)
    {
        $images = json_decode($value, true);
        array_walk($images, function (&$value, $key) {
            $value = asset('uploads/' . $value);
        });
        return $images;
    }
}
