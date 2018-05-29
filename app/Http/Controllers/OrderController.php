<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Driver;
use App\OrderForDriver;
use Auth;
use App\PaymentOption;
use App\SosSignalToOrder;
use Carbon\Carbon;


class OrderController extends Controller
    {

    public function Show(Request $request, $idOrder)
        {
if ($request->isMethod('post')) {
           SosSignalToOrder::insert(['id_order' => $idOrder ,'id_sos_status' => '1']);
        }
        $order = Order::find($idOrder);
        $currentUser = $order->id_user;
        if ($currentUser == Auth::id()) {
            return view('order', ['Order' => $order]);
        } else {
            return view('home');
        }
        }

    public function OrderData($idOrder)
        {
        $order = Order::find($idOrder);
        $time = 1;
        $tm1 = 0;
        $tm2 = 0;
        $controller = new DriverController;
        if ($order->status == 2) {
            $driver = OrderForDriver::where([['id_driver', '=', $order->id_driver], ['id_order', '=', $order->id]])->first();
            $tm1 = $controller->GetDrivingTime($driver->distance_to_start);
            $tm2 = Carbon::parse($order->updated_at);
            $time = Carbon::now()->diffInMinutes($tm2->addSeconds($tm1));
        }
        if ($order->autochoose == 1) {
            $autochooseStatus = "Autochoose";
            if ($time < 5 ){
                $time = 5;
            }
        } else {
            $autochooseStatus = "Autochoose disabled";
        }
        return view('orderData', ['Order' => $order, 'autochooseStatus' => $autochooseStatus,
            'time' => $time]);
        }

    public function Map($idOrder)
        {
        $order = Order::find($idOrder);
        return view('orderMap', ['Order' => $order, 'idOrder' => $idOrder]);
        }

    public function ShowMap($idOrder)
        {
        $order = Order::find($idOrder);
        if ($order->id_driver == null) {
            $actDrivers = OrderForDriver::where('id_order', '=', $idOrder)->get();
        } else {
            $actDrivers = OrderForDriver::where([['id_driver', '=', $order->id_driver], ['id_order', '=', $idOrder]])->get();
        }
        $currentUser = $order->id_user;
        $currentDriver = $order->id_driver;
        if ($currentUser == Auth::id() || $currentDriver == Auth::id()) {
            return view('mapOpts', ['actDrivers' => $actDrivers]);
        } else {
            return view('home');
        }
        }

    public function Store(Request $request)
        {
        $order = Order::create($request->all());
        $controller = new DriverController;
        $actDrivers = null;
        $storeArray = null;
        $i = 0;
        $ordersForDrivers = Driver::where('driver_status', '=', 1)->get();

        foreach ($ordersForDrivers as $driver) {
            $dist = $controller->GetDrivingDistanceLocal($driver->latitude, $driver->longitude, $order->start_latitude, $order->start_longitude);
            file_put_contents($driver->id, $dist);
            if ($dist < 5000) {
                $actDrivers[$i] = $driver;
                $dsitArr[$i] = $dist;
                $i++;
            }
        }

        for ($i = 0; $i < count($actDrivers); $i++) {

            $storeArray[$i] = ['id_driver' => $actDrivers[$i]->id_user, 'id_order' => $order->id, 'distance_to_start' => $dsitArr[$i]];
        }
        if (count($actDrivers) > 0) {
            OrderForDriver::insert($storeArray);
        }
        $insertedId = $order->id;
        return redirect()->action(class_basename($this) . '@Show', ['insertedId' => $insertedId]);
        }

    public function CheckDriverUpdate($idOrder)
        {
        $order = Order::find($idOrder);
        if ($order->id_driver == null) {
            $order->update(['autochoose' => 0]);
        }

        OrderForDriver::where([['id_order', '=', $idOrder], ['id_driver', '!=', $order->id_driver]])->delete();
        }

    public function ChoosePaymentOption($idOrder)
        {
        $order = Order::find($idOrder);
        $paymentOptions = PaymentOption::all();
        return view('paymentOptions', ['order' => $order, 'paymentOptions' => $paymentOptions]);
        }

    }
