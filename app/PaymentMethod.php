<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    protected $table = 'payment_methods';

    protected $guarded = [];

    protected $hidden = ['name_en'];

    public function booking()
    {
        return $this->hasOne(Booking::class, 'payment_method_id', 'id');
    }

    public function getAvatarAttribute($value) {
        return asset('uploads/'. $value);
    }

    public function getNameAttribute($value) {
        if(auth()->check()) {
            if(user_setting('language') == 'en') {
                return $this->name_en;
            }
        };
        return $value;
    }
}
