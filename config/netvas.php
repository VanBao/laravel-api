<?php

use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

return [
    'errors_code' => [
        'LOGIN_FAILED' => 1,
        'USER_NOT_EXISTS' => 2,
        'CODE_INVALID' => 3,
        'CODE_LIMIT' => 4,
        'CODE_OVER' => 5,
        'CODE_OR_EMAIL_NOT_CORRECT_RESET_PASSWORD' => 6,
        'CODE_NOT_VERIFY' => 7,
        'UNAUTHENTICATED' => 8,
        'NOT_FOUND_RECORD' => 9,
        ValidationException::class => 10,
        NotFoundHttpException::class => 11,
        MethodNotAllowedHttpException::class => 12,
        'PAY_FAILED' => 13,
        'WRONG_SIGNATURE' => 14,
        'RATE_FAILED' => 15,
        'BOOKING_NOT_DONE' => 16,
        'BOOKING_FAILED' => 17,
        'NEW_PASSWORD_REQUIRED' => 18,
        'PASSWORD_NOT_MATCH' => 19,
        'OTHER_ERROR' => 20,
        'TOKEN_QUERY' => 21,
        'UID_NOT_CORRECT' => 22,
        'VALUE_NOT_VALID' => 23,
        'BOOKING_CHAT_OVER'=> 24,
        'EMAIL_EXISTS' => 25,
        'PHONE_EXISTS' => 26,
        'EMAIL_NOT_EXISTS' => 27,
        'BOOKING_CODE_IS_REQUIRED' => 28
    ],
    'vnpay' => [
        'tmn_code' => 'KARD3FZ1',
        'hash_secret' => 'IDEVCNENZWDTILSODOIEWVEKJDJFMGYR',
        'url' => "http://sandbox.vnpayment.vn/paymentv2/vpcpay.html",
        'return_url' => "http://localhost/netvas/public/api/payment-method/return"
    ],
    'fcm_key' => 'AAAAbTbaPXY:APA91bHGk8GR9DI_9m-PTD5tLADuz1hNnci6RyuxoLg2KtbkWrKxgDtlY97qQrRFaRLeHtVnV7EdHNrwJjeFVqhbVuKJ8-_Ld2joOpApxBAA1jc-yZlzBQguk3JTIvI7IbmG32ANCZhU'
];
//
//$vnp_TmnCode = "KARD3FZ1"; //Mã website tại VNPAY
//$vnp_HashSecret = "IDEVCNENZWDTILSODOIEWVEKJDJFMGYR"; //Chuỗi bí mật
//$vnp_Url = "http://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
//$vnp_Returnurl = "http://localhost/vnpay_php/vnpay_return.php";
