<?php

namespace App\Exports;

use App\Booking;
use App\PaymentMethod;
use App\Service;
use App\User;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BookingExport implements FromCollection, WithHeadings
{
    protected $booking;

    public function __construct($booking)
    {
        $this->booking = $booking;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $booking = $this->booking;
        return $booking->map(function($value) {
            $value['payment_method_id'] = PaymentMethod::find($value['payment_method_id'])->name;
            if($value['staff_id']) $value['staff_id'] = User::find($value['staff_id'])->name;
            $value['service_id'] = Service::find($value['service_id'])->name;
            return $value;
        });
    }

    public function headings(): array
    {
        return [
            'ID',
            'Mã đơn hàng',
            'Tên',
            'Email',
            'SĐT',
            'Địa chỉ',
            'Ghi chú',
            'Tổng tiền',
            'Số lượng',
            'payment_method_id',
            'Trạng thái',
            'staff_id',
            'Thời gian từ',
            'Thời gian tới',
            'service_id',
            'is_rated',
            'Chi phí phát sinh',
            'Ghi chú từ admin',
            'Thời gian tạo'
        ];
    }
}
