<?php

namespace App\Http\Controllers\Api;

use App\Booking;
use App\Group;
use App\Message;
use App\User;
use App\UserSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function uploadImage(Request $request)
    {

        $request->validate([
            'image' => 'required|image:jpg,jpeg,png|max:5120'
        ]);

        $image = str_replace(" ", "", time() . '_' . $request->image->getClientOriginalName());

        $request->image->move('uploads/', $image);

        return response()->json([
            'status' => true,
            'code' => 0,
            'message' => 'Success.',
            'data' => [
                asset('uploads/' . $image)
            ]
        ]);
    }

    public function send(Request $request)
    {
        $request->validate([
            'type' => 'required|in:text,image',
            'message' => 'required|string',
            'booking_id' => 'required|integer|exists:booking,id'
        ]);

        $instance = Booking::where('id', $request->booking_id)->where('uid', auth()->user()->id);

        if (!$instance->exists()) {
            return response()->json([
                'status' => false,
                'code' => error_code('UID_NOT_CORRECT'),
                'message' => 'Failed.',
                'data' => []
            ]);
        }
        if (!$instance->whereIn('booking_status', ['processing', 'create'])->exists()) {
            return response()->json([
                'status' => false,
                'code' => error_code('BOOKING_CHAT_OVER'),
                'message' => 'Failed.',
                'data' => []
            ]);
        }

        $_instance = $instance->first();

        $to = null;

        $booking = null;

        if ($_instance->booking_status == 'processing' && $_instance->staff_id != null) {
            $booking = $instance->with(['staff' => function ($query) {
                $query->select('id')->with(['user_setting' => function ($query) {
                    $query->where('setting_code', 'onesignal_user_id');
                }]);
            }])->first();

            $to = $booking['staff']['id'];
        }


        $message = new Message([
            'from' => auth()->user()->id,
            'to' => $to,
            'type' => $request->type,
            'message' => $request->message,
            'created_at' => now(),
            'booking_id' => $request->booking_id,
            'from_type' => 'user',
            'is_read' => 0
        ]);

        $message->save();

        if ($to && isset($booking['staff']['user_setting'][0]['value'])) {
            \OneSignal::sendNotificationToUser(
                $request->message. ' | Đơn hàng : #' . $_instance->booking_code,
                $booking['staff']['user_setting'][0]['value'],
                $url = null,
                $data = [
                    'avatar' => auth()->user()->avatar,
                    'message' => $request->message ,
                    'type' => $request->type,
                    'time' => now()->format('H:i:s d-m-Y'),
                    'booking_id' => $message->booking_id
                ],
                $buttons = null,
                $schedule = null
            );
        } else {
            $___instance = UserSetting::where('setting_code','onesignal_user_id');
            if($___instance->exists()) {
                $___instance = $___instance->get();
                foreach($___instance as $item) {
                    $uid = $item['uid'];
                    $__instance = User::where('id',$uid)->whereIn('group_id',[1,2]);
                    if($__instance->exists()) {
                        \OneSignal::sendNotificationToUser(
                            $request->message. ' | Đơn hàng : #' . $_instance->booking_code,
                            $item['value'],
                            $url = null,
                            $data = [
                                'avatar' => auth()->user()->avatar,
                                'message' => $request->message ,
                                'type' => $request->type,
                                'time' => now()->format('H:i:s d-m-Y'),
                                'booking_id' => $message->booking_id
                            ],
                            $buttons = null,
                            $schedule = null
                        );
                    }
                }
            }
        }

        $message = Message::where('id', $message->id)->with(['from:id,name,avatar', 'to:id,name,avatar'])->first()->toArray();
        $data = [
            'id' => $message['id'],
            'from_id' => $message['from']['id'],
            'from_name' => $message['from']['name'],
            'from_avatar' => $message['from']['avatar'],
            'from_type' => $message['from_type'],
            'to_id' => $to ? $message['to']['id'] : null,
            'to_name' => $to ? $message['to']['name'] : null,
            'to_avatar' => $to ? $message['to']['avatar'] : null,
            'to_type' => $to ? $message['from_type'] == 'user' ? 'staff' : 'user' : 'admin',
            'message' => $message['message'],
            'is_read' => $message['is_read'],
            'type' => $message['type'],
            'booking_id' => $message['booking_id'],
            'created_at' => $message['created_at'],
            'updated_at' => $message['updated_at']
        ];

        return response()->json([
            'status' => true,
            'code' => 0,
            'message' => 'Success.',
            'data' => [$data]
        ]);
    }

    public function message(Request $request)
    {
        if ($request->has('id') && $request->id && Message::where('id', $request->id)->where('to', auth()->user()->id)) {
            $message = Message::where('id', $request->id)->with(['from','to'])->first()->toArray();
            $data = [
                'id' => $message['id'],
                'from_id' => $message['from']['id'],
                'from_name' => $message['from']['name'],
                'from_avatar' => $message['from']['avatar'],
                'from_type' => $message['from_type'],
                'to_id' => $message['to'] ? $message['to']['id'] : null,
                'to_name' => $message['to'] ? $message['to']['name'] : null,
                'to_avatar' => $message['to'] ? $message['to']['avatar'] : null,
                'to_type' => $message['to'] ? $message['from_type'] == 'user' ? 'staff' : 'user' : 'admin',
                'message' => $message['message'],
                'is_read' => $message['is_read'],
                'type' => $message['type'],
                'booking_id' => $message['booking_id'],
                'created_at' => $message['created_at'],
                'updated_at' => $message['updated_at']
            ];
            return response()->json([
                'status' => true,
                'code' => 0,
                'message' => 'Success.',
                'data' => [$data]
            ]);
        }

        return response()->json([
            'status' => false,
            'code' => error_code('NOT_FOUND_RECORD'),
            'message' => 'Failed.',
            'data' => []
        ]);
    }

    public function messages(Request $request)
    {
        $instance = Booking::where('id', $request->id);
        if ($request->has('id') && $request->id && $instance->exists()) {
            $data = [];
            $booking = $instance->first()->toArray();
            $messages = Message::where('booking_id', $request->id)->with(['from:id,name,avatar', 'to:id,name,avatar'])->get()->toArray();
            foreach ($messages as $message) {
                $data[] = [
                    'id' => $message['id'],
                    'from_id' => $message['from']['id'],
                    'from_name' => $message['from']['name'],
                    'from_avatar' => $message['from']['avatar'],
                    'from_type' => $message['from_type'],
                    'to_id' => $message['to']['id'],
                    'to_name' => $message['to']['name'],
                    'to_avatar' => $message['to']['avatar'],
                    'to_type' => $message['from_type'] == 'user' ? 'staff' : 'user',
                    'message' => $message['message'],
                    'is_read' => $message['is_read'],
                    'type' => $message['type'],
                    'booking_id' => $message['booking_id'],
                    'created_at' => $message['created_at'],
                    'updated_at' => $message['updated_at']
                ];
            }
            return response()->json([
                'status' => true,
                'code' => 0,
                'message' => 'Success.',
                'data' => $data
            ]);
        }
        return response()->json([
            'status' => false,
            'code' => error_code('NOT_FOUND_RECORD'),
            'message' => 'Failed.',
            'data' => []
        ]);
    }
}
