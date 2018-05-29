@extends('layouts.main')
@section('content')
<div style=" z-index: 999999999999999; position: relative; top: 0; right: 90%; ">  <a class="btn-floating halfway-fab waves-effect waves-light red"  href="{{url('/profile')}}"><i class="material-icons">arrow_back</i></a></div>
<div class="col s3">

    <div class="card">

        <div class="card-tabs">
            <ul class="tabs">
                <li class="tab"><a class="active" href="#test4">Profile</a></li>
                <li class="tab"><a  href="#test5">Orders</a></li>
                <li class="tab"><a  href="#test6">History</a></li>
            </ul>
        </div>
        <div class="card-content grey lighten-4">
            <div id="test4">
                <div class="card horizontal">
                    <div class="card-image">
                        <img style="width: 150px; height: 250px;" src="http://materializecss.com/images/sample-1.jpg">
                        <span class="card-title">Profile</span>
                    </div>
                    <div class="card-content">
                        <p>Name:   {{ $userData->name }}</p>
                        <p>Phone: {{ $userData->phone }}</p>
                        <p>Email: {{ $userData->email }}</p>
                        <br />
                    </div>
                    <div class="card-action">
                        <a href="#">Edit profile</a>
                    </div>
                </div>
            </div>
            <div id="test5"> 
                <div id="actualOrders" class="collection">
                </div>
            </div>
            <div id="test6">
                <div class="collection">
                    @foreach($history as $historyItem)
                    <a href="{{action('OrderController@Show',['Order'=>$historyItem->id])}}" class="collection-item">order: {{$historyItem->id}} </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

</div>


@endsection

