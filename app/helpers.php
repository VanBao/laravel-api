<?php

use App\Setting;

//if (!function_exists('user_setting')) {
//    function user_setting($code)
//    {
//        if (auth()->check()) {
////            return auth()->user()->user_setting()->where('setting_code','');
//        }
//    }
//}

if (!function_exists('setting')) {
    function setting($code)
    {
        $setting = Setting::where('code', $code)->first();
        return $setting ? $setting->value : null;
    }
}

if (!function_exists('error_code')) {
    function error_code($key)
    {
        return config('netvas.errors_code')[$key];
    }
}

if (!function_exists('get_group_type')) {
    function get_group_type($user)
    {
        return $user->group()->first()->type;
    }
}

if (!function_exists('sidebar_active')) {
    function sidebar_active($page, $compare, $has_submenu = false, $class = 'kt-menu__item--active')
    {
        $array = explode('|', $compare);

        if (in_array($page, $array)) return ($has_submenu) ? $class . ' kt-menu__item--open' : $class;
        return '';
    }
}


if (!function_exists('check_token')) {
    function check_token($idUser)
    {
        try {
            $token = \App\User::where('id', $idUser)->first()->makeVisible(['token'])->toArray()['token'];
            $user = \Tymon\JWTAuth\Facades\JWTAuth::setToken($token)->toUser()->toArray();
            if (isset($user['email'])) {
                return true;
            }
            return false;
        } catch (Exception $e) {
            return false;
        }
    }
}

if (!function_exists('user_setting')) {
    function user_setting($field)
    {
        $instance = \App\UserSetting::where([
            'uid' => auth()->user()->id,
            'setting_code' => $field
        ]);

        if ($instance->exists()) {
            return $instance->first()->value;
        }

        if ($field == 'language') {
            return 'vi';
        }

        return null;
    }
}

if(!function_exists('booking_notifications')) {
    function booking_notifications() {
        $booking = \App\Booking::where('booking_status','create')->get();
        return $booking;
    }
}
