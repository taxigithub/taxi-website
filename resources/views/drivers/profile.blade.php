@extends('layouts.main')
@section('content')
<div style=" z-index: 999999999999999; position: relative; top: 0; right: 90%; ">  <a class="btn-floating halfway-fab waves-effect waves-light red"  href="{{url('/profile')}}"><i class="material-icons">arrow_back</i></a></div>
<input type="hidden" id="ajaxurl" value="{{url('/')}}/driver/actualorders">
<audio id="audio" src="//www.soundjay.com/button/beep-07.wav" autostart="false" ></audio>
<div class="col s6 ">
    <meta name="csrf-token" content="{{ Session::token() }}"> 
    <div class="card medium">
        <div class="card-tabs">
            <ul class="tabs tabs-fixed-width-12">
                <li class="tab"><a class="active" href="#test4">Actual orders (Total sum: {{$historySum}} In cash: {{$historyCashSum}} /{{$maxSum}})</a></li>
                <li class="tab"><a  href="#driverHistory">History </a></li>
            </ul>
        </div>
        <div class="card-content grey lighten-5">
            <div id="test4">
                <div id="actualOrders" class="collection">
                </div>
            </div>
            <div id="driverHistory">
                <div class="collection">
                    @foreach($history as $historyItem)
                    @if($historyItem->status == 1)
                    <a style="background-color: burlywood" href="{{action('OrderController@Show',['Order'=>$historyItem->id])}}" class="collection-item">{{$historyItem->id}} Date: {{$historyItem->created_at}} Address: {{$historyItem->start_address}}   Price: {{$historyItem->price}} </a>
                    @elseIf ($historyItem->status == 5)
                    <a style="background-color: blueviolet" href="{{action('OrderController@Show',['Order'=>$historyItem->id])}}" class="collection-item">{{$historyItem->id}} Date: {{$historyItem->created_at}} Address: {{$historyItem->start_address}}   Price: {{$historyItem->price}} </a>
                    @elseIf ($historyItem->status == 6)
                    <a style="background-color: violet" href="{{action('OrderController@Show',['Order'=>$historyItem->id])}}" class="collection-item">{{$historyItem->id}} Date: {{$historyItem->created_at}} Address: {{$historyItem->start_address}}   Price: {{$historyItem->price}} </a>
                    @else 
                    <a style="background-color: springgreen" href="{{action('OrderController@Show',['Order'=>$historyItem->id])}}" class="collection-item">{{$historyItem->id}} Date: {{$historyItem->created_at}} Address: {{$historyItem->start_address}}   Price: {{$historyItem->price}} </a>
                    @endIf
                    @endforeach
                    {{ $history->fragment('driverHistory')->links() }}
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="latitude" name="latitude" value="" /> 
    <input type="hidden" id="longitude" name="longitude" value="" /> 

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gmaps.js/0.4.25/gmaps.js"></script>
    <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script>
var items = 0;
show();
function show() {

    var url = $(this).attr('action');
    $.ajax({
        url: document.getElementById("ajaxurl").value,
        dataType: 'html',
        data: {
            ajax: true
        }
        ,
        type: 'GET',
        success: function (html) {
            $('#actualOrders').html(html);

            if (items < document.getElementById("newOrdersCount").value) {
                var sound = document.getElementById("audio");
                sound.play();
                Materialize.toast('New order', 3000, 'rounded');
            }
            items = document.getElementById("newOrdersCount").value;
        }

    });


}
setInterval(show, 10000);

$(document).ready(function () {
    GMaps.geolocate({
        success: function (position) {

            document.getElementById("latitude").value = position.coords.latitude;
            document.getElementById("longitude").value = position.coords.longitude;
        },
        error: function (error) {
            alert('Geolocation failed: ' + error.message);
        },
        not_supported: function () {
            alert("Your browser does not support geolocation");
        }
    });
    function get_fb_complete() {

        $.ajax({
            type: "POST",
            url: "profile",
            cache: false,
            data: {'_token': $('meta[name="csrf-token"]').attr('content'), 'latitude': document.getElementById("latitude").value, 'longitude': document.getElementById("longitude").value},
            async: true
        }).complete(function () {
            setTimeout(function () {
                get_fb_complete();
            }, 5000);
        }).responseText;

    }

    $(function () {
        get_fb_complete();
    });
});
    </script>

    @endsection