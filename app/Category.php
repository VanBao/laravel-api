<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];

    public function created_user()
    {
        return $this->belongsTo(User::class, 'created_id', 'id');
    }

    public function updated_user()
    {
        return $this->belongsTo(User::class, 'updated_id', 'id');
    }

    public function services()
    {
        return $this->hasMany(Service::class, 'category_id', 'id');
    }

    public function getAvatarAttribute($value)
    {
        return asset('uploads/' . $value);
    }

    public function getIconAttribute($value)
    {
        return asset('uploads/' . $value);
    }

    public function getBackgroundAttribute($value)
    {
        return asset('uploads/' . $value);
    }
}
