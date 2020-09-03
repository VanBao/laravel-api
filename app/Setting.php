<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    //

    protected $fillable = [
        'code',
        'type',
        'value'
    ];

    public $timestamps = false;

    public function user_setting()
    {
        return $this->hasMany(UserSetting::class, 'setting_code', 'code');
    }
}
