<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NotificationUid extends Model
{
    protected $table = 'notification_uid';
    protected $guarded = [];
    public $timestamps = false;

    public function notification() {
        return $this->belongsTo(Notification::class,'notification_id','id');
    }

    public function uid() {
        return $this->belongsTo(User::class,'uid','id');
    }
}
