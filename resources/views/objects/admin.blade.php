@extends('layouts.main')
@section('content')
<div class="col s6 ">
    <div class="card ">
        <div class="card-tabs">
            <ul class="tabs">
                <li class="tab"><a class="active" href="#test4">You are great and mighty admin</a></li>
            </ul>
        </div>
        <div class="card-content grey lighten-5">
            <div id="test4">
                <a class="btn" href="{{action('AdminController@AddObject')}}">Add object</a>
                <a class="btn" href="{{action('AdminController@AddPrice')}}">Add price</a>

                <div class="row">
                    <div class="input-field col s6">
                        <div class="collection">
                            @foreach($objects as $object)
                            <a href="" class="collection-item">{{$object->name}}. Address:{{$object->address}}</a>
                            @endforeach
                        </div>

                    </div>
                    <div class="input-field col s6">
                        <div class="collection">
                            @foreach($prices as $price)
                            <a href="{{action('AdminController@EditPrice',['priceId'=>$price->id])}}" class="collection-item">primary price:{{$price->primary_price}} secondrary price:{{$price->secondrary_price}}</a>
                            @endforeach
                        </div>
                    </div>
                        
                </div>
                {{--{{action('AdminController@AddPrice',['Order'=>$historyItem->id])}}--}}
            </div>
        </div>
        @endsection