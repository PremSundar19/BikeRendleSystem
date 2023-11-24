<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Session;

class BookingController extends Controller
{
    public function storeBooking(Request $request){
        $request->validate([
            'bike_id' => 'required',
            'customer_name' => 'required|string',
            'customer_email' => 'required|email',
            'dob' => 'required|date',
            'age' => 'required|integer',
            'brand_name' => 'required|string',
            'bike_name' => 'required|string',
            'duration' => 'required|string',
            'wanted_period' => 'required|integer',
            'per_hour_rent' => 'required|numeric',
            'total_amount' => 'required|numeric',
            'mobile' => 'required|string',
        ]);
        // dd($request);
        
        $bikeId = $request['bike_id'];
        $isAvailable= Booking::where('bike_id', $bikeId)->first();
        if($isAvailable){
            Session::put('message','Sorry This Bike not available');
           return redirect('showBikeBookForm');
        }
        $booking = Booking::create($request->all()); 
        Session::put('message','Sorry This Bike not available');
        Session::put('class',true);   
        return redirect('showBikeBookForm');
    }
}
