<?php

namespace App\Http\Controllers;

use App\Notification;
use App\NotificationUid;
use App\RequestSupport;
use App\UserSetting;
use Illuminate\Http\Request;
use App\Group;
use App\User;
use GuzzleHttp\Client;

//use Http

class NotificationController extends WebDriverController
{

    public function index()
    {
//        Noti
        $data['users'] = User::with(['user_setting' => function ($query) {
            $query->where('setting_code', 'fcm_token');
        }])->get()->toArray();
        $data['data'] = Notification::orderBy('created_at', 'DESC')->get()->toArray();
        return view('notification.index', $data);
    }

    public function detail($id)
    {
        $data['data'] = Notification::with(['notification_uid' => function ($query) {
            $query->with('uid');
        }])->findOrFail($id)->toArray();
        return view('notification.detail', $data);
    }

    public function send(Request $request)
    {
        if ($request->ajax()) {
            $request->validate([
                'title' => 'required|string|max:255',
                'content' => 'required|string',
                'image' => 'nullable|string',
                'send_id' => 'required|array'
            ]);


            if ($request->has('private_id') && $request->private_id && RequestSupport::where('id', $request->private_id)->exists()) {
                RequestSupport::where('id', $request->private_id)->update([
                    'status' => 'answer'
                ]);
            }

            $noti = new Notification([
                'title' => $request->title,
                'content' => $request->get('content'),
                'image' => ($request->has('image') && $request->image) ? $request->image : null,
                'created_id' => auth()->user()->id,
            ]);

            $noti->save();

            $instance = UserSetting::select('value','uid')->whereIn('uid', (array)$request->send_id)->where('setting_code', 'fcm_token')->get()->toArray();
            $collection = collect($instance)->map(function ($elm) {
                if(check_token($elm['uid'])) {
                    return $elm['value'];
                } else {
                    return null;
                }
            });

            $tokens = $collection->toArray();

            if ($tokens) {
                $this->sendNotification($tokens, $request->title, $request->get('content'), ($request->has('image') && $request->image) ? $request->image : null, $noti->id);
            }

            $nuid = [];

            if ($request->send_id) {
                foreach ($request->send_id as $uid) {
                    if (User::where('id', $uid)->exists()) {
                        $nuid[] = [
                            'uid' => $uid,
                            'notification_id' => $noti->id
                        ];
                    }
                }
            }

            NotificationUid::insert($nuid);

            return response()->json(true);
        }
    }

    private function sendNotification($tokens, $title, $body, $image = null,$id = null)
    {
        $url = "https://fcm.googleapis.com/fcm/send";
        $registration_ids = $tokens;
        $serverKey = config('netvas.fcm_key');
        $notification = array('title' => $title, 'body' => $body,'click_action' => 'notification');
        if ($image) $notification['image'] = $image;
        $arrayToSend = array('registration_ids' => $registration_ids, 'notification' => $notification, 'priority' => 'high', 'data' => array_merge(['click_action' => 'notification','id' => $id], $notification));
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
}
