<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Message;
use App\UserSetting;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class ChatController extends WebDriverController
{
    public function loadMessages(Request $request)
    {
        if ($request->ajax()) {
            $request->validate([
                'booking_id' => 'required|integer|exists:booking,id'
            ]);
            $booking = Booking::findOrFail($request->booking_id);
            if (auth()->user()->group->type == 'staff') {
                $messages = Message::where('booking_id', $request->booking_id)->whereIn('from', [auth()->user()->id, $booking->uid])->whereIn('to', [auth()->user()->id, $booking->uid, null])->with(['from:id,name,avatar', 'to:id,name,avatar'])->get()->toArray();
            } else {
                $messages = Message::where('booking_id', $request->booking_id)->with(['from:id,name,avatar', 'to:id,name,avatar'])->get()->toArray();

            }
            return response()->json(
                $messages
            );
        }
    }

    public function uploadImage(Request $request)
    {
        if ($request->ajax()) {
            $request->validate([
                'image' => 'required|image|max:5120'
            ]);

            $image = str_replace(" ", "", time() . '_' . $request->image->getClientOriginalName());

            $request->image->move('uploads/', $image);

            return response()->json($image);
        }
    }

    public function sendMessage(Request $request)
    {
        if ($request->ajax()) {
            $request->validate([
                'booking_id' => 'required|integer|exists:booking,id',
                'message' => 'required|string',
                'type' => 'required|string|in:text,image'
            ]);

            $instance = Booking::where('id', $request->booking_id);
            $_instance = $instance->first()->toArray()['staff_id'];
            if ($_instance['staff_id'] == auth()->user()->id && $_instance['booking_status'] == 'processing') $instance->where('staff_id', auth()->user()->id);
            $booking = $instance->with('user:id')->first();
            $_message = $request->message;
            if ($request->type == 'image') $_message = asset('uploads/' . $request->message);

            $message = new Message([
                'from' => auth()->user()->id,
                'to' => $booking['user']['id'],
                'type' => $request->type,
                'message' => $_message,
                'created_at' => now(),
                'booking_id' => $request->booking_id,
                'from_type' => 'staff',
                'is_read' => 0
            ]);

            $message->save();

            $instance = UserSetting::select('value','uid')->where('uid', $booking['user']['id'])->where('setting_code', 'fcm_token')->get()->toArray();
            $collection = collect($instance)->map(function ($elm) {
                if(check_token($elm['uid'])) {
                    return $elm['value'];
                } else {
                    return null;
                }
            });

            $tokens = $collection->toArray();

            if ($tokens) {
                $this->sendNotification($tokens, 'Có tin nhắn mới !', $_message, $message->id, $request->booking_id);
            }


            return response()->json([
                'message' => $message->message,
                'time' => $message->created_at
            ]);
        }
    }

    public function readAll(Request $request) {
        $instance = Message::where('booking_id',$request->booking_id)->where('is_read',0)->where('from_type','user');
        if($instance->exists()) {
            $instance->update([
                'is_read' => 1
            ]);
            return response()->json(true);
        }
        return response()->json(false);
    }

    private function sendNotification($tokens, $title, $body, $id, $bookingId)
    {
        $url = "https://fcm.googleapis.com/fcm/send";
        $registration_ids = $tokens;
        $serverKey = config('netvas.fcm_key');
        $notification = ['title' => $title, 'body' => $body,'click_action' => 'message'];
        $arrayToSend = array('registration_ids' => $registration_ids, 'notification' => $notification, 'priority' => 'high', 'data' => array_merge(['id' => $id, 'idBooking' => $bookingId, 'click_actionx`' => 'message'], $notification));
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
