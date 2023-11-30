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
        $user_id = $request['userId'];
        $customer = DB::select('SELECT * FROM customer WHERE id=?', [$user_id]);
        $customer_name = $customer[0]->firstname;
        $customer_email = $customer[0]->email;
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
        $created_at = Carbon::now('Asia/Kolkata');
        $booked_date = $created_at->format('Y-m-d');
        $booked_time = $created_at->format('H:i:s');
        $booking = [
            'bike_id' => $request['bikeId'],
            'user_id' => $request['userId'],
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
            'customer_name' => $customer_name,
            'customer_email' => $customer_email,
            'booked_date' => $booked_date,
            'booked_time' => $booked_time,
        ];
        return view('bike.bill', ['booking' => $booking]);
    }
    public function storeBooking(Request $request)
    {
        $data = $request->booking;
        $booking = Booking::insert($data);
        return response()->json(array('message' => 'Booked Successfully'));
    }

    public function returnVehicle($bookingId)
    {
        $booking = DB::select('SELECT booking.*, customer.firstname AS customer_name, customer.email AS customer_email
        FROM booking
        JOIN customer ON customer.id = booking.user_id
        WHERE booking.booking_id = ?', [$bookingId]);
        $currentDateTime = Carbon::now('Asia/Kolkata');
        $booking[0]->return_date=$currentDateTime->format('Y-m-d');
        $booking[0]->return_time=$currentDateTime->format('H:i:s');
        return session('userId') ? view('bike.bikeReturn', ['booking' => $booking]) : redirect('index');
    }



    public function updateVehicle(Request $request)
    {
        $data = $request->booking;
        $rowAffected = DB::update('UPDATE booking SET status=?,return_date=?,return_time=? WHERE booking_id=?', ['bike returned', $data[0]['return_date'], $data[0]['return_time'], $data[0]['booking_id']]);
        return response()->json(array('message' => 'Bike returned successfully', 'class' => 'success'));
    }

    public function showBill($bookingId)
    {
        $booking = DB::select('SELECT booking.*, customer.firstname AS customer_name, customer.email AS customer_email
                       FROM booking
                       JOIN customer ON customer.id = booking.user_id
                       WHERE booking.booking_id = ?', [$bookingId]);
        $totalAmount = $booking[0]->total_amount + $booking[0]->fine_amount;
        $booking[0]->totalAmount = $totalAmount;
        return session('userId') ? view('bike.showbill', ['booking' => $booking]) : view('bike.showbill2', ['booking' => $booking]);
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
            if ($expectedDate === $currentDate && $currentTime > $expectedTime) {
                $hoursLate = $currentDateTime->diffInHours($expectedReturnTime);
                $amount = $booking[0]->per_hour_rent;
                $part = 10;
                $fineValue = ($part / $amount) * 100;
                $fine = $hoursLate * $fineValue;
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
