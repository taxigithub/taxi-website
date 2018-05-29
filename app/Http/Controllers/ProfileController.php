<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Order;
use App\Driver;
use App\Manager;
use Auth;

class ProfileController extends Controller {

    public function Index() {
        $isDriver = Driver::where('id_user', '=', Auth::id())->get();
        if (!$isDriver->isEmpty()) {
            $driver = $isDriver->first();
            $driverId = $driver->id_user;
        } else {
            $driverId = NULL;
        }
        $isManager = Manager::where('id_user', '=', Auth::id())->get();
        if (!$isManager->isEmpty()) {
            $manager = $isManager->first();
            $managerId = $manager->id_user;
        } else {
            $managerId = NULL;
        }
        $userData = User::find(Auth::id());
        $history = Order::where([['id_user', '=', Auth::id()], ['status', '>', 4]])->paginate(5);
        return view('profile', ['userData' => $userData, 'history' => $history, 'managerId' => $managerId, 'driverId' => $driverId]);
    }

    public function ActualOrder() {
        $actualOrders = Order::where([['id_user', '=', Auth::id()], ['status', '<=', 4]])->get();
        return view('users/actualOrder', ['actualOrders' => $actualOrders]);
    }

    public function DriversOnMap() {
        $allDrivers = Driver::all();
        return view('users/allDrivers', ['allDrivers' => $allDrivers]);
    }

    public function GetTaxi() {
        $userData = User::find(Auth::id());
        $firstDriver = Driver::find(1);
        $primary_price = $firstDriver->DriverOnObject->Object->Price->primary_price;
        $secondrary_price = $firstDriver->DriverOnObject->Object->Price->secondrary_price;
        return view('getTaxi', ['userData' => $userData, 'primary_price' => $primary_price, 'secondrary_price' => $secondrary_price]);
    }

    public function EditProfile() {
        $userData = User::find(Auth::id());
        return view('users/edit', ['userData' => $userData]);
    }

    public function UpdateProfile(Request $request) {
        $userData = User::find(Auth::id());
        $userData->update(['name' => $request->name, 'phone' => $request->phone, 'email' => $request->email, 'sos_email' => $request->sos_email]);
        return redirect()->action(class_basename($this) . '@EditProfile', ['userData' => $userData]);
    }

    public function CancelOrder($idOrder) {
        $order = Order::find($idOrder);
        $order->update(['status' => 7]);
        return redirect()->action(class_basename($this) . '@Index');
    }

}
