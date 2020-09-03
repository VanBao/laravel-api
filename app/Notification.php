<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{

    protected $table = 'notifications';

    protected $guarded = [];

    public function getImageAttribute($value)
    {
        return $value ? asset('uploads/' . $value) : null;
    }

    public function notification_uid()
    {
        return $this->belongsToMany(Notification::class, 'notification_uid','notification_id', 'uid');

//        return $this->belongsToMany(NotificationUid::class,'notification_uid', 'notification_id', 'id');
    }

}
