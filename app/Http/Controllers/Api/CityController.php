<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\City;

class CityController extends Controller
{
    //
    public function index(Request $request)
    {
        $data = City::all()->toArray();
        return response()->json([
            'status' => true,
            'code' => 0,
            'message' => 'Success.',
            'data' => $data
        ]);
    }

}
