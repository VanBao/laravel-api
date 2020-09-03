<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookingRating extends Model
{
    protected $table = 'booking_rating';

    protected $guarded = [];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class, 'uid', 'id');
    }

    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id', 'id');
    }
}
