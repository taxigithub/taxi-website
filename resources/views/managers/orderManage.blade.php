@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col s12 m6">
        <div class="card">
<div style="margin-top: 7%; position: absolute; top: 0; right: 0; ">  <a class="btn-floating halfway-fab waves-effect waves-light red" href="#"><i class="material-icons">warning</i></a>
</div>
            <form method="POST" action="{{action('ManagerController@CloseOrder',['Order'=>$Order->id])}}" enctype="multipart/form-data">
                <input type="hidden" name="_method" value="put">
                <input type="hidden" name="_token" value="{{csrf_token()}}">

                <div class="card-content">
                    <b>User name:</b> <p>{{$Order->User->name}}</p>
                    <b>Driver name:</b> <p>{{$Order->Driver->name}}</p>
                    <b>Distance:</b> <p>{{$Order->distance}} km.</p>
                    <b>Price:</b> <p>{{$Order->price}} </p>
                    <b>Status:</b><p> {{$Order->Status->name}}</p>
                    <b>Start point:</b> <p id="show_start_point"></p>
                    <b>End point:</b> <p id="show_end_point"></p>
                    <input type="hidden" id="start_latitude" name="start_latitude" value="{{$Order->start_latitude}}" /> 
                    <input type="hidden" id="start_longitude" name="start_longitude" value="{{$Order->start_longitude}}" /> 
                    <input type="hidden" id="end_latitude" name="end_latitude" value="{{$Order->end_latitude}}" /> 
                    <input type="hidden" id="end_longitude" name="end_longitude" value="{{$Order->end_longitude}}" /> 
                    <br>
                    <a class="btn-floating halfway-fab waves-effect waves-light red" href="{{action('OrderController@Map',['Order'=>$Order->id])}}"><i class="material-icons">map</i></a>
                </div>
                @if ($Order->Status->id < 6)
                <button class="btn " id="create_order" >Close order</button>
                @else
                <button class="btn disabled">Closed</button>
                @endIf
            </form>
        </div>
    </div>
</div>

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

</script>
@endsection