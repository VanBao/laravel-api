<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;

class SettingController extends WebDriverController
{
    public function index()
    {
        return view('setting.index');
    }

    public function update(Request $request)
    {
        $fields = $request->all();
        if(!isset($fields['need_login'])) $fields['need_login'] = 'off';
        if(!isset($fields['is_maintenance'])) $fields['is_maintenance'] = 'off';
        foreach ($fields as $index => $value) {
            $instance = Setting::where('code', $index);
            if ($instance->exists()) {
                $instance->update([
                   'value' => $value
                ]);
            }
        }
        return redirect()->route('admin.setting.index');
    }
}
