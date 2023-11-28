<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use DB;
class BikeController extends Controller
{
    public function storeBike(Request $request){
       $request->validate([
        'brand_name'=>'required',
        'bike_name'=>'required',
        'bike_cc'=>'required',
        'per_hour'=>'required',
       ]);

       $brand = new Brand();
       $brand->brand = $request->brand_name;   
       $brand->bikename =$request->bike_name;
       $brand->bikecc = $request->bike_cc;
       $brand->perhour = $request->per_hour;
       $brand->save();
       return redirect('admindashboard')->with('message','Bike saved Successfully!');
    }

    public function showBikeBookForm(){
        return view('bike.bookbike');
    }

    public function fetchBikes($brand){
       return Brand::where('brand', $brand)->get();
    }
    public function fetchBikePerCharge($bike){
        return Brand::where('bikename', $bike)->get();
    }
  
}
