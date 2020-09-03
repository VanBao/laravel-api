<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    //
    protected $table = 'city';

    protected $fillable = [
        'name', 'code', 'location', 'description', 'created_at', 'updated_at'
    ];

    public function city()
    {
        return $this->hasMany(User::class, 'city_id', 'id');
    }

    public function booking()
    {
        return $this->hasMany(Booking::class, 'city_id', 'id');
    }
}
