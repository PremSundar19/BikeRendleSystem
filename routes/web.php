<?php

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