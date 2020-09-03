<?php

namespace App\Http\Controllers\Api;

use App\Notification;
use App\NotificationUid;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index(Request $request)
    {
        if ($request->has('id')) {
            $instance = NotificationUid::where('uid', auth()->user()->id)->where('notification_id',$request->id);

            if ($instance->exists()) {
                $notification = $instance->with('notification')->first()->toArray();
                return response()->json([
                    'status' => true,
                    'code' => 0,
                    'message' => 'Success.',
                    'data' => [$notification['notification']]
                ]);
            }
            return response()->json([
                'status' => false,
                'code' => error_code('NOT_FOUND_RECORD'),
                'message' => 'Failed.',
                'data' => []
            ]);
        }
        $notifications = Notification::with(['notification_uid' => function ($query) {
            $query->where('uid', auth()->user()->id)->with('notification');
        }])->orderBy('created_at', 'DESC')->get()->toArray();
        $convert = [];
        foreach ($notifications as $notification) {
            if (isset($notification['notification_uid'][0]['notification'])) {
                $convert[$notification['notification_uid'][0]['id']] = $notification['notification_uid'][0]['notification'];
                $convert[$notification['notification_uid'][0]['id']]['is_read'] = $notification['notification_uid'][0]['is_read'];
            }
        }
        $notifications = $convert;
        return response()->json([
            'status' => true,
            'code' => 0,
            'message' => 'Success.',
            'data' => collect($notifications)->values()->toArray()
        ]);
    }

    public function read(Request $request)
    {
        if ($request->has('id') && Notification::where('id', $request->id)->exists()) {
            $instance = NotificationUid::where('uid', auth()->user()->id)->where('notification_id', $request->id);
            if ($instance->exists()) {
                $instance->update([
                    'is_read' => 1
                ]);
                return response()->json([
                    'status' => true,
                    'code' => 0,
                    'message' => 'Success.',
                    'data' => []
                ]);
            }
        }

        return response()->json([
            'status' => false,
            'code' => error_code('NOT_FOUND_RECORD'),
            'message' => 'Failed.',
            'data' => []
        ]);
    }

}
