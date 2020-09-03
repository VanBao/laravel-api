<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserSetting extends Model
{
    protected $table = 'user_setting';

    protected $guarded = [];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class, 'uid', 'id');
    }

    public function setting()
    {
        return $this->belongsTo(Setting::class, 'setting_code', 'code');
    }
}
