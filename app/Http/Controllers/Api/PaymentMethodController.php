<?php

namespace App\Http\Controllers\Api;

use App\PaymentMethod;
use App\Payments\VNPay;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaymentMethodController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['create', 'return','index']]);
    }

    public function index(Request $request)
    {
        if($request->has('id') && $request->id) {
            $instance = PaymentMethod::where('id',$request->id);
            if($instance->exists()) {
                return response()->json([
                    'status' => true,
                    'code' => 0,
                    'message' => 'Success.',
                    'data' => $instance->get()->toArray()
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'code' => error_code('NOT_FOUND_RECORD'),
                    'message' => 'Failed.',
                    'data' => []
                ]);
            }
        }
        return response()->json([
            'status' => true,
            'code' => 0,
            'message' => 'Success.',
            'data' => PaymentMethod::orderBy('status','DESC')->get()->toArray()
        ]);
    }

    public function create(Request $request)
    {
        $request->validate([
            'payment_method_id' => 'required|integer|exists:payment_methods,id',
            'amount' => 'required|integer',
            'order_desc' => 'required'
        ]);

        $payment = PaymentMethod::findOrFail($request->payment_method_id);

        if ($payment->code === 'vnpay') return (new VNPay())->create($request);

    }

    public function return(Request $request)
    {
        return (new VNPay())->return($request);
    }
}
