<?php

namespace App\Http\Controllers\Api;

use App\Group;
use App\Http\Requests\LoginRequest;
use App\PasswordResetCode;
use App\User;
use App\UserSetting;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendCode;
use App\Setting;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register', 'sendCode', 'submitCode', 'changePassword']]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|max:255|min:6|confirmed',
            'phone' => 'required|min:6|max:20',
            'address' => 'nullable|string',
            'city' => 'required|integer'
        ]);

        if (User::where('email', $request->email)->exists()) {
            return response()->json([
                'status' => false,
                'code' => error_code('EMAIL_EXISTS'),
                'message' => 'Failed.',
                'data' => []
            ]);
        }

        if (!City::where('id', $request->city)->exists()) {
            return response()->json([
                'status' => false,
                'code' => 31,
                'message' => 'Failed.',
                'data' => []
            ]);
        }

        if (User::where('phone', $request->phone)->exists()) {
            return response()->json([
                'status' => false,
                'code' => error_code('PHONE_EXISTS'),
                'message' => 'Failed.',
                'data' => []
            ]);
        }

        $group_id = Group::where('type', 'user')->first()->id;

        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'phone' => $request->phone,
            'address' => $request->address,
            'group_id' => $group_id,
            'city_id' => $request->city
        ]);


        $user->save();

        return response()->json([
            'status' => true,
            'code' => 0,
            'message' => 'Success.',
            'data' => [$user]
        ]);
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . auth()->user()->id,
            'phone' => 'required|min:6|max:20|unique:users,phone,' . auth()->user()->id,
            'address' => 'required|string',
            'avatar' => 'nullable|string',
            'password' => 'nullable|string',
            'new_password' => 'nullable|confirmed|min:6|max:255',
            'city' => 'required|integer'
        ]);

        if (!City::where('id', $request->city)->exists()) {
            return response()->json([
                'status' => false,
                'code' => 31,
                'message' => 'Failed.',
                'data' => []
            ]);
        }

        $update = [];

        $flag = false;

        if ($request->has('name') && $request->name) $update['name'] = $request->name;
        if ($request->has('email') && $request->email) $update['email'] = $request->email;
        if ($request->has('phone') && $request->phone) $update['phone'] = $request->phone;
        if ($request->has('address') && $request->address) $update['address'] = $request->address;
        if ($request->has('avatar') && $request->avatar) $update['avatar'] = $request->avatar;
        if ($request->has('city') && $request->city) $update['city_id'] = $request->city;
        if ($request->has('password') && $request->password) {
            if ($request->has('new_password') && $request->new_password) {
                if (!Hash::check($request->password, auth()->user()->password)) {
                    return response()->json([
                        'status' => false,
                        'code' => error_code('PASSWORD_NOT_MATCH'),
                        'message' => 'Failed.',
                        'data' => []
                    ]);
                } else {
                    $flag = true;
                    $update['password'] = bcrypt($request->new_password);
                }
            } else {
                return response()->json([
                    'status' => false,
                    'code' => error_code('NEW_PASSWORD_REQUIRED'),
                    'message' => 'Failed.',
                    'data' => []
                ]);
            }
        }

        User::where('id', auth()->user()->id)->update($update);

        if ($flag) {
            unset($update['password']);
        }

        return response()->json([
            'status' => true,
            'code' => 0,
            'message' => 'Success.',
            'data' => ($update) ? [$update] : []
        ]);
    }

    public function uploadAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|max:5120'
        ]);

        $file = null;

        if ($request->avatar) {

            $image = $request->avatar;

            $file = str_replace(" ","",time() . '_' . $image->getClientOriginalName());

            $image->move('uploads', $file);
        }

        return response()->json([
            'status' => true,
            'code' => 0,
            'message' => 'Success.',
            'data' => ($file) ? [asset('uploads/' . $file)] : null
        ]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $request->validate([
            'phone' => 'required|string|max:255',
            'password' => 'required|string|max:255|min:6',
            'firebase_token' => 'nullable|string',
            'language' => 'nullable|string|in:vi,en'
        ]);

        $credentials = request(['phone', 'password']);

        $days = 14;
        $minutes = 1440 * $days;

        if (!$token = auth()->setTTL($minutes)->attempt($credentials)) {

            return response()->json([
                'status' => false,
                'code' => error_code('LOGIN_FAILED'),
                'message' => 'Failed.',
                'data' => []
            ], 200);
        }
        if ($request->has('firebase_token') && $request->firebase_token) {
            UserSetting::updateOrCreate([
                'uid' => auth()->user()->id,
                'setting_code' => 'fcm_token'
            ], [
                'uid' => auth()->user()->id,
                'setting_code' => 'fcm_token',
                'value' => $request->firebase_token
            ]);
        }
        if ($request->has('language') && $request->language) {
            UserSetting::updateOrCreate([
                'uid' => auth()->user()->id,
                'setting_code' => 'language'
            ], [
                'uid' => auth()->user()->id,
                'setting_code' => 'language',
                'value' => $request->language
            ]);
        }
        User::where('id', auth()->user()->id)->update([
            'token' => $token
        ]);
        return $this->respondWithToken($token, $minutes);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json([
            'status' => true,
            'code' => 0,
            'message' => 'Success.',
            'data' => [auth()->user()]
        ]);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        $instance = UserSetting::where('uid',auth()->user()->id)->where('setting_code','fcm_token');

        if($instance->exists()) {
            $instance->delete();
        }

        auth()->logout();

        return response()->json([
            'status' => true,
            'code' => 0,
            'message' => 'Success.',
            'data' => []
        ]);
    }

    /**x
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token, $minutes = 0)
    {

        return response()->json([
            'status' => true,
            'code' => 0,
            'message' => 'Success.',
            'data' => [
                [
                    'access_token' => $token,
                    'token_type' => 'bearer',
                    'expires_in' => now()->addMinute($minutes)
//              auth()->factory ()->getTTL() * 60
                ]
            ]
        ]);
    }

    public function sendCode(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email'
        ]);

        if(!User::where('email', $request->email)->exists()) {
            return response()->json([
                'status' => false,
                'code' => error_code('EMAIL_NOT_EXISTS'),
                'message' => 'Failed.',
                'data' => []
            ]);
        }

        $code = mt_rand(100000, 999999);

        Mail::to($request->email)->send(new SendCode(['code' => $code]));

        $passwordResetCode = new PasswordResetCode([
            'email' => $request->email,
            'code' => $code
        ]);

        $passwordResetCode->save();

        return response()->json([
            'status' => true,
            'code' => 0,
            'message' => 'Success.',
            'data' => []
        ]);
    }

    public function submitCode(Request $request)
    {
        $request->validate([
            'code' => 'required|integer|digits:6',
            'email' => 'required|email|string'
        ]);

        if(!User::where('email', $request->email)->exists()) {
            return response()->json([
                'status' => false,
                'code' => error_code('EMAIL_NOT_EXISTS'),
                'message' => 'Failed.',
                'data' => []
            ]);
        }

        $passwordResetCode = PasswordResetCode::where('email', $request->email);
        $exists = $passwordResetCode->exists();
        if ($exists) {
            $data = $passwordResetCode->orderBy('created_at', 'desc')->first();
//            if ($data->times >= 3) {
//                return response()->json([
//                    'status' => false,
//                    'code' => error_code('CODE_LIMIT'),
//                    'message' => 'Failed.',
//                    'data' => []
//                ]);
//            } else {
//                if ($data->created_at->addMinutes(2)->isPast()) {
//                    return response()->json([
//                        'status' => false,
//                        'code' => error_code('CODE_OVER'),
//                        'message' => 'Failed.',
//                        'data' => []
//                    ]);
//                } else {
            if ($data->code == $request->code) {
                PasswordResetCode::where([
                    'code' => $request->code,
                    'email' => $request->email
                ])->update([
                    'is_used' => 1
                ]);
                return response()->json([
                    'status' => true,
                    'code' => 0,
                    'message' => 'Success.',
                    'data' => []
                ]);
            } else {
                $times = $data->times;
                $data->update([
                    'times' => ++$times
                ]);
                return response()->json([
                    'status' => false,
                    'code' => error_code('CODE_INVALID'),
                    'message' => 'Failed.',
                    'data' => []
                ]);
            }
//                }
        } else {
            return response()->json([
                'status' => false,
                'code' => error_code('USER_NOT_EXISTS'),
                'message' => 'Failed.',
                'data' => []
            ]);
        }
//        }
    }

    public function update()
    {

    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|string',
            'new_password' => 'required|string|min:6|max:255|confirmed'
        ]);

        if(!User::where('email', $request->email)->exists()) {
            return response()->json([
                'status' => false,
                'code' => error_code('EMAIL_NOT_EXISTS'),
                'message' => 'Failed.',
                'data' => []
            ]);
        }

        $passwordResetPassword = PasswordResetCode::where([
            'email' => $request->email
        ]);

        if ($passwordResetPassword->exists()) {
            if ($passwordResetPassword->orderBy('created_at', 'desc')->first()->is_used == 1) {
                $user = User::where('email', $request->email);
                if ($user->exists()) {
                    $user->update([
                        'password' => bcrypt($request->new_password)
                    ]);
                    return response()->json([
                        'status' => true,
                        'code' => 0,
                        'message' => 'Success.',
                        'data' => []
                    ]);
                } else {
                    return response()->json([
                        'status' => false,
                        'code' => error_code('USER_NOT_EXISTS'),
                        'message' => 'Failed.',
                        'data' => []
                    ]);
                }
            } else {
                return response()->json([
                    'status' => false,
                    'code' => error_code('CODE_NOT_VERIFY'),
                    'message' => 'Failed.',
                    'data' => []
                ]);
            }
        } else {
            return response()->json([
                'status' => false,
                'code' => error_code('CODE_OR_EMAIL_NOT_CORRECT_RESET_PASSWORD'),
                'message' => 'Failed.',
                'data' => []
            ]);
        }
    }
}
//"name": "Vu Hong Linh",
//	"email": "vlinh12300@gmail.com",
//	"password": "123123123",
//	"customer_name": "Vu Linh",
//	"customer_email" : "hehe@gmail.com",
//	"phonse": "09024131129",
//	"password_confirmation": "123123123",
//	"is_accept": 1,
//	"code": "231518",
//	"customer_address": "Ho chi minh haha",
//	"note": "ghi chu hehe",
//	"total_price": "999292",
//	"total_item": "5",
//	"payment_method_id": 2,
//	"discount_code": "A24GGD",
//	"discount_price": "300000",
//	"service_id" : "4",
//	"booking_services": [
//		{
//            "price": "120000",
//			"note": "Ghi chu hhihi",
//			"service_price_id": "10"
//		},
//		{
//            "price": "2222",
//			"note": "Ghi chu hhihi 2",
//			"service_price_id": "10"
//		}
//	]
