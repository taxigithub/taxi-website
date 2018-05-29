@extends('layouts.main')
@section('content')
<input type="hidden" id="ajaxurl" value="{{url('/')}}/orderdata/{{$Order->id}}">
<input type="hidden" id="checkDriversUpdate" value="{{url('/')}}/ordercomplete/{{$Order->id}}">
<audio id="audio" src="//www.soundjay.com/button/beep-07.wav" autostart="false" ></audio>
<meta name="csrf-token" content="{{ Session::token() }}"> 
<div style=" z-index: 999999999999999; position: relative; top: 0; right: 90%; ">  <a class="btn-floating halfway-fab waves-effect waves-light red"  href="{{url('/profile')}}"><i class="material-icons">arrow_back</i></a></div>
<div class="row">
    <div class="col s12 m6">
        <div class="card">
            <div style="margin-top: 7%; position: absolute; top: 0; right: 0; ">  <a class="btn-floating halfway-fab waves-effect waves-light red" onclick="postSOS(); Materialize.toast('SOS message is sent!', 4000);" href="#"><i class="material-icons">warning</i></a>
            </div>

            <div class="card-content">
                <div id="orderData">

                </div>
                <b>Start point:</b> <p id="show_start_point"></p>
                <b>End point:</b> <p id="show_end_point"></p>
                <input type="hidden" id="createdTime"  value="{{$Order->created_at}}" />
                <input type="hidden" id="start_latitude" name="start_latitude" value="{{$Order->start_latitude}}" /> 
                <input type="hidden" id="start_longitude" name="start_longitude" value="{{$Order->start_longitude}}" /> 
                <input type="hidden" id="end_latitude" name="end_latitude" value="{{$Order->end_latitude}}" /> 
                <input type="hidden" id="end_longitude" name="end_longitude" value="{{$Order->end_longitude}}" />   
                <input type="hidden" id="OrderId" name="OrderId" value="{{$Order->id}}" />
                <br>
                <a href="{{action('OrderController@ChoosePaymentOption',['Order'=>$Order->id])}}" class="btn hidden" id="pay_order" >Pay order</a>
                <a class="btn-floating halfway-fab waves-effect waves-light red" href="{{action('OrderController@Map',['Order'=>$Order->id])}}"><i class="material-icons">map</i></a>

            </div>

        </div>
        <h3 id="mytimer"></h3>
    </div>

</div>
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAgcKGd16xKU5wAgILMgT-w0qnFcqWTxhc"
type="text/javascript"></script>

<script>
    var driverToastFlag = 0;
var latLngStart = new google.maps.LatLng(document.getElementById("start_latitude").value, document.getElementById("start_longitude").value);
var latLngEnd = new google.maps.LatLng(document.getElementById("end_latitude").value, document.getElementById("end_longitude").value);
setAddressFromCoordinates("show_start_point", latLngStart);
setAddressFromCoordinates("show_end_point", latLngEnd);
function setAddressFromCoordinates(inputId, latlng)
{
    geocoder = new google.maps.Geocoder();
    geocoder.geocode({'latLng': latlng}, function (results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            if (results[1]) {
                document.getElementById(inputId).innerHTML = results[0].formatted_address;
            }
        }
    });

}

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
            $('#orderData').html(html);
            if (document.getElementById("autochoose").value == 0 || document.getElementById("driverId").value != "") {
                document.getElementById("mytimer").style.visibility = "hidden";
            }
            if (status != document.getElementById("status").value) {
                var sound = document.getElementById("audio");
                sound.play();
                 Materialize.toast('Status is changed', 3000, 'rounded');
        }
            
            
            if (!document.getElementById("status") || document.getElementById("status").value != "Delivered") {
            document.getElementById("pay_order").className = "btn disabled";
        } else {
            document.getElementById("pay_order").className = "btn ";
        }
            status = document.getElementById("status").value;
            
            if(!document.getElementById("driverId") || document.getElementById("driverId").value =="" || driverToastFlag ==1){
            } else {
                 driverToastFlag = 1;
                 Materialize.toast(document.getElementById('driverName').innerHTML, 3000, 'rounded');
        }
        }
    
    });


}
show();
setInterval(show, 5000);


function timer()
{
    var now = new Date();
    var add30 = new Date(document.getElementById('createdTime').value);
    add30.setSeconds(add30.getSeconds() + 10850);
    var result = ((add30.getTime() - now.getTime()) / 1000).toFixed(0);
    var flag = setInterval(timer, 1000);
    if (result > 0) {
        document.getElementById('mytimer').innerHTML = result;
    } else {
        clearInterval(flag);
        document.getElementById('mytimer').innerHTML = "";
        if (document.getElementById("mytimer").style.visibility != "hidden") {
            get_fb_complete();
            
        }
    }


}

timer();
function get_fb_complete() {


    $.ajax({
        url: document.getElementById("checkDriversUpdate").value,
        dataType: 'html',
        data: {
            ajax: true
        }
        ,
        type: 'GET',
        success: function (html) {
        }

    });
}

  function postSOS() {

        $.ajax({
            type: "POST",
            url: {{$Order->id}},
            cache: false,
            data: {'_token': $('meta[name="csrf-token"]').attr('content')},
            async: true
        }).complete(function () {
        }).responseText;

    }


</script>
@endsection