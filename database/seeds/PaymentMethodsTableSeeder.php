<?php

use Illuminate\Database\Seeder;
use App\PaymentMethod;

class PaymentMethodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PaymentMethod::insert([
            [
                'name' => 'VNPay ( chưa phát triển )',
                'code' => 'vnpay',
                'type' => 'online',
                'status' => 0,
                'avatar' => 'https://vnpay.vn/wp-content/uploads/2019/10/Text-QR-2.png',
                'created_at' => now()
            ],
            [
                'name' => 'Momo ( chưa phát triển )',
                'code' => 'momo',
                'type' => 'online',
                'status'  => 0,
                'avatar' => 'https://static.mservice.io/img/logo-momo.png',
                'created_at' => now()
            ],
            [
                'name' => 'Thanh toán trực tiếp',
                'code' => 'direct',
                'type' => 'offline',
                'status' => 1,
                'avatar' => 'https://toppng.com/uploads/preview/winston-traitel-realty-handshake-icon-transparent-11553402832edhvkndg4q.png',
                'created_at' => now()
            ]
        ]);
    }
}
