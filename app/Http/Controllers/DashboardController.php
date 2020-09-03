<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Category;
use App\Exports\BookingExport;
use App\Group;
use App\RequestSupport;
use App\Service;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class DashboardController extends WebDriverController
{

    protected $booking;


    public function index()
    {
        $staffGroupId = Group::where('type', 'staff')->first()->id;
        $staffs = User::select('id', 'name')->where('group_id', $staffGroupId)->get()->toArray();
        $data['statics']['earnings'] = collect(Booking::where('booking_status', 'done')->get()->toArray())->sum('total_price');
        $data['statics']['services'] = Service::where('status', 1)->get()->count();
        $data['statics']['categories'] = Category::where('status', 1)->get()->count();
        $userGroupId = Group::where('type', 'user')->first()->id;
        $data['statics']['users'] = User::where('group_id', $userGroupId)->get()->count();
        return view('dashboard', array_merge(['staffs' => $staffs, 'chart' => $this->monthData()], $data));
    }

    public function chart(Request $request)
    {
        if ($request->ajax()) {
            $request->validate([
                'from' => 'required',
                'to' => 'required',
                'staff' => 'nullable|exists:users,id'
            ]);

            $booking = Booking::select('total_price', 'created_at')->where('booking_status', 'done');

            if ($request->staff && $request->staff != 0) {
                $booking->where('staff_id', $request->staff);
            }
            $booking = $booking->where('created_at', '>=', Carbon::createFromFormat('d/m/Y', $request->from)->startOfDay())->where('created_at', '<=', Carbon::createFromFormat('d/m/Y', $request->to)->endOfDay())->get();
            $data = [];
            foreach ($booking as $value) {
                $data[$value->created_at->day]['time'] = "{$value->created_at->day} / {$value->created_at->month}";
                if (isset($data[$value->created_at->day]['price'])) $data[$value->created_at->day]['price'] = $data[$value->created_at->day]['price'] + $value['total_price'];
                else $data[$value->created_at->day]['price'] = $value['total_price'];
            }

            return response()->json(collect($data)->values()->toJson());
        }
    }

    private function monthData()
    {
        $booking = Booking::select('total_price', 'created_at')->where('booking_status', 'done')->where('created_at', '>=', Carbon::now()->startOfMonth())->where('created_at', '<=', Carbon::now()->endOfMonth())->get();
        $data = [];
        foreach ($booking as $value) {
            $data[$value->created_at->day]['time'] = "{$value->created_at->day} / {$value->created_at->month}";
            if (isset($data[$value->created_at->day]['price'])) $data[$value->created_at->day]['price'] = $data[$value->created_at->day]['price'] + $value['total_price'];
            else $data[$value->created_at->day]['price'] = $value['total_price'];
        }

        return collect($data)->values()->toJson();
    }

    public function export(Request $request)
    {
        $request->validate([
            'from' => 'required',
            'to' => 'required',
            'staff' => 'nullable|exists:users,id'
        ]);
        $booking = Booking::select('id', 'booking_code', 'customer_name', 'customer_email', 'customer_phone', 'customer_address', 'note', 'total_price',
            'total_item',
            'payment_method_id',
            'booking_status',
            'staff_id',
            'time_from',
            'time_to',
            'service_id',
            'is_rated',
            'costs_incurred',
            'admin_note',
            'created_at'
        );

        if ($request->staff && $request->staff != 0) {
            $booking->where('staff_id', $request->staff);
        }

        $booking = $booking->where('created_at', '>=', Carbon::createFromFormat('d/m/Y', $request->from)->startOfDay())->where('created_at', '<=', Carbon::createFromFormat('d/m/Y', $request->to)->endOfDay())->get();
        $this->booking = $booking;
        session(['bookings' => $booking]);
        return route('admin.dashboard.download.booking');
    }

    public function download()
    {
        $booking = session('bookings');
        return Excel::download(new BookingExport($booking), 'bookings.xlsx');
    }
}
