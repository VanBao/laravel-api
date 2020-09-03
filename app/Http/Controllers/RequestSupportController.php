<?php

namespace App\Http\Controllers;

use App\RequestSupport;
use Illuminate\Http\Request;

class RequestSupportController extends WebDriverController
{
    public function index()
    {
//        dd(RequestSupport::all());
        $data['data'] = RequestSupport::with('user:id,name')->orderBy('created_at','DESC')->get();
        return view('request-support.index', $data);
    }

    public function detail($id)
    {
        $requestSupport = RequestSupport::with('user:id,name')->findOrFail($id);
        if($requestSupport->status == 'create') {
            $requestSupport->update([
                'status' => 'read'
            ]);
        }
        return view('request-support.detail', ['data' => $requestSupport]);
    }

    public function update(Request $request,$id)
    {
        $requestSupport = RequestSupport::where('id',$id);
        if(!$requestSupport->exists()) return response()->json(false);
        if($request->ajax() && $requestSupport->exists()) {
            $request->validate([
                'status' => 'required|in:create,answer|string'
            ]);

            $requestSupport->update([
                'status' => $request->status
            ]);

            return response()->json(true);
        }
        return response()->json(false);
    }

    public function answer(Request $request) {
        if($request->ajax()) {

        }
    }
}
