@extends('layouts.main')
@section('content')
<input type="hidden" id="ajaxurl" value="{{url('/')}}/orderdata/{{$Order->id}}">
<audio id="audio" src="//www.soundjay.com/button/beep-07.wav" autostart="false" ></audio>
<div class="row">
    <div class="col s12 m6">
        <div class="card">


            <div class="card-content">
                <div id="orderData">

                </div>
                <b>Start point:</b> <p id="show_start_point"></p>
                <b>End point:</b> <p id="show_end_point"></p>
                <input type="hidden" id="start_latitude" name="start_latitude" value="{{$Order->start_latitude}}" /> 
                <input type="hidden" id="start_longitude" name="start_longitude" value="{{$Order->start_longitude}}" /> 
                <input type="hidden" id="end_latitude" name="end_latitude" value="{{$Order->end_latitude}}" /> 
                <input type="hidden" id="end_longitude" name="end_longitude" value="{{$Order->end_longitude}}" /> 
                <br>

                <a class="btn-floating halfway-fab waves-effect waves-light red" href="{{action('OrderController@Map',['Order'=>$Order->id])}}"><i class="material-icons">map</i></a>
            </div>
            <div id="mytimer"></div>
        </div>
    </div>
</div>
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAgcKGd16xKU5wAgILMgT-w0qnFcqWTxhc"
type="text/javascript"></script>

<script>
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
        if (document.getElementById("autochoose").value == 0 || {{$Order - > id_driver}} != null) {
        document.getElementById("mytimer").style.visibility = "hidden";
        }
        if (status != document.getElementById("status").value) {
        var sound = document.getElementById("audio");
        sound.play();
        }
        status = document.getElementById("status").value;
        }

});
}
show();
setInterval(show, 5000);
function countDown(second, endMinute, endHour, endDay, endMonth, endYear) {
var now = new Date();
second = (arguments.length == 1) ? second + now.getSeconds() : second;
endYear = typeof (endYear) != 'undefined' ? endYear : now.getFullYear();
endMonth = endMonth ? endMonth - 1 : now.getMonth();
endDay = typeof (endDay) != 'undefined' ? endDay : now.getDate();
endHour = typeof (endHour) != 'undefined' ? endHour : now.getHours();
endMinute = typeof (endMinute) != 'undefined' ? endMinute : now.getMinutes();
var endDate = new Date(endYear, endMonth, endDay, endHour, endMinute, second + 1);
var interval = setInterval(function () {
var time = endDate.getTime() - now.getTime();
if (time < 0) {
clearInterval(interval);
alert("Неверная дата!");
} else {
var days = Math.floor(time / 864e5);
var hours = Math.floor(time / 36e5) % 24;
var minutes = Math.floor(time / 6e4) % 60;
var seconds = Math.floor(time / 1e3) % 60;
var digit = '<div style="width:60px;float:left;text-align:center">' +
        '<div style="font-family:Stencil;font-size:40px;">';
var text = '</div><div>';
document.getElementById('mytimer').innerHTML = '' + digit + seconds + text + '';
if (!seconds && !minutes && !days && !hours) {
clearInterval(interval);
if (document.getElementById("mytimer").style.visibility != "hidden") {
alert("Alert!");
get_fb_complete();
}
}
}
now.setSeconds(now.getSeconds() + 1);
}, 1000);
}
countDown(30);
function get_fb_complete() {

$.ajax({
type: "POST",
        url: "order",
        cache: false,
        data: {'_token': $('meta[name="csrf-token"]').attr('content')},
        async: true
}).complete(function () {
}).responseText;
}


</script>
@endsection