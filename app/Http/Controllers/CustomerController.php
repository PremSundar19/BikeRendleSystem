<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\FeedBack;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Session;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    public function showRegister()
    {
        return view('bike.register');
    }
    public function storeCustomer(Request $request)
    {
        $request->validate([
            'firstname' => 'required|string|regex:/^[a-zA-Z.\s]+$/',
            'dob' => 'required',
            'age' => 'required',
            'gender' => 'required|not_in:- choose -',
            'email' => 'required|unique:customer,email',
            'contactno' => 'required',
            'password' => 'required',
        ]);
        $customer = new Customer();
        $customer->firstname = $request['firstname'];
        $customer->lastname = $request['lastname'];
        $customer->dob = $request['dob'];
        $customer->age = $request['age'];
        $customer->gender = $request['gender'];
        $customer->email = $request['email'];
        $customer->mobile = $request['contactno'];
        $customer->password = Hash::make($request['password']);
        $customer->save();
        return redirect('register')->with('registermessage', 'Registered Successfully');
    }
    public function showLogin()
    {
        return view('bike.login');
    }
    public function verifyCustomer(Request $request)
    {
        $email = $request['email'];
        $password = $request['password'];
        $type = $request['type'];
        if ($type === null) {
            return redirect('index')->with('indexmessage', 'Please select type');
        }
        if ($type === "admin" && $email === "admin123@gmail.com" && $password === "Admin@123") {
            session(['adminId' => 1]);
            return $this->admindashboard();
        } else if ($type === "user") {
            $customer = Customer::where('email', $email)->first();
            if ($customer && Hash::check($password, $customer->password)) {
                session(['userId' => $customer->id, 'firstName' => 'welcome '.$customer->firstname, 'lastName' => $customer->lastname]);
                return redirect('dashboard');
            }
        }
        return redirect('index')->with('indexmessage', 'Email or Password is invalid');
    }
    public function contactUs()
    {
        return view('bike.contactus');
    }
    public function dashboard()
    {
        return session('userId') ? view('bike.dashboard') : redirect('index');
    }
    public function admindashboard()
    {
        return session('adminId') ? view('bike.admindashboard') : redirect('index');
    }

    public function logout()
    {
        session::flush();
        // Session::flash('message', 'You have been successfully logged out.');
        return redirect()->back();
    }
    public function fetchCustomers(){
        return Customer::all();
    }
    public function saveFeedback(Request $request){
       
        $feedback = new FeedBack();
        $feedback->name = $request['name'];
        $feedback->email =  $request['contactemail'];
        $feedback->feedback = $request['feedback'];
      $feedback->save();
    }
}
