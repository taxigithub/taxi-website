<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Order;
use App\Driver;
use App\Manager;
use App\OrderForManager;
use App\OrderForDriver;
use App\DriverOnObject;
use App\SosSignalToOrder;
use Auth;
use Carbon\Carbon;

class ManagerController extends Controller
    {

    public function Index()
        {
        $isManager = Manager::where('id_user', '=', Auth::id())->first();
        $drivers = DriverOnObject::where('id_object', '=', $isManager->id_object)->paginate(5);
        $history = OrderForManager::where('id_manager', '=', Auth::id())->paginate(5);

        if ($isManager) {
            return view('managers.profile', ['history' => $history, 'drivers' => $drivers]);
        } else {
            return view('home');
        }
        }

    public function AddDriver()
        {
        $isManager = Manager::where('id_user', '=', Auth::id())->first();
        if ($isManager) {
            return view('managers.addDriver');
        } else {
            return view('home');
        }
        }

    public function StoreDriver(Request $request)
        {
        $isManager = Manager::where('id_user', '=', Auth::id())->first();
        $user = User::where('phone', '=', $request->phone)->first();
        if ($user) {
            Driver::insert(['id_user' => $user->id, 'driver_status' => 1]);
        }
        if ($isManager) {
            return view('managers.addDriver');
        } else {
            return view('home');
        }
        }

    public function DriverOrders($idDriver)
        {
        $isManager = Manager::where('id_user', '=', Auth::id())->first();
        $orders = Order::where('id_driver', '=', $idDriver)->paginate(15);
        if ($isManager) {
            return view('managers.driverOrders', ['orders' => $orders]);
        } else {
            return view('home');
        }
        }

    public function CloseOrder($idOrder)
        {
        $isManager = Manager::where('id_user', '=', Auth::id())->first();
        $order = Order::find($idOrder);
        if ($isManager) {
            $order->update(['status' => $order->status + 1]);
            $insertedId = $order->id;
            OrderForDriver::where('id_order', '=', $idOrder)->delete();
            return redirect()->action(class_basename($this) . '@ShowOrder', ['insertedId' => $insertedId]);
        } else {
            return view('home');
        }
        }

    public function ShowOrder($idOrder)
        {
        $isManager = Manager::where('id_user', '=', Auth::id())->first();
        $order = Order::find($idOrder);
        if ($isManager) {
            return view('managers.orderManage', ['Order' => $order]);
        } else {
            return view('home');
        }
        }

    public function GetActualOrders()
        {
        $sosAlerts = SosSignalToOrder::where('id_sos_status', '=', 1)->get();
        $ordersForDrivers = Order::where([['id_driver', '=', null], ['autochoose', '=', 0]])->paginate(10);
        return view('managers.actualOrder', ['newOrders' => $ordersForDrivers, 'sosAlerts' => $sosAlerts]);
        }

    public function GetActualHistory($start, $end)
        {
        $startTime = Carbon::parse($start);
        $endTime = Carbon::parse($end);
        $ordersForDrivers = Order::where([['created_at', '>', $startTime], ['created_at', '<', $endTime], ['autochoose', '=', 0]])->paginate(10);
        return view('managers.actualHistory', ['newOrders' => $ordersForDrivers]);
        }

    }
