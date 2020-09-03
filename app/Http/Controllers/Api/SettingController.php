<?php

namespace App\Http\Controllers\Api;

use App\Setting;
use App\UserSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api',['except' => 'system']);
    }

    public function index(Request $request)
    {
        if ($request->has('field') && $request->field == 'language') {
            $instance = UserSetting::where('uid', auth()->user()->id);
            if ($instance->exists()) {
                if ($instance->where('setting_code', 'language')->exists()) {
                    $user = $instance->get()->toArray();
                    return response()->json([
                        'status' => true,
                        'code' => 0,
                        'message' => 'Success.',
                        'data' => $user
                    ]);
                } else {
                    return response()->json([
                        'status' => true,
                        'code' => 0,
                        'message' => 'Success.',
                        'data' => []
                    ]);
                }
            }
        }

        $user = User::where('id', auth()->user()->id)->with('user_setting')->first()->toArray();

        return response()->json([
            'status' => true,
            'code' => 0,
            'message' => 'Success.',
            'data' => $user['user_setting']
        ]);
    }

    public function system(Request $request) {
        if ($request->has('field') && ($request->field == 'email' || $request->field == 'phone' || $request->field == 'maintenance_text')) {
            $instance = Setting::where('code', $request->field);
            if ($instance->exists()) {
                return response()->json([
                    'status' => true,
                    'code' => 0,
                    'message' => 'Success.',
                    'data' => [$instance->first()->toArray()]
                ]);
            }
        }else{
            return response()->json([
                'status' => false,
                'code' => error_code('VALUE_NOT_VALID'),
                'message' => 'Failed.',
                'data' => []
            ]);
        }
    }

    public function update(Request $request)
    {
        $request->validate([
            'field' => 'required|in:language',
            'value' => 'required|string'
        ]);

        if ($request->field == 'language') {
            if ($request->value == 'vi' || $request->value == 'en') {
                UserSetting::updateOrCreate([
                    'uid' => auth()->user()->id,
                    'setting_code' => 'language'
                ], [
                    'uid' => auth()->user()->id,
                    'value' => $request->value
                ]);

                return response()->json([
                    'status' => true,
                    'code' => 0,
                    'message' => 'Success.',
                    'data' => [

                    ]
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'code' => error_code('VALUE_NOT_VALID'),
                    'message' => 'Failed.',
                    'data' => []
                ]);
            }
        }
    }
}
