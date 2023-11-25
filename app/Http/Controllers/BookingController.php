<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use DB;

class BookingController extends Controller
{

    public function saveBooking(Request $request)
    {
        // dd($request);

        $request->validate([
            'bikeId' => 'required',
            'userId' => 'required',
            'name' => 'required',
            'email' => 'required|unique:booking,customer_email',
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


        $bikeId = $request['bikeId'];
        $isAvailable = Booking::where('bike_id', $bikeId)->first();
        if ($isAvailable) {
            Session::flash('bookingmessage', 'Sorry This Bike not available');
            Session::flash('class', 'danger');
            return redirect()->back();
        }
        $duration = $request['duration'];
        $wantedPeriod = $request['wantedPeriod'];
        if ($wantedPeriod > 1) {
            if ($duration === "Hour") {
                $duration = "Hours";
            } else if ($duration === "Day") {
                $duration = "Days";
            } else if ($duration === "Week") {
                $duration = "Weeks";
            } else if ($duration === "Month") {
                $duration = "Months";
            }
        }
        // dd($duration);
        $booking = new Booking();
        $booking->bike_id = $bikeId;
        $booking->user_id = $request['userId'];
        $booking->customer_name = $request['name'];
        $booking->customer_email = $request['email'];
        $booking->dob = $request['dob'];
        $booking->age = $request['age'];
        $booking->brand_name = $request['brand'];
        $booking->bike_name = $request['bike'];
        $booking->duration = $duration;
        $booking->wanted_period = $wantedPeriod;
        $booking->per_hour_rent = $request['rate'];
        $booking->total_amount = $request['amount'];
        $booking->mobile = $request['mobile'];
        $rowAffected = $booking->save();
        if ($rowAffected) {
            Session::flash('bookingmessage', 'Booked Successfully');
            Session::flash('class', 'success');
            Session::flash('status', true);
            return redirect()->back();
        }
    }


    public function fetchBookings()
    {
        return Booking::all();
    }

    public function fetchBookingById($userId)
    {
        return DB::select('SELECT * FROM booking WHERE user_id=?', [$userId]);
    }
    public function checkAvailable($bike)
    {
        $checkAvailable = DB::select('SELECT * FROM booking WHERE bike_name=?', [$bike]);

        if ($checkAvailable) {
            return response()->json(array('isExists' => true));
        }
    }

    public function calculateFine(Request $request)
    {
        $booking_id = $request['booking_id'];
        $booking = DB::select('SELECT * FROM booking WHERE booking_id=?',[$booking_id]);
        dd($booking);
        if ($booking) {
            $expectedReturnTime = Carbon::parse($booking->created_at)->addHours($booking->wanted_period);
            $currentDateTime = Carbon::now();
            $fine = 0;
            if ($currentDateTime > $expectedReturnTime) {
                $hoursLate = $currentDateTime->diffInHours($expectedReturnTime);
                $fine = $hoursLate * 10;
            }
            $booking->fine_amount = $fine;
            $booking->save();
            return response()->json(['success' => true, 'fine' => $fine]);
        }

        return response()->json(['success' => false, 'message' => 'Booking not found']);
    }

}
