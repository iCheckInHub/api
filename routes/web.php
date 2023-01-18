<?php

use App\Models\Employee;
use App\Models\Order;
use App\Models\Place;
use App\Models\User;
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
Route::get('/test', function () {
  $order = Order::first();

  return $order->created_at->format('Y') . str_pad($order->no, 6, 0, STR_PAD_LEFT);
});


Route::get('/auth/user', function () {
  $user = User::first();
  $token = $user->createToken('authToken')->plainTextToken;
  return $token;
});

Route::get('/auth/employee', function () {
  $employee = Employee::first();
  $token = $employee->createToken('authToken')->plainTextToken;
  return $token;
});
