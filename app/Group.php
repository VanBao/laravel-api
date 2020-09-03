<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table = 'groups';

    protected $guarded = [];

    public function user()
    {
        return $this->hasOne(User::class, 'group_id', 'id');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'group_role', 'group_id', 'role_id');
    }
}
