<?php

namespace App\Http\Controllers;

use App\User;
use App\UserSetting;
use Illuminate\Http\Request;

class OneSignalController extends WebDriverController
{
    public function update(Request $request)
    {
        if ($request->ajax()) {
            $request->validate([
                'user_id' => 'required|string'
            ]);
            $userSetting = UserSetting::where('uid', auth()->user()->id)->where('setting_code', 'onesignal_user_id');
            if ($userSetting->exists()) {
                $userSetting->update([
                    'value' => $request->user_id,
                    'created_at' => now()
                ]);
            } else {
                UserSetting::create([
                    'uid' => auth()->user()->id,
                    'setting_code' => 'onesignal_user_id',
                    'value' => $request->user_id,
                    'created_at' => now()
                ], ['uid' => auth()->user()->id]);
            }
            return response()->json(true);
        }
        return response()->json(false);
    }
}
