<?php

namespace App\Http\Controllers\Api;

use App\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServiceController extends Controller
{
    public function __construct()
    {
        $except = [];
        $need_login = setting('need_login');
        if ($need_login == 'off') {
            $except = ['index'];
        }
        $this->middleware('auth:api', ['except' => $except]);
    }

    public function index(Request $request)
    {
        $data = [];
        if ($request->has('id')) {
            $service = Service::where('id', $request->id)->where('status',1);
            if (!$service->exists()) {
                return response()->json([
                    'status' => false,
                    'code' => error_code('NOT_FOUND_RECORD'),
                    'message' => 'Failed.',
                    'data' => []
                ]);
            }
            $data = [$service->with(['service_prices' => function ($query) {
                // user_id is required here*
                $query->where('status', 1);
            }])->first()->toArray()];
        } else $data = Service::where('status',1)->get()->toArray();

        return response()->json([
            'status' => true,
            'code' => 0,
            'message' => 'Success.',
            'data' => $data
        ]);
    }
}
