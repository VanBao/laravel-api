<?php

namespace App\Http\Controllers;

use App\BookingRating;
use Illuminate\Http\Request;

class RatingController extends WebDriverController
{
    public function index()
    {
        $data['data'] = BookingRating::with(['booking' => function($query) {
            $query->with('staff');
        }])->with('user')->orderBy('created_at','DESC')->get();
        return view('rating.index',$data);
    }

    public function detail($id) {
        BookingRating::findOrFail($id)->update(['is_read' => 1]);
        $data['data'] = BookingRating::with(['booking' => function($query) {
            $query->with('staff');
        }])->with('user')->findOrFail($id)->toArray();
        return view('rating.detail',$data);
    }

    public function read($id) {
        BookingRating::findOrFail($id)->update(['is_read' => 1]);
        return back();
    }
}
