<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Driver;
use App\User;
use App\OrderForDriver;
use Auth;

class DriverController extends Controller
    {

    public function GetDrivingDistance($lat1, $lat2, $long1, $long2)
        {
        $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=" . $lat1 . "," . $long1 . "&destinations=" . $lat2 . "," . $long2 . "&mode=driving&key=AIzaSyCNeS8aIh0seeh6w2SvxfoIC1cXYtmL_MQ";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $response = curl_exec($ch);
        curl_close($ch);
        $response_a = json_decode($response, true);
        $dist = $response_a['rows'][0]['elements'][0]['distance']['value'];
        $time = $response_a['rows'][0]['elements'][0]['duration']['value'];

        //return array('distance' => $dist, 'time' => $time);
        return $dist;
        }

    public function GetDrivingDistanceLocal($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo)
        {
        $earthRadius = 6371000;
        $latFrom = deg2rad($latitudeFrom);
        $lonFrom = deg2rad($longitudeFrom);
        $latTo = deg2rad($latitudeTo);
        $lonTo = deg2rad($longitudeTo);
        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;
        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
                                cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
        return $angle * $earthRadius;
        }

    public function GetDrivingTime($distance)
        {
        return $time = $distance / 6.5;
        }

    public function Index(Request $request)
        {
        $isDriver = Driver::where('id_user', '=', Auth::id())->first();
        if (($request->isMethod('post'))&&($request->latitude != null)&&($request->longitude != null)) {
            $isDriver->update(['latitude' => $request->latitude, 'longitude' => $request->longitude]);
        } else {
            $history = Order::where([['status', '=', 5], ['id_driver', '=', Auth::id()]])->get();
            $historyCash = Order::where([['payment_type', '=', 1],['status', '=', 5], ['id_driver', '=', Auth::id()]])->get();
            if($history != null){
            $historySum = $history->sum('price');
            $historyCashSum = $historyCash->sum('price');
            }
            $maxSum = Driver::where('id_user', '=', Auth::id())->first()->DriverOnObject->Object->driver_max_sum;
            $history = Order::where([['status', '=', 5], ['id_driver', '=', Auth::id()]])->paginate(5);
            if ($isDriver) {
                return view('drivers.profile', ['history' => $history, 'historySum' => $historySum, 'historyCashSum'=>$historyCashSum, 'maxSum' => $maxSum]);
            } else {
                return view('home');
            }
        }
        }

    public function GetActualOrders()
        {
        $ordersForDrivers = OrderForDriver::where('id_driver', '=', Auth::id())->limit(8)->get();
        return view('drivers.actualOrder', ['newOrders' => $ordersForDrivers]);
        }

    public function ShowOrder($idOrder)
        {

        $order = Order::find($idOrder);
        $isDriver = Driver::where('id_user', '=', Auth::id())->get();
        $isOrder = Order::where('id_driver', '=', Auth::id())->get();
        if ((!$isDriver->isEmpty()) && (!$isOrder->isEmpty())) {
            return view('drivers.orderManage', ['Order' => $order]);
        } else {
            return view('home');
        }
        }

    public function ConfirmOrder($idOrder)
        {

        $order = Order::find($idOrder);
        $isDriver = Driver::where('id_user', '=', Auth::id())->get();
        //$isOrder = Order::where('id_driver', '=', Auth::id())->get();
        if ($order->id_driver == null) {
            return view('drivers.orderConfirm', ['Order' => $order]);
        } else if ($order->id_driver == Auth::id())
            {
            return redirect()->action(class_basename($this) . '@ShowOrder', ['Order' => $order]);
            }  else {
            return view('home');
        }
        }

    public function SubmitConfirmation(Request $request)
        {
        $order = Order::find($request->idOrder);
        $userData = User::find(Auth::id());
        $primary_price = (float) $userData->Driver->DriverOnObject->Object->Price->primary_price;
        $secondrary_price = (float) $userData->Driver->DriverOnObject->Object->Price->secondrary_price;

        $price = (float) $order->distance * $secondrary_price + $primary_price;
        if ($order->id_driver == null) {
            $order->update(['id_driver' => Auth::id(), 'price' => $price, 'status' => $order->status + 1]);

            OrderForDriver::where([['id_order', '=', $order->id], ['id_driver', '!=', Auth::id()]])->delete();

            return redirect()->action(class_basename($this) . '@ShowOrder', ['idOrder' => $request->idOrder]);
        } else {
            return view('home');
        }
        }

    public function ChangeOrderStatus(Request $request, $idOrder)
        {
        
        $order = Order::find($idOrder);
        file_put_contents($request->payment_type, $request->payment_type);
        $order->update(['status' => $order->status + 1, 'payment_type'=> $request->payment_type]);
        $insertedId = $order->id;
        
        return redirect()->action(class_basename($this) . '@ShowOrder', ['insertedId' => $insertedId]);
        }

    public function GetRealDistance($idOrder)
        {
        $order = Order::find($idOrder);
        $latPrev = $order->toDriver->latitude;
        $lngPrev = $order->toDriver->longitude;
        $dist = 0;
        while (true) {
            $order = Order::find($idOrder);
            if ($order->status == 4) {
                $primary_price = $order->toDriver->DriverOnObject->Object->Price->primary_price;
                $secondrary_price = $order->toDriver->DriverOnObject->Object->Price->secondrary_price;
                $order->update(['real_distance' => $dist, 'real_sum' => $primary_price + $secondrary_price * $dist]);

                break;
            }
            $lat = $order->toDriver->latitude;
            $lng = $order->toDriver->longitude;
            $dist = $dist + $this->GetDrivingDistance($latPrev, $lngPrev, $lat, $lng);
            sleep(5);
            $latPrev = $lat;
            $lngPrev = $lng;
        }
        return $dist;
        }

    }
