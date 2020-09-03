<?php

namespace App\Payments;

interface PaymentInteface {
    public function create($request);
    public function return($request);
}
