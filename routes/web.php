<?php

use App\Http\Controllers\BikeController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('register', [CustomerController::class, 'showRegister']);
Route::post('storeCustomer', [CustomerController::class, 'storeCustomer']);
Route::get('login', [CustomerController::class, 'showLogin']);
Route::post('verifyCustomer', [CustomerController::class, 'verifyCustomer']);
Route::get('index', function () {
    return view('bike.index');
});
Route::get('contactUs', [CustomerController::class,'contactUs']);
Route::get('dashboard',[CustomerController::class,'dashboard']);
Route::get('admindashboard',[CustomerController::class,'admindashboard']);

Route::get('showBikeBookForm',[BikeController::class,'showBikeBookForm']);
Route::post('storeBike',[BikeController::class,'storeBike']);
Route::get('fetchBikes/{brand}',[BikeController::class,'fetchBikes']);
Route::get('fetchBikePerCharge/{bike}',[BikeController::class,'fetchBikePerCharge']);

Route::post('storeBooking',[BookingController::class ,'store']);
Route::get('fetchBookings',[BookingController::class,'fetchBookings']);