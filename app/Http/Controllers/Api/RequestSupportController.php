<?php

namespace App\Http\Controllers\Api;

use App\RequestSupport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;

class RequestSupportController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }


    public function create(Request $request)
    {
        $request->validate([
            'email' => 'required|email|string|max:255',
            'phone' => 'required|string|min:6|max:20',
            'address' => 'required|string',
            'content' => 'required|string',
            'attached_files' => 'nullable|array',
            'attached_files.*' => 'nullable|image|max:5120'
        ]);

//        if (RequestSupport::where('uid', auth()->user()->id)->where('created_at', '>=', now()->startOfDay())->where('created_at', '<=', now()->endOfDay())->count() >= 5) {
//            return response()->json([
//                'status' => false,
//                'code' => 40,
//                'message' => 'Failed.',
//                'data' => []
//            ]);
//        }

        $attached_files = [];

        if ($request->attached_files) {
            foreach ($request->attached_files as $file) {
                $attached_file = str_replace(" ", "", time() . '_' . $file->getClientOriginalName());

                $file->move('uploads', $attached_file);

                $attached_files[] = asset('uploads/' . $attached_file);
            }
        }

        $requestSupport = new RequestSupport([
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'content' => $request->get('content'),
            'attached_files' => json_encode($attached_files),
            'uid' => auth()->user()->id,
            'status' => 'create'
        ]);

        $requestSupport->save();

        unset($requestSupport['attached_files']);

        return response()->json([
            'status' => true,
            'code' => 0,
            'message' => 'Success.',
            'data' => [
                $requestSupport
            ]
        ]);
    }
}
