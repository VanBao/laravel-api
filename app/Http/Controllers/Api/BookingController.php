<?php

namespace App\Http\Controllers\Api;

use App\BookingRating;
use App\BookingService;
use App\Group;
use App\PaymentMethod;
use App\Service;
use App\ServicePrice;
use App\Setting;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use App\Booking;
use App\City;

class BookingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function rating(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|integer|exists:booking,id',
            'rating' => 'required|between:1,5',
            'note' => 'nullable|string'
        ]);
//        BookingRating:
        $booking = Booking::where(['uid' => auth()->user()->id, 'id' => $request->booking_id]);
        if (!$booking->exists()) {
            return response()->json([
                'status' => false,
                'code' => error_code('RATE_FAILED'),
                'message' => 'Failed.',
                'data' => []
            ]);
        }
        if ($booking->first()->booking_status == 'done' || $booking->first()->booking_status == 'cancel') {
            $booking->update(['is_rated' => 1]);
            $bookingRating = BookingRating::where(['booking_id' => $request->booking_id, 'uid' => auth()->user()->id]);
            if ($bookingRating->exists()) {
                $bookingRating->update([
                    'rating' => $request->rating
                ]);
                return response()->json([
                    'status' => true,
                    'code' => 0,
                    'message' => 'Success.',
                    'data' => []
                ]);
            } else {
                BookingRating::create([
                    'booking_id' => $request->booking_id,
                    'rating' => $request->rating,
                    'note' => isset($request->note) ? $request->note : '',
                    'uid' => auth()->user()->id,
                ]);
                return response()->json([
                    'status' => true,
                    'code' => 0,
                    'message' => 'Success.',
                    'data' => []
                ]);
            }
        } else {
            return response()->json([
                'status' => false,
                'code' => error_code('BOOKING_NOT_DONE'),
                'message' => 'Failed.',
                'data' => []
            ]);
        }
    }

    public function upload(Request $request)
    {
        $request->validate([
            'images' => 'nullable|array|between:0,10',
            'images.*' => 'nullable|image|max:5120'
        ]);

        $images = [];

        if ($request->images) {
            foreach ($request->images as $index => $image) {
                $file = str_replace(" ", "", time() . '_' . $image->getClientOriginalName());

                $image->move('uploads', $file);

                $images[] = asset('uploads/' . $file);
            }
        }

        return response()->json([
            'status' => true,
            'code' => 0,
            'message' => 'Success.',
            'data' => $images
        ]);
    }

    private function checkBooking($bookingServices, $serviceId, $total, $quantity)
    {
        if ($bookingServices) {
            $clientTotal = 0;
            $clientQuantity = 0;
            foreach ($bookingServices as $index => $bookingService) {
                if (!ServicePrice::where('service_id', $serviceId)->where('id', $bookingService['service_price_id'])->exists()) return false;
                if ($bookingService['service_price_id']) {
                    $servicePrice = ServicePrice::findOrFail($bookingService['service_price_id'])->toArray();
                    $clientPrice = (int)$bookingService['price'];
                    $type = '';
                    if (strpos($bookingService['type'], 'online') !== false) $type = 'online';
                    if (strpos($bookingService['type'], 'offline') !== false) $type = 'offline';
                    if (($servicePrice['price_' . $type . '_type'] == 'price') && ($clientPrice != (int)$servicePrice['price_' . $type])) return false;
                    $clientTotal += (int)$bookingService['price'] * (int)$bookingService['quantity'];
                    $clientQuantity += (int)$bookingService['quantity'];
                }
            }
            if ((int)$total != (int)$clientTotal) return false;
            if ((int)$quantity != (int)$clientQuantity) return false;
            return true;
        }
        return false;
    }

    public function create(Request $request)
    {
        $request->validate([
//            'booking_code' => 'nullable|string',
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'nullable|email|max:255|unique:users,email,' . auth()->user()->id,
            'customer_phone' => 'required|string|min:9|max:20|unique:users,phone,' . auth()->user()->id,
            'customer_address' => 'required|string|max:500',
            'note' => 'nullable|string|max:500',
            'total_price' => 'required|integer|min:0',
            'total_item' => 'required|integer|min:1',
            'payment_method_id' => 'required|integer|exists:payment_methods,id',
            'discount_code' => 'nullable|string',
            'discount_price' => 'nullable|integer',
            'service_id' => 'required|integer|exists:services,id',
            'booking_services' => 'required|array',
            'booking_services.*.quantity' => 'required|integer|min:1',
            'booking_services.*.price' => 'nullable|integer',
            'booking_services.*.type' => 'required|string',
            'booking_services.*.service_price_id' => 'required|integer|exists:service_prices,id',
            'images' => 'nullable|array',
            'images.*' => 'nullable|string',
            'time_from' => 'required',
            'time_to' => 'nullable',
            'city' => 'required|integer'
        ]);

        // Check
//        foreach ($request->booking_services as $index => $bookingService) {
//            if ($bookingService['service_price_id'] && $bookingService['service_id']) {
//                $servicePrice = ServicePrice::findOrFail($bookingService['service_price_id']);
//            }
//        }


        if (!City::where('id', $request->city)->exists()) {
            return response()->json([
                'status' => false,
                'code' => 31,
                'message' => 'Failed.',
                'data' => []
            ]);
        }

        if (!$this->checkBooking($request->booking_services, $request->service_id, $request->total_price, $request->total_item)) {
            return response()->json([
                'status' => false,
                'code' => error_code('BOOKING_FAILED'),
                'message' => 'Failed.',
                'data' => []
            ]);
        }

        // End check

//        $paymentMethod = PaymentMethod::findOrFail($request->payment_method_id);
//
//        if ($paymentMethod->code == 'transfer') {
//            if (!$request->has('booking_code') && !$request->booking_code) {
//                return response()->json([
//                    'status' => false,
//                    'code' => error_code('BOOKING_CODE_IS_REQUIRED'),
//                    'message' => 'Failed.',
//                    'data' => []
//                ]);
//            }
//        }
//
//        if ($request->has('booking_code') && $request->booking_code) {
//            if (strlen($request->booking_code) == 6) {
//                if ($paymentMethod->code == 'transfer') {
//                    $bookingCode = $request->booking_code;
//                } else {
//                    return response()->json([
//                        'status' => false,
//                        'code' => 20,
//                        'message' => 'Failed.',
//                        'data' => []
//                    ]);
//                }
//            } else {
//                return response()->json([
//                    'status' => false,
//                    'code' => 20,
//                    'message' => 'Failed.',
//                    'data' => []
//                ]);
//            }
//        } else {
//            $bookingCode = mb_strtoupper(Str::random(6));
//        }

        $bookingCode = mb_strtoupper(Str::random(6));

//        $userUpdate = [
//            'address' => $request->customer_address,
//            'name' => $request->customer_name,
//            'phone' => $request->customer_phone
//        ];
//
//        if ($request->has('customer_email') && $request->customer_email) $userUpdate['email'] = $request->customer_email;

//        User::where('id', auth()->user()->id)->update($userUpdate);

        $booking = new Booking([
            'booking_code' => $bookingCode,
            'customer_name' => $request->customer_name,
            'customer_email' => isset($request->customer_email) ? $request->customer_email : auth()->user()->email,
            'customer_phone' => $request->customer_phone,
            'customer_address' => $request->customer_address,
            'service_id' => $request->service_id,
            'note' => isset($request->note) ? $request->note : '',
            'total_price' => (int)$request->total_price,
            'total_item' => $request->total_item,
            'created_at' => now(),
            'payment_method_id' => (int)$request->payment_method_id,
            'booking_status' => 'create',
            'uid' => auth()->user()->id,
            'staff_id' => null,
            'discount_code' => isset($request->discount_code) ? $request->discount_code : '',
            'discount_price' => isset($request->discount_price) ? (int)$request->discount_price : 0,
            'images' => isset($request->images) ? json_encode($request->images) : null,
            'time_from' => $request->time_from,
            'time_to' => isset($request->time_to) ? $request->time_to : null,
            'city_id' => $request->city
        ]);

        $booking->save();

        $bookingServices = [];

        foreach ($request->booking_services as $index => $bookingService) {
            if ($bookingService['service_price_id']) {
                $bookingServices[] = [
                    'booking_id' => (int)$booking->id,
                    'price' => isset($bookingService['price']) ? (int)$bookingService['price'] : 0,
                    'type' => $bookingService['type'],
                    'quantity' => (int)$bookingService['quantity'],
                    'created_at' => now(),
                    'service_price_id' => (int)$bookingService['service_price_id']
                ];
            }
        }

        BookingService::insert($bookingServices);
        $booking['booking_services'] = $bookingServices;

        // Begin OneSignal

        $superAdminGroupId = Group::where('type', 'super_admin')->first()->id;
        $adminGroupId = Group::where('type', 'admin')->first()->id;
        $superAdmin = User::select('id')->where('group_id', $superAdminGroupId)->with(['user_setting' => function ($query) {
            $query->where('setting_code', 'onesignal_user_id')->first();
        }])->get()->toArray();
        $admin = User::select('id')->where('group_id', $adminGroupId)->with(['user_setting' => function ($query) {
            $query->where('setting_code', 'onesignal_user_id')->first();
        }])->get()->toArray();

        $userNoti = array_merge($superAdmin, $admin);

        if ($userNoti) {
            $message = "Có đơn hàng mới #" . $booking->booking_code;
            $url = route('admin.booking.detail', ['id' => $booking->id, 'booking_id' => $booking->id]);
            $data = null;
            $buttons = null;
            $schedule = null;
            foreach ($userNoti as $user) {
                if (isset($user['user_setting'][0])) {
                    $userId = $user['user_setting'][0]['value'];
                    \OneSignal::sendNotificationToUser(
                        $message,
                        $userId,
                        $url,
                        $data,
                        $buttons,
                        $schedule
                    );
                }
            }
        }

        // End OneSignal

        return response()->json([
            'status' => true,
            'code' => 0,
            'message' => 'Success.',
            'data' => [$booking]
        ]);
    }

    public function transfer(Request $request)
    {
        if ($request->has('id') && $request->id) {
            $paymentMethod = PaymentMethod::where('code', 'transfer')->first();
            $_instance = Booking::where('id', $request->id)->where('uid', auth()->user()->id)->where('payment_method_id', $paymentMethod->id);
            if ($_instance->exists()) {
                $instance = Setting::where('code', 'transfer_text');
                if ($instance->exists()) {
                    $setting = $instance->first()->toArray();
                    $booking = $_instance->first();
                    $text = str_replace('[booking_code]', $booking->booking_code, $setting['value']);
                    $text = str_replace('[customer_name]', $booking->customer_name, $text);
                    $setting['value'] = $text;
                    return response()->json([
                        'status' => true,
                        'code' => 0,
                        'message' => 'Success.',
                        'data' => [$setting]
                    ]);
                }
            } else {
                return response()->json([
                    'status' => false,
                    'code' => error_code('NOT_FOUND_RECORD'),
                    'message' => 'Failed.',
                    'data' => []
                ]);
            }
        } else {
            return response()->json([
                'status' => false,
                'code' => error_code('NOT_FOUND_RECORD'),
                'message' => 'Failed.',
                'data' => []
            ]);
        }
    }

    public function generateBookingCode()
    {
        return response()->json([
            'status' => true,
            'code' => 0,
            'message' => 'Success.',
            'data' => mb_strtoupper(Str::random(6))
        ]);
    }

    public function history(Request $request)
    {
        if ($request->has('id')) {
            $booking = Booking::where('id', $request->id);
            if (!$booking->exists()) {
                return response()->json([
                    'status' => false,
                    'code' => error_code('NOT_FOUND_RECORD'),
                    'message' => 'Failed.',
                    'data' => []
                ]);
            }

            $instance = Booking::where('id', $request->id)->where('uid', auth()->user()->id);

            if ($request->has('fields') && $request->fields == 'staff') {
                $booking = Booking::select('staff_id')->where('id', $request->id)->where('uid', auth()->user()->id)->with('staff')->first()->toArray();;
                $booking = $booking['staff'];
            } else {
                $booking = $instance->with(['service' => function ($query) {
                    $query->with('category');
                }])->with('payment_method')->with(['booking_services' => function ($query) {
                    $query->with('service_price');
                }])->with('staff')->first()->toArray();
            }

            $data = [$booking];
        } else {
            $data = Booking::where('uid', auth()->user()->id)->with('payment_method')->with(['service' => function ($query) {
                $query->with('category');
            }])->orderBy('created_at', 'desc')->get()->toArray();
        }

        return response()->json([
            'status' => true,
            'code' => 0,
            'message' => 'Success.',
            'data' => $data
        ]);
    }
}
