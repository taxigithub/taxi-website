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
    return view('home');
});

Auth::routes();
Route::get('/footer/{footerPageName}', 'HomeController@showFooterPage');
Route::get('/admin', 'AdminController@Index')->middleware('auth');
Route::get('/objects/price/add', 'AdminController@AddPrice')->middleware('auth');
Route::get('/objects/add', 'AdminController@AddObject')->middleware('auth');
Route::post('/objects/add', 'AdminController@StoreObject')->middleware('auth');
Route::post('/objects/price/add', 'AdminController@StorePrice');
Route::get('/objects/price/edit/{id}', 'AdminController@EditPrice')->middleware('auth');
Route::put('/objects/price/edit', 'AdminController@UpdatePrice');


Route::get('/actual', 'ProfileController@ActualOrder')->middleware('auth');



Route::get('/profile', 'ProfileController@Index')->middleware('auth');
Route::get('/profile/edit', 'ProfileController@EditProfile')->middleware('auth');
Route::put('/order/cancel/{id}', 'ProfileController@CancelOrder');
Route::put('/profile/edit', 'ProfileController@UpdateProfile')->middleware('auth');

Route::get('/driver/profile', 'DriverController@Index')->middleware('auth');
Route::post('/driver/profile', 'DriverController@Index')->middleware('auth');
Route::get('/driver/actualorders', 'DriverController@GetActualOrders')->middleware('auth');

Route::get('driver/order/{id}', 'DriverController@ShowOrder')->middleware('auth');
Route::PUT('driver/order/{idOrder}', 'DriverController@ChangeOrderStatus');
Route::get('driver/order/getrealdistance/{idOrder}', 'DriverController@GetRealDistance');
Route::get('/manager/actualhistory/{start}/{end}', 'ManagerController@GetActualHistory');
Route::get('/manager/profile', 'ManagerController@Index')->middleware('auth');
Route::get('/manager/actualorders', 'ManagerController@GetActualOrders')->middleware('auth');
Route::get('/manager/driverorders/{idDriver}', 'ManagerController@DriverOrders')->middleware('auth');
Route::get('/manager/ordermanage/{idOrder}', 'ManagerController@ShowOrder')->middleware('auth');
Route::put('/manager/ordermanage/{idOrder}', 'ManagerController@CloseOrder')->middleware('auth');
Route::get('/manager/adddriver', 'ManagerController@AddDriver')->middleware('auth');
Route::post('/manager/adddriver', 'ManagerController@StoreDriver');

Route::get('/gettaxi', 'ProfileController@GetTaxi')->middleware('auth');
Route::get('/allDrivers', 'ProfileController@DriversOnMap')->middleware('auth');

Route::get('/order/{id}', 'OrderController@Show')->middleware('auth');
Route::post('/order/{id}', 'OrderController@Show')->middleware('auth');
Route::get('/orderdata/{id}', 'OrderController@OrderData')->middleware('auth');
Route::get('/ordermap/{id}', 'OrderController@Map')->middleware('auth');
Route::get('/mapopts/{id}', 'OrderController@ShowMap')->middleware('auth');
Route::get('/order/{id}/confirm', 'DriverController@ConfirmOrder')->middleware('auth');
Route::post('/order', 'OrderController@Store');
Route::get('/ordercomplete/{id}', 'OrderController@CheckDriverUpdate');
Route::PUT('/order/{id}/confirm', 'DriverController@SubmitConfirmation');
Route::get('/order/{id}/payments', 'OrderController@ChoosePaymentOption');
