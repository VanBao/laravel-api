<?php

namespace App\Http\Controllers\Api;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function __construct()
    {
//        ['except' => ['login', 'register', 'sendCode', 'submitCode', 'changePassword']]
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
            $category = Category::where('id', $request->id)->where('status',1);
            if (!$category->exists()) {
                return response()->json([
                    'status' => false,
                    'code' => error_code('NOT_FOUND_RECORD'),
                    'message' => 'Failed.',
                    'data' => []
                ]);
            }
            $data = [$category->with('services')->first()->toArray()];
        } else {
            $data = Category::where('status',1)->get()->toArray();
        }

        return response()->json([
            'status' => true,
            'code' => 0,
            'message' => 'Success.',
            'data' => $data
        ]);
    }
}
