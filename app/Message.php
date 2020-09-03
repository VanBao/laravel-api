<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $guarded = [];

    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id', 'id');
    }

    public function from()
    {
        return $this->belongsTo(User::class, 'from', 'id');
    }

    public function to()
    {
        return $this->belongsTo(User::class, 'to', 'id');
    }

    public function getCreatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('H:i:s d-m-Y');
    }
}
