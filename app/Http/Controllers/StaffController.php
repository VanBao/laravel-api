<?php

namespace App\Http\Controllers;

use App\Booking;
use App\BookingService;
use App\Group;
use App\Message;
use App\Service;
use App\User;
use App\UserSetting;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Traits\PaginationTrait;

class StaffController extends WebDriverController
{
    use PaginationTrait;

    public function pagination(Request $request)
    {
        $this->params = $request->all();
        $this->query = Booking::query()->where('staff_id', auth()->user()->id)->where('booking_status', '!=', 'deleted');
        $this->field_search = ['booking_code', 'customer_name', 'customer_email','customer_phone'];

        $results = $this->getResults();

        return response()->json([
            'meta' => $results[0],
            'data' => $results[1]
        ]);
    }


    public function index()
    {
        $instance = Booking::where('staff_id', auth()->user()->id)->with('user');
        $data['data'] = $instance->orderBy('created_at', 'desc')->get();
        $_chat = $instance->whereIn('booking_status', ['accept', 'processing'])->whereNotNull('uid')->with('messages')->orderBy('created_at', 'desc')->get()->toArray();
        $chat = [];
        foreach ($_chat as $index => $item) {
            $lastMessage = [];
            $instance = Message::select('created_at','booking_id','id')->where('booking_id', $item['id'])->where('from_type', 'user');
            if ($instance->exists()) {
                $lastMessage = $instance->orderBy('created_at', 'DESC')->first()->toArray();
            }
            $chat[$index] = $item;
            $chat[$index]['last_message'] = isset($lastMessage['created_at']) ? Carbon::createFromFormat('H:i:s d-m-Y', $lastMessage['created_at'])->timestamp : 0;
        }
//dd(collect($chat));
        $data['chat'] = collect($chat)->sortByDesc('last_message');
//        dd($data['chat']->toArray());
        return view('staff.index', $data);
    }

    public function update(Request $request)
    {
        if ($request->ajax()) {
            $request->validate([
                'status' => 'required|in:done,cancel',
                'id' => 'required|integer|exists:booking,id'
            ]);
            $booking = Booking::where('id', $request->id);
            if (!$booking->where('staff_id', auth()->user()->id)->exists()) return response()->json(false);
            $booking->update(['booking_status' => $request->status]);
            if ($request->status == 'done') {
                $booking = $booking->first()->toArray();
                $instance = UserSetting::where('uid', $booking['uid'])->where('setting_code', 'fcm_token');
                if ($instance->exists()) {
                    $userSetting = $instance->first()->toArray();
                    if(check_token($userSetting['uid'])) {
                        $this->sendNotification([$userSetting['value']], 'Đơn hàng ' . $booking['booking_code'] . ' của bạn đã hoàn thành !', 'Đơn hàng ' . $booking['booking_code'] . ' của bạn đã hoàn thành , hãy đánh giá !', $request->id);
                    }
                }
            } else if ($request->status == 'cancel') {
                $booking = $booking->first()->toArray();
                $instance = UserSetting::where('uid', $booking['uid'])->where('setting_code', 'fcm_token');
                if ($instance->exists()) {
                    $userSetting = $instance->first()->toArray();
                    if(check_token($userSetting['uid'])) {
                        $this->sendNotification([$userSetting['value']], 'Đơn hàng ' . $booking['booking_code'] . ' của bạn đã huỷ !', 'Đơn hàng ' . $booking['booking_code'] . ' của bạn đã huỷ !', $request->id);
                    }
                }
            }
            return response()->json(true);
        }
        return response()->json(false);
    }

    public function detail(Request $request, $id)
    {
        if ($request->has('destroy_session') && $request->get('destroy_session') == 'yes') session()->forget('return_to_booking_id');
        $booking = Booking::where('id', $id)->where('staff_id', auth()->user()->id)->with('service')->with('payment_method:id,name')->with(['booking_services' => function ($query) {
            $query->with('service_price');
        }])->first()->toArray();

        if (!$request->id) return response()->json(['error_msg' => 'Id is required'], 400);
        return view('staff.detail', ['data' => $booking]);
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
}
