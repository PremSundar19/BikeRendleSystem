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
            }
        }
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
    }
    public function storeBooking(Request $request)
    {

        $data = $request->booking;

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

    public function returnVehicle($bookingId)
    {
        $booking = DB::select('SELECT * FROM booking WHERE booking_id=?', [$bookingId]);
        $currentDateTime = Carbon::now('Asia/Kolkata');
        $return_date = $currentDateTime->format('Y-m-d');
        $return_time = $currentDateTime->format('H:i:s');

        $duration = $booking[0]->duration;
        $expectedReturnTime = Carbon::parse($booking[0]->created_at);

        if ($duration === "Hour" || $duration === "Hours") {
            $expectedReturnTime = $expectedReturnTime->addHours($booking[0]->wanted_period);
        } else if ($duration === "Day" || $duration === "Days") {
            $expectedReturnTime = $expectedReturnTime->addDays($booking[0]->wanted_period);
        } else if ($duration === "Week" || $duration === "Weeks") {
            $expectedReturnTime = $expectedReturnTime->addWeeks($booking[0]->wanted_period);
        }

        $booked_date = $currentDateTime->format('Y-m-d');
        $booked_time = $expectedReturnTime->format('H:i:s');

        $data = [
            'booking_id' => $booking[0]->booking_id,
            'customer_name' => $booking[0]->customer_name,
            'customer_email' => $booking[0]->customer_email,
            'brand_name' => $booking[0]->brand_name,
            'bike_name' => $booking[0]->bike_name,
            'paid_amount' => $booking[0]->total_amount,
            'fine_amount' => $booking[0]->fine_amount,
            'booked_date' => $booked_date,
            'booked_time' => $booked_time,
            'return_date' => $return_date,
            'return_time' => $return_time,
            'address' => $booking[0]->address,
            'mobile' => $booking[0]->mobile,
            'perhr' => $booking[0]->per_hour_rent,
            'duration' => $booking[0]->duration,
            'wanted_period' => $booking[0]->wanted_period,

        ];
        return session('userId') ? view('bike.bikeReturn', ['booking' => $data]): redirect('index');
    }


    public function updateVehicleById($bookingId)
    {
        $rowAffected = DB::update('UPDATE booking SET status=? WHERE booking_id=?', ['bike returned', $bookingId]);
        return response()->json(array('message' => 'Bike returned successfully', 'class' => 'success'));

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
        $checkAvailable = DB::select('SELECT * FROM booking WHERE bike_name=? and status=?', [$bike, 'need to return']);
        if ($checkAvailable) {
            return response()->json(array('isExists' => true));
        }
    }

    public function calculateFine(Request $request)
    {
        $booking_id = $request['booking_id'];
        $booking = DB::select('SELECT * FROM booking WHERE booking_id=?', [$booking_id]);
        $currentDateTime = Carbon::now('Asia/Kolkata');
        $currentTime = $currentDateTime->format('H:i:s');
        $currentDate = $currentDateTime->format('Y-m-d');

        if ($booking) {
            $duration = $booking[0]->duration;
            $expectedReturnTime = Carbon::parse($booking[0]->created_at);

            if ($duration === "Hour" || $duration === "Hours") {
                $expectedReturnTime = $expectedReturnTime->addHours($booking[0]->wanted_period);
            } else if ($duration === "Day" || $duration === "Days") {
                $expectedReturnTime = $expectedReturnTime->addDays($booking[0]->wanted_period);
            } else if ($duration === "Week" || $duration === "Weeks") {
                $expectedReturnTime = $expectedReturnTime->addWeeks($booking[0]->wanted_period);
            }
            $fine = 0;

            $expectedTime = $expectedReturnTime->format('H:i:s');
            $expectedDate = $currentDateTime->format('Y-m-d');

            // echo "currentDateTime : " . $currentTime . " expectedReturnTime : " . $expectedTime;
            if ($expectedDate === $currentDate && $currentTime > $expectedTime) {
                $hoursLate = $currentDateTime->diffInHours($expectedReturnTime);
                // echo $hoursLate;
                $fine = $hoursLate * 10;
            } elseif ($currentDateTime > $expectedReturnTime) {
                $hoursLate = $currentDateTime->diffInHours($expectedReturnTime);
                $fine = $hoursLate * 10;
            }
            DB::update('UPDATE booking SET fine_amount=? WHERE booking_id=?', [$fine, $booking_id]);
            return response()->json(['success' => true, 'fine' => $fine, 'message' => 'updated successfully']);
        } else {
            return response()->json(['success' => false, 'message' => 'Something Went Wrong']);
        }
    }


}
