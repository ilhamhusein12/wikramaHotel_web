<?php

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
 

//login
Route::get('/login', 'Login\LoginController@index');

//room
Route::get('/room', 'Room\RoomController@index');

//user
Route::get('/user', 'User\UserController@index');

//booking
Route::get('/booking', 'Booking\BookingController@index');

//Home
Route::get('/home', 'Home\HomeController@index');