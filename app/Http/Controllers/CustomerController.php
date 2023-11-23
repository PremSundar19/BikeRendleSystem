<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    public function showRegister()
    {
        return view('bike.register');
    }
    public function storeCustomer(Request $request)
    {
        // dd($request);
        $validateData = $request->validate([
            'firstname' => 'required|string|max:255|regex:/^[a-zA-Z.\s]+$/',
            'middlename' => 'required|nullable',
            'lastname' => 'required|nullable',
            'dob' => 'required',
            'age' => 'required',
            'gender' => 'required|not_in:- choose -',
            'email' => 'required|unique:customer,email',
            'contactno' => 'required',
            'username' => 'required|unique:customer,username',
            'password' => 'required',
        ]);
        dd($validateData);
        $customer = new Customer();
        $customer->firstname = $validateData['firstname'];
        $customer->middlename = $validateData['middlename'];
        $customer->lastname = $validateData['lastname'];
        $customer->dob = $validateData['dob'];
        $customer->age = $validateData['age'];
        $customer->gender = $validateData['gender'];
        $customer->email = $validateData['email'];
        $customer->contactno = $validateData['contactno'];
        $customer->username = $validateData['username'];
        $customer->password = Hash::make( $validateData['password']);
        $customer->save();
        return redirect('register')->with('message', 'Registered Successfully');
    }
    public function showLogin(){
        return view('bike.login');
    }
    public function verifyCustomer(Request $request)
    {
        $validate = $request->validate([ 
            'username' => 'required',
            'password' => 'required',
        ]);
        $username = $validate['username'];
        $password = $validate['password'];
        $customer =  DB::select('SELECT * FROM customer WHERE username=?',[$username]);
        if($customer){
            $hashedPassword = $customer->password;
            if(Hash::check($password, $hashedPassword)){
              return redirect('bike.index');
            }else{
                return redirect('bike.login')->with('message','password is wrong');
            }
        }else{
            return redirect('bike.login')->with('message','username is wrong');
        }
    }
    public function contactUs(){
        return view('bike.contactus');
    }
}
