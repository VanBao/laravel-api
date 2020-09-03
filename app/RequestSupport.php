<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestSupport extends Model
{
    protected $table = 'request_supports';

    protected $guarded = [];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class, 'uid', 'id');
    }
}
