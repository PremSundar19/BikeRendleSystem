<?php

namespace App\Http\Controllers;

use App\Mail\BookingConfirmation;
use App\Models\Booking;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use DB;
use Mail;

class BookingController extends Controller
{

    public function saveBooking(Request $request)
    {
        // dd($request);

        $request->validate([
            'bikeId' => 'required',
            'userId' => 'required',
            'name' => 'required',
            'email' => 'required',
            'dob' => 'required',
            'age' => 'required',
            'brand' => 'required',
            'bike' => 'required',
            'duration' => 'required',
            'wantedPeriod' => 'required',
            'rate' => 'required',
            'amount' => 'required',
            'mobile' => 'required',
            'address' => 'required',
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
        $booking = [
            'bike_id' => $bikeId,
            'user_id' => $request['userId'],
            'customer_name' => $request['name'],
            'customer_email' => $request['email'],
            'dob' => $request['dob'],
            'age' => $request['age'],
            'brand_name' => $request['brand'],
            'bike_name' => $request['bike'],
            'duration' => $duration,
            'wanted_period' => $wantedPeriod,
            'per_hour_rent' => $request['rate'],
            'total_amount' => $request['amount'],
            'mobile' => $request['mobile'],
            'address' => $request['address'],
            'created_at' => Carbon::now('Asia/Kolkata')->toDateTimeString(),
        ];

        return view('bike.bill', ['booking' => $booking]);

        // $rowAffected = $booking->save();

        // if ($rowAffected) {
        //     Mail::to($booking->email)->send(new BookingConfirmation($booking));

        //     Session::flash('bookingmessage', 'Booked Successfully');
        //     Session::flash('class', 'success');
        //     Session::flash('status', true);
        //     return redirect()->back();
        // }
    }
    public function store(Request $request)
    {
        // dd($request->booking);
        $data = $request->booking;
        //    dd($data->bike_id);
        // Booking::create($request->booking);

        $booking = new Booking();
        $booking->bike_id = $data['bike_id'];
        $booking->user_id = $data['user_id'];
        $booking->customer_name = $data['customer_name'];
        $booking->customer_email = $data['customer_email'];
        $booking->dob = $data['dob'];
        $booking->age = $data['age'];
        $booking->brand_name = $data['brand_name'];
        $booking->bike_name = $data['bike_name'];
        $booking->duration = $data['duration'];
        $booking->wanted_period = $data['wanted_period'];
        $booking->per_hour_rent = $data['per_hour_rent'];
        $booking->total_amount = $data['total_amount'];
        $booking->mobile = $data['mobile'];
        $booking->address = $data['address'];
        $booking->created_at = $data['created_at'];
        $booking->save();
        return response()->json(array('message' => 'Booked Successfully'));
    }
     
    public function returnvehicle($bookingId){
    //    dd($bookingId);
    $booking = DB::select('SELECT * FROM booking WHERE booking_id=?', [$bookingId]);
    // dd($booking);
    
    // return redirect('bikeReturn');
    return view('bike.bikeReturn', ['booking' => $booking]);
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
        $booking = DB::select('SELECT * FROM booking WHERE booking_id=?', [$booking_id]);
        $currentDateTime = Carbon::now('Asia/Kolkata');
        if ($booking) {

            $duration = $booking[0]->duration;
            $expectedReturnTime = Carbon::parse($booking[0]->created_at);
            if ($duration === "Hour" || $duration === "Hours") {
                $expectedReturnTime = $expectedReturnTime->addHours($booking[0]->wanted_period);
            } else if ($duration === "Day" || $duration === "Days") {
                $expectedReturnTime = $expectedReturnTime->addDays($booking[0]->wanted_period);
            } else if ($duration === "Week" || $duration === "Weeks") {
                $expectedReturnTime = $expectedReturnTime->addWeeks($booking[0]->wanted_period);
            } else if ($duration === "Month" || $duration === "Months") {
                $expectedReturnTime = $expectedReturnTime->addMonth($booking[0]->wanted_period);
            }
            $fine = 0;
            if ($currentDateTime > $expectedReturnTime) {
                $hoursLate = $currentDateTime->diffInHours($expectedReturnTime);
                $fine = $hoursLate * 10;
            }
            DB::update('UPDATE booking SET fine_amount=? WHERE BOOKING_ID=?', [$fine, $booking_id]);
            return response()->json(['success' => true, 'fine' => $fine, 'message' => 'updated successfully']);
        } else {
            return response()->json(['success' => false, 'message' => 'Booking not found']);
        }
    }

}
