<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Session;

class BookingController extends Controller
{

public function store(Request $request){
    $request->validate([
        'bike_id' => 'required',
        'name' => 'required',
        'email' => 'required|unique:booking,email',
        'dob' => 'required',
        'age' => 'required',
        'brand' => 'required',
        'bike' => 'required',
        'duration' => 'required',
        'wantedPeriod' => 'required',
        'rate' => 'required',
        'amount' => 'required',
        'mobile' => 'required',
    ]);


    $bikeId = $request['bike_id'];
    $isAvailable = Booking::where('bike_id', $bikeId)->first();
    if ($isAvailable) {
        Session::put('message', 'Sorry This Bike not available');
        return redirect('showBikeBookForm');
    }

    $booking = new Booking();
    $booking->bike_id = $request['bike_id'];
    $booking->customer_name = $request['name'];
    $booking->customer_email = $request['email'];
    $booking->dob = $request['dob'];
    $booking->age = $request['age'];
    $booking->brand_name = $request['brand_name'];
    $booking->bike_name = $request['bike_name'];
    $booking->wanted_period = $request['wanted_period'];
    $booking->per_hour_rent = $request['per_hour_rent'];
    $booking->total_amount = $request['total_amount'];
    $booking->mobile = $request['mobile'];
    $rowAffected = $booking->save();
    if ($rowAffected) {
        Session::put('message', 'Booked Successfully');
        Session::put('class', true);
        return redirect('showBikeBookForm');
    }
}
    public function fetchBookings()
    {
        return Booking::all();
    }
}
