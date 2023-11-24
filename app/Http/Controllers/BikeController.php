<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BikeController extends Controller
{
    public function storeBike(Request $request){
       $request->validate([
        'brand_name'=>'required',
        'bike_name'=>'required',
        'bike_cc'=>'required',
       ]);
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
