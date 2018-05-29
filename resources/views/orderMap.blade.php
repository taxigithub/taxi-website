<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAgcKGd16xKU5wAgILMgT-w0qnFcqWTxhc"
type="text/javascript"></script>
@extends('layouts.main')
@section('content')
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gmaps.js/0.4.25/gmaps.js"></script>
<input type="hidden" id="ajaxurl" value="{{url('/')}}/mapopts/{{ $idOrder }}">
<input type="hidden" id="taxiIco" value="{{asset("storage/img/Taxi-Front-Yellow-icon.png")}}">
<div style=" z-index: 999999999999999; position: relative; top: 0; right: 90%; ">  <a class="btn-floating halfway-fab waves-effect waves-light red"  href="{{url('/')}}/order/{{ $idOrder }}"><i class="material-icons">arrow_back</i></a></div>
<div id="map">
</div>    
<input type="hidden" id="start_latitude" name="start_latitude" value="{{$Order->start_latitude}}" /> 
<input type="hidden" id="start_longitude" name="start_longitude" value="{{$Order->start_longitude}}" /> 
<input type="hidden" id="end_latitude" name="end_latitude" value="{{$Order->end_latitude}}" /> 
<input type="hidden" id="end_longitude" name="end_longitude" value="{{$Order->end_longitude}}" /> 

<div id="fromAjax">

</div>
<script>

var time = 0;
var distance = 0;

var map = new GMaps({
    disableDefaultUI: true,
    div: '#map',
    lat: 53.6884000,
    lng: 23.8258000

});

var startlat = document.getElementById("start_latitude").value;
var startlng = document.getElementById("start_longitude").value;
var endlat = document.getElementById("end_latitude").value;
var endlng = document.getElementById("end_longitude").value;
map.setCenter(startlat, startlng);
map.drawRoute({
    origin: [startlat, startlng],
    destination: [endlat, endlng],
    travelMode: 'driving',
    strokeColor: '#131540',
    strokeOpacity: 0.6,
    strokeWeight: 6
});

map.addMarker({
    lat: startlat,
    lng: startlng
});

map.addMarker({
    lat: endlat,
    lng: endlng
});



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
            $('#fromAjax').html(html);
        }
    }
    );

    map.removeMarkers();
    map.addMarker({
        lat: startlat,
        lng: startlng
    });

    map.addMarker({
        lat: endlat,
        lng: endlng
    });

    for (var i = 0; i < document.getElementById("drv_count").value; i++)
    {
        map.addMarker({
            icon: document.getElementById("taxiIco").value,
            lat: document.getElementById("drv_latitude" + i).value,
            lng: document.getElementById("drv_longitude" + i).value,
            animation: google.maps.Animation.BOUNCE

        });
    }
}
setInterval(show, 2500);

</script>

@endsection