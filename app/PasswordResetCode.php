<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PasswordResetCode extends Model
{
    protected $table = 'password_resets_code';

    protected $fillable = ['email','code','times'];
}
