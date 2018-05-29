<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Admin;
use App\Object;
use App\Price;
use Auth;

class AdminController extends Controller
    {

    public function Index()
        {
        $userData = User::find(Auth::id());
        $objects = Object::all();
        $prices = Price::all();
        $isAdmin = Admin::where('id_user', '=', Auth::id())->get();
        if (!$isAdmin->isEmpty()) {
            $admin = $isAdmin->first();
            $adminId = $admin->id_user;
            return view('objects/admin', ['userData' => $userData, 'prices' => $prices, 'objects' => $objects]);
        } else {
            return view('home');
        }
        }

    public function AddPrice()
        {

        return view('objects/addPrice');
        }

    public function EditPrice($id)
        {
        $priceData = Price::find($id);
        return view('objects/editPrice', ['priceData' => $priceData]);
        }

    public function StorePrice(Request $request)
        {
        Price::create($request->all());
        $objects = Object::all();
        $prices = Price::all();
        $userData = User::find(Auth::id());

        return redirect()->action(class_basename($this) . '@Index', ['userData' => $userData, 'prices' => $prices, 'objects' => $objects]);
        }

    public function UpdatePrice(Request $request)
        {
        $price = Price::find($request->priceId);
        $price->update(['primary_price' => $request->primary_price, 'secondrary_price' => $request->secondrary_price]);
        $objects = Object::all();
        $prices = Price::all();
        $userData = User::find(Auth::id());

        return redirect()->action(class_basename($this) . '@Index', ['userData' => $userData, 'prices' => $prices, 'objects' => $objects]);
        }

    public function AddObject()
        {
        $prices = Price::all();
        return view('objects/addObject', ['prices' => $prices]);
        }

    public function EditObject($id)
        {
        $prices = Price::all();
        $objectData = Object::find($id);
        return view('objects/editObject', ['objectData' => $objectData, 'prices' => $prices]);
        }

    public function StoreObject(Request $request)
        {
        Object::create($request->all());
        $objects = Object::all();
        $prices = Price::all();
        $userData = User::find(Auth::id());

        return redirect()->action(class_basename($this) . '@Index', ['userData' => $userData, 'prices' => $prices, 'objects' => $objects]);
        }

    public function UpdateObject(Request $request)
        {
        $object = Object::find($request->objectId);
        $object->update(['primary_price' => $request->primary_price, 'secondrary_price' => $request->secondrary_price]);
        $objects = Object::all();
        $prices = Price::all();
        $userData = User::find(Auth::id());

        return redirect()->action(class_basename($this) . '@Index', ['userData' => $userData, 'prices' => $prices, 'objects' => $objects]);
        }

    }
