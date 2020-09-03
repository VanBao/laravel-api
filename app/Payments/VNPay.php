<?php
namespace App\Payments;

use Illuminate\Http\Request;

class VNPay implements PaymentInteface {
    public function create($request) {
        $vnp_TmnCode = config('netvas.vnpay.tmn_code'); //Mã website tại VNPAY
        $vnp_HashSecret = config('netvas.vnpay.hash_secret'); //Chuỗi bí mật
        $vnp_Url = config('netvas.vnpay.url');
        $vnp_Returnurl = config('netvas.vnpay.return_url');
        $vnp_TxnRef = date('YmdHis'); //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = $request->order_desc;
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = (int)$request->amount * 100;
        $vnp_Locale = 'vn';
        $vnp_BankCode = '';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

        $inputData = array(
            "vnp_Version" => "2.0.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . $key . "=" . $value;
            } else {
                $hashdata .= $key . "=" . $value;
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            // $vnpSecureHash = md5($vnp_HashSecret . $hashdata);
            $vnpSecureHash = hash('sha256', $vnp_HashSecret . $hashdata);
            $vnp_Url .= 'vnp_SecureHashType=SHA256&vnp_SecureHash=' . $vnpSecureHash;
        }
        return response()->json([
            'status' => true,
            'code' => 0,
            'messagse' => 'Success.',
            'data' => $vnp_Url
        ]);
    }

    public function return($request) {
        $vnp_HashSecret = config('netvas.vnpay.hash_secret'); //Chuỗi bí mật
        $vnp_SecureHash = $_GET['vnp_SecureHash'];
        $inputData = array();
        foreach ($_GET as $key => $value) {
            if (substr($key, 0, 4) == "vnp_") {
                $inputData[$key] = $value;
            }
        }
        unset($inputData['vnp_SecureHashType']);
        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $i = 0;
        $hashData = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData = $hashData . '&' . $key . "=" . $value;
            } else {
                $hashData = $hashData . $key . "=" . $value;
                $i = 1;
            }
        }

        //$secureHash = md5($vnp_HashSecret . $hashData);
        $secureHash = hash('sha256', $vnp_HashSecret . $hashData);

        $code = null;

        if ($secureHash == $vnp_SecureHash) {
            if ($_GET['vnp_ResponseCode'] == '00') {
                $code = 0;
            } else {
                $code = error_code('PAY_FAILED');
            }
        } else {
            $code = error_code('WRONG_SIGNATURE');
        }

        return response()->json([
            'status' => ($code == 0) ? true : false,
            'code' => $code,
            'message' => ($code == 0) ? 'Success.' : 'Failed.' ,
            'data' => $request->all()
        ]);
    }
}
