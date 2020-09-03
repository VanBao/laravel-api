<?php

namespace App\Http\Controllers;

use App\Booking;
use App\BookingService;
use App\Category;
use App\Group;
use App\Message;
use App\PaymentMethod;
use App\Service;
use App\ServicePrice;
use App\User;
use App\UserSetting;
use Carbon\Carbon;
use App\City;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Traits\PaginationTrait;

class BookingController extends WebDriverController
{
    use PaginationTrait;

    public function pagination(Request $request)
    {
        $this->params = $request->all();
        $this->query = Booking::query()->with('city')->where('booking_status', '!=', 'deleted');
        $this->field_search = ['booking_code', 'customer_name', 'customer_email', 'customer_phone', 'city_id'];

        $results = $this->getResults();

        return response()->json([
            'meta' => $results[0],
            'data' => $results[1]
        ]);
    }

    public function createByCustomer()
    {
        return view('create_booking');
    }

    public function updateDealPrice(Request $request)
    {
        if ($request->ajax()) {
            $request->validate([
                'booking_service_id' => 'required|integer|exists:booking_service,id',
                'price' => 'required|integer|min:0'
            ]);
            $bookingService = BookingService::where('id', $request->booking_service_id);
            $bookingServiceData = $bookingService->with('booking')->first()->toArray();
            $bookingServices = BookingService::select('id', 'service_price_id', 'type', 'quantity', 'price')->where('booking_id', $bookingServiceData['booking_id'])->with('service_price')->get()->toArray();
            $data = collect($bookingServices);
            $total = 0;

            foreach ($data as $item) {
                if ($item['service_price']['price_' . $item['type'] . '_type'] == 'price') {
                    $total += $item['price'] * $item['quantity'];
                } else {
//                    return response()->json([
//                        'ha' =>$item,
//                        'he' => $bookingServiceData
//                    ]);
                    if ($item['service_price_id'] != $bookingServiceData['service_price_id']) {
                        $total += $item['price'];
                    }
                }

            }

//            return response()->json($total);
            Booking::findOrFail($bookingServiceData['booking_id'])->update([
                'total_price' => $total + $request->price
            ]);

            $servicePrice = ServicePrice::where('id', $bookingServiceData['service_price_id'])->first()->toArray();

            if ($servicePrice['price_' . $bookingServiceData['type'] . '_type'] == 'deal') {
                $bookingService->update([
                    'price' => $request->price
                ]);
                return response()->json(true);
            }
            return response()->json(false);
        }
        return response()->json(false);
    }

    public function index()
    {
        $booking = Booking::with(['user', 'city'])->orderBy('created_at', 'desc')->get();
        $listCity = City::all();
        $_chat = Booking::with(['user', 'city'])->whereIn('booking_status', ['create'])->whereNotNull('uid')->with('messages')->orderBy('created_at', 'desc')->get()->toArray();
        $chat = [];
        foreach ($_chat as $index => $item) {
            $lastMessage = [];
            $instance = Message::select('created_at', 'booking_id', 'id')->where('booking_id', $item['id'])->where('from_type', 'user');
            if ($instance->exists()) {
                $lastMessage = $instance->orderBy('created_at', 'DESC')->first()->toArray();
            }
            $chat[$index] = $item;
            $chat[$index]['last_message'] = isset($lastMessage['created_at']) ? Carbon::createFromFormat('H:i:s d-m-Y', $lastMessage['created_at'])->timestamp : 0;
        }
        return view('booking.index', ['data' => $booking, 'chat' => collect($chat)->sortByDesc('last_message'), 'listCity' => $listCity]);
    }

    public function create()
    {
        $data['users'] = User::all()->toJson();
        return view('booking.create', $data);
    }

    public function load(Request $request, $table)
    {
        if ($table == 'category') {
            $category = Category::where('status', 1)->get()->toArray();
            if ($request->has('id')) $category = Service::where('category_id', $request->id)->where('status', 1)->get()->toArray();
            return response()->json($category);
        }
        if ($table == 'service') {
            if ($request->has('id')) return response()->json(ServicePrice::where('service_id', $request->id)->where('status', 1)->get()->toArray());
        }
    }

    public function edit(Request $request, $id)
    {
        //dd(Booking::findOrFail($id)->toArray());
        return view('booking.edit', $data);
    }

    public function detail(Request $request, $id)
    {
        if ($request->has('destroy_session') && $request->get('destroy_session') == 'yes') session()->forget('return_to_booking_id');
        $instance = Booking::where('id', $id);
        if (!$instance->exists()) return redirect()->route('admin.booking.index');
        $booking = $instance->with(['staff', 'city'])->with('service')->with('payment_method:id,name')->with(['booking_services' => function ($query) {
            $query->with('service_price');
        }])->first()->toArray();

//        dd($booking);
//        $bookingServices = BookingService::select('id', 'service_id', 'service_price_id', 'type', 'quantity', 'price')->where('booking_id', $booking['id'])->with('service_price')->get()->toArray();
//        $data = collect($bookingServices);
//
//        $services = [];
//
//        foreach ($bookingServices as $bookingService) {
//            $serviceId = $bookingService['service_id'];
//            if (!isset($services[$serviceId])) {
//                $services[$serviceId] = Service::where('id', $serviceId)->with('category')->first()->toArray();
//            }
//            $bookingServices_[$serviceId]['name'] = $services[$serviceId]['name'];
//            $bookingServices_[$serviceId]['summary'] = $services[$serviceId]['summary'];
//            $bookingServices_[$serviceId]['content'] = $services[$serviceId]['content'];
//            $bookingServices_[$serviceId]['avatar'] = $services[$serviceId]['avatar'];
//            $bookingServices_[$serviceId]['background'] = $services[$serviceId]['background'];
//            $bookingServices_[$serviceId]['images'] = $services[$serviceId]['images'];
//            $bookingServices_[$serviceId]['status'] = $services[$serviceId]['status'];
//            $bookingServices_[$serviceId]['category'] = $services[$serviceId]['category'];
//            $bookingServices_[$serviceId]['service_prices'][] = $bookingService;
//        }
//
//        $booking['booking_services'] = $bookingServices_;
        $staffGroupId = Group::where('type', 'staff')->first()->id;
        $staffs = User::where('group_id', $staffGroupId)->get()->toArray();
//        $booking['total_price'] = $booking['total_price'];
        if (!$request->id) return response()->json(['error_msg' => 'Id is required'], 400);
        $listCity = City::all();
        return view('booking.detail', ['listCity' => $listCity, 'data' => $booking, 'staffs' => $staffs, 'payment_methods' => PaymentMethod::all()->toArray()]);
    }

    public function assign(Request $request)
    {
        if ($request->ajax()) {
            $request->validate([
                'staff_id' => 'required|integer|exists:users,id',
                'booking_id' => 'required|integer|exists:booking,id'
            ]);

            $staff = User::select('id')->where('id', $request->staff_id)->with(['user_setting' => function ($query) {
                $query->where('setting_code', 'onesignal_user_id')->first();
            }])->first()->toArray();

            if (count($staff['user_setting']) > 0) {
                \OneSignal::sendNotificationToUser(
                    "Bạn nhận được lệnh mới !",
                    $staff['user_setting'][0]['value'],
                    route('admin.staff.detail', ['id' => $request->booking_id, 'booking_id' => $request->booking_id]),
                    $data = null,
                    $buttons = null,
                    $schedule = null
                );
            }
            $instance = Booking::where('id', $request->booking_id);
            $instance->update([
                'staff_id' => $request->staff_id,
                'booking_status' => 'processing'
            ]);

            $booking = $instance->first()->toArray();
            $_instance = UserSetting::where('uid', $booking['uid'])->where('setting_code', 'fcm_token');
            if ($_instance->exists()) {
                $userSetting = $_instance->first()->toArray();
                if (check_token($userSetting['uid'])) {
                    $this->sendNotification([$userSetting['value']], 'Đơn hàng ' . $booking['booking_code'] . ' của bạn đang được xử lý !', 'Đơn hàng ' . $booking['booking_code'] . ' của bạn đang được xử lý !', $request->booking_id);
                }
            }

            return response()->json(true);
        }
        return response()->json(false);
    }

    public function reject(Request $request)
    {
        if ($request->ajax()) {
            $request->validate([
                'booking_id' => 'required|integer|exists:booking,id'
            ]);
            $instance = Booking::where('id', $request->booking_id);
            $instance->update([
                'booking_status' => 'reject'
            ]);

            $booking = $instance->first()->toArray();

            $_instance = UserSetting::where('uid', $booking['uid'])->where('setting_code', 'fcm_token');
            if ($_instance->exists()) {
                $userSetting = $_instance->first()->toArray();
                if (check_token($userSetting['uid'])) {
                    $this->sendNotification([$userSetting['value']], 'Đơn hàng ' . $booking['booking_code'] . ' của bạn đã bị từ chối !', 'Đơn hàng ' . $booking['booking_code'] . ' của bạn đã bị từ chối !', $request->booking_id);
                }
            }
            return response()->json(true);
        }
        return response()->json(false);
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

    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'nullable|email|max:255',
            'customer_phone' => 'required|string|min:9|max:20',
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
            'uid' => 'nullable|exists:users,id'
        ]);


        if (!$this->checkBooking($request->booking_services, $request->service_id, $request->total_price, $request->total_item)) {
            return response()->json([
                'status' => false,
                'code' => error_code('BOOKING_FAILED'),
                'message' => 'Failed.',
                'data' => []
            ]);
        }

        // End check

        $bookingCode = mb_strtoupper(Str::random(6));

        $booking = new Booking([
            'booking_code' => $bookingCode,
            'customer_name' => $request->customer_name,
            'customer_email' => $request->customer_email,
            'customer_phone' => $request->customer_phone,
            'customer_address' => $request->customer_address,
            'service_id' => $request->service_id,
            'note' => isset($request->note) ? $request->note : '',
            'total_price' => (int)$request->total_price,
            'total_item' => $request->total_item,
            'created_at' => now(),
            'payment_method_id' => (int)$request->payment_method_id,
            'booking_status' => 'create',
            'uid' => isset($request->uid) ? $request->uid : null,
            'staff_id' => null,
            'discount_code' => isset($request->discount_code) ? $request->discount_code : '',
            'discount_price' => isset($request->discount_price) ? (int)$request->discount_price : 0,
            'images' => isset($request->images) ? json_encode($request->images) : null,
            'time_from' => $request->time_from,
            'time_to' => isset($request->time_to) ? $request->time_to : null
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

        return response()->json([
            'status' => true,
            'code' => 0,
            'message' => 'Success.',
            'data' => [$booking]
        ]);

    }

    private function sendNotification($tokens, $title, $body, $id)
    {
        $url = "https://fcm.googleapis.com/fcm/send";
        $registration_ids = $tokens;
        $serverKey = config('netvas.fcm_key');
        $notification = array('title' => $title, 'body' => $body, 'click_action' => 'booking');
        $arrayToSend = array('registration_ids' => $registration_ids, 'notification' => $notification, 'priority' => 'high', 'data' => array_merge(['id' => $id, 'click_action' => 'booking'], $notification));
        $client = new Client([
            'verify' => false
        ]);
        $response = $client->request('POST', $url, [
            'body' => json_encode($arrayToSend),
            'headers' => ['Content-Type' => 'application/json', 'Authorization' => 'key=' . $serverKey]
        ]);
        $output = $response->getBody()->getContents();
        return $output;
    }

    public function delete($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->update([
            'booking_status' => 'deleted'
        ]);

        return back();
//        return $booking->delete();
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'time_from' => 'required',
            'time_to' => 'nullable',
            'customer_name' => 'required|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'required|min:9|max:20',
            'customer_address' => 'required|max:255',
            'note' => 'nullable',
            'payment_method_id' => 'required|exists:payment_methods,id',
            'costs_incurred' => 'nullable|integer',
            'admin_note' => 'nullable',
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

        $requestInput = $request->except(['_token', 'city']);

        $requestInput['city_id'] = (int) $request->city;

        $requestInput['costs_incurred'] = (int)$requestInput['costs_incurred'];

        $requestInput['time_from'] = Carbon::createFromFormat('d/m/Y', $requestInput['time_from'])->format('Y-m-d H:i:s');
        if ($requestInput['time_to']) $requestInput['time_to'] = Carbon::createFromFormat('d/m/Y', $requestInput['time_to'])->format('Y-m-d H:i:s');

        $booking = Booking::findOrFail($id);

        $booking->update($requestInput);

        return back()->with(['success' => 'Cập nhật đơn hàng thành công !']);
    }
}
