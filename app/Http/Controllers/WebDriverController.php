<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebDriverController extends Controller
{
    public function __construct()
    {
        auth()->setDefaultDriver('web');
    }
}
