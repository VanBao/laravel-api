<?php

namespace App\Http\Controllers;

use App\BookingRating;
use App\Group;
use App\User;
use Illuminate\Http\Request;

class RankingController extends WebDriverController
{
    public function index()
    {
        $staffGroupId = Group::where('type', 'staff')->first()->id;
        $staffs = User::where('group_id', $staffGroupId)->with(['booked' => function ($query) {
            $query->where('booking_status','done')->with('booking_rating');
        }])->get()->toArray();

        $data = [];

        foreach ($staffs as $index => $staff) {
            $score = collect($staff['booked'])->avg('booking_rating.rating');
            $total = collect($staff['booked'])->sum('total_price');
            if ($staff['booked'] && $score > 0) {
                $data[$index] = [
                    'id' => $staff['id'],
                    'name' => $staff['name'],
                    'phone' => $staff['phone'],
                    'booking_times' => count($staff['booked']),
                    'total' => $total
                ];
                $data[$index]['score'] = $score;
            }
        }

        $collection = collect($data);
        $sorted = $collection->sortByDesc('score');
        return view('ranking.index', ['data' => $sorted->values()->all()]);
    }
}
