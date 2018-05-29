@extends('layouts.main')
@section('content')
<div class="col s6 ">
    <div class="card ">
        <div class="card-tabs">
            <ul class="tabs">
                <li class="tab"><a class="active" href="#test4">Orders</a></li>
            </ul>
        </div>
        <div class="card-content grey lighten-5">
            <div id="test4">
                <div class="collection">
                    @foreach($orders as $order)
                    <a href="{{action('ManagerController@ShowOrder',['Order'=>$order->id])}}" class="collection-item">order: {{$order->id}}  price: {{$order->price}}</a>
                    @endforeach
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </div>
    @endsection