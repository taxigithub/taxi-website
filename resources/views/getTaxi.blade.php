<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAgcKGd16xKU5wAgILMgT-w0qnFcqWTxhc"
type="text/javascript"></script>
@extends('layouts.main')
@section('content')
<div style=" z-index: 999999999999999; position: relative; top: 0; right: 90%; ">  <a class="btn-floating halfway-fab waves-effect waves-light red"  href="{{url('/')}}"><i class="material-icons">arrow_back</i></a></div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gmaps.js/0.4.25/gmaps.js"></script>
<input type="hidden" id="taxiIco" value="{{asset("storage/img/Taxi-Front-Yellow-icon.png")}}">
<div class="row" id="taxi-config-panel">
    <div class="col s12">
        <div class="card blue-grey darken-1">
            <div class="card-content big">
                <div style="margin-top: 8%; position: absolute; top: 0; right: 0; ">  <a class="btn-floating halfway-fab waves-effect waves-light red" href="#" onclick="hidePanel()"><i class="material-icons">close</i></a>
                </div>
                <div id="driverData"></div>
                <form id="submit" method="POST" action="{{action('OrderController@Store')}}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <span style=" font-size: 27px;">Get taxi</span>
                    &nbsp;&nbsp;
                    

                    <div class="input-field ">

                        <input placeholder="Start point" id="start_point" onblur="onAddressEnter()" type="text" class="validate " >
                        <a id="geo_me" class="waves-effect waves-teal btn-floating" onclick="geolocateMe()" ><i class="material-icons ">pin_drop</i>Geolocation</a>

                        <a id="submit_start_point" class="btn" onclick="submitStartPoint()"><i class="material-icons left">playlist_add_check</i>Submit</a>                        
                    </div>


                    <div class="input-field ">
                        <input placeholder="End point" id="end_point" onblur="onAddressEnter()" type="text" class="validate">
                        <a id="submit_end_point" class="btn" onclick="submitEndPoint()"><i class="material-icons left">playlist_add_check</i>Submit</a>
                    </div>
                    <br>
                    <input type="checkbox" id="autochoose"  checked="checked" />

                    <label for="autochoose">Autochoose</label>
                    <br>
                    <label id="travelDistance" ></label>
                    <label id="price" ></label>
                    <div class="card-action">
                        <a class="btn disabled" id="create_order" onclick="createOrder()" href="#">Create order</a>
                    </div>
                    <input type="hidden"  name="id_user" value="{{$userData->id}}" /> 
                    <input type="hidden"  name="status" value="1" /> 
                    <input type="hidden" id="autochooseValue" name="autochoose" value="1" /> 
                    <input type="hidden" id="distance" name="distance" value="" /> 
                    <input type="hidden" id="secondrary_price" name="secondrary_price" value="{{$secondrary_price}}" /> 
                    <input type="hidden" id="primary_price" name="primary_price" value="{{$primary_price}}" /> 
                    <input type="hidden" id="price_submit" name="price" value="" />              
                    <input type="hidden" id="start_latitude" name="start_latitude" value="" /> 
                    <input type="hidden" id="start_longitude" name="start_longitude" value="" /> 
                    <input type="hidden" id="end_latitude" name="end_latitude" value="" /> 
                    <input type="hidden" id="end_longitude" name="end_longitude" value="" /> 
                    <input type="hidden" id="start_address" name="start_address" value="" /> 
                    <input type="hidden" id="end_address" name="end_address" value="" /> 
                </form>
            </div>
        </div>
    </div>
</div>

<div id="map">
</div>    

<script>

    var startlat = null;
    var startlng = null;
    var endlat = null;
    var endlng = null;
    var time = 0;
    var distance = 0;
    var pr1 = document.getElementById("primary_price").value;
    var pr2 = document.getElementById("secondrary_price").value;

    function hidePanel() {
        document.getElementById("taxi-config-panel").style.display = "none";
    }
    function createOrder()
    {
        if (document.getElementById('autochoose').value == 'on') {
            document.getElementById('autochooseValue').value = 1;
        } else {
            document.getElementById('autochooseValue').value = 0;
        }
        
        document.getElementById('start_latitude').value = startlat;
        document.getElementById('start_longitude').value = startlng;
        document.getElementById('end_latitude').value = endlat;
        document.getElementById('end_longitude').value = endlng;
        document.getElementById('start_address').value = document.getElementById('start_point').value;
        document.getElementById('end_address').value = document.getElementById('end_point').value;
        document.getElementById('price_submit').value = distance / 1000 * pr2 + parseFloat(pr1);
        document.getElementById('distance').value = distance / 1000;
        document.getElementById("submit").submit();

    }


    function rememberPoints(inputid, lat, lng)
    {
        if (inputid == "end_point") {
            endlat = lat;
            endlng = lng;
        } else {
            startlat = lat;
            startlng = lng;
        }
    }

    function setAddressFromCoordinates(inputId, latlng)
    {
        geocoder = new google.maps.Geocoder();
        geocoder.geocode({'latLng': latlng}, function (results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                if (results[1]) {
                    document.getElementById(inputId).value = results[0].formatted_address;
                }
            }
        });

    }

    function getInputId()
    {
        var inputId;
        if (document.getElementById("end_point").style.visibility == "visible") {
            inputId = "end_point";
        } else {
            inputId = "start_point";
        }
        return inputId;
    }

    function onAddressEnter()
    {
        var inputId = getInputId();
        addressSearch(inputId);

    }

    function submitStartPoint()
    {

        document.getElementById("start_point").setAttribute("disabled", "true");
        document.getElementById("end_point").style.visibility = "visible";
        document.getElementById("submit_start_point").style.display = "none";
        document.getElementById("submit_end_point").style.visibility = "visible";
        
        
    }

    function submitEndPoint()
    {
        map.removeMarkers();
        document.getElementById("end_point").setAttribute("disabled", "true");
        document.getElementById("submit_end_point").style.display = "none";
        document.getElementById("create_order").setAttribute("class", "btn");
        map.addMarker({
            lat: startlat,
            lng: startlng
        });
        map.addMarker({
            lat: endlat,
            lng: endlng
        });
        map.drawRoute({
            origin: [startlat, startlng],
            destination: [endlat, endlng],
            travelMode: 'driving',
            strokeColor: '#131540',
            strokeOpacity: 0.6,
            strokeWeight: 6
        });
        showDriver();
        map.getRoutes({
            origin: [startlat, startlng],
            destination: [endlat, endlng],
            callback: function (e) {

                for (var i = 0; i < e[0].legs.length; i++) {
                    time += e[0].legs[i].duration.value;
                    distance += e[0].legs[i].distance.value;
                }
                //alert(time + " " + distance);

                document.getElementById("travelDistance").innerHTML = 'Distance: ' + distance / 1000 + " km.";
                document.getElementById("price").innerHTML = 'Price: ' + (distance / 1000 * pr2 + parseFloat(pr1)) + ".";
            }
        });
    }

    function addressSearch(inputId)
    {
        GMaps.geocode({
            address: $("#" + inputId).val(),
            callback: function (results, status) {
                if (status == 'OK') {
                    var latlng = results[0].geometry.location;
                    map.setCenter(latlng.lat(), latlng.lng());
                    map.addMarker({
                        lat: latlng.lat(),
                        lng: latlng.lng()
                    });
                    document.getElementById(inputId).value = results[0].formatted_address;
                    rememberPoints(inputId, latlng.lat(), latlng.lng());
                }
            }
        });

    }

    var map = new GMaps({
        disableDefaultUI: true,
        div: '#map',
        lat: 53.6884000,
        lng: 23.8258000

    });
    geolocateStart();
    GMaps.on('click', map.map, function (event) {
        map.removeMarkers();
        if (document.getElementById("submit_end_point").style.display != "none") {
            lat = event.latLng.lat();
            lng = event.latLng.lng();
            map.addMarker({
                lat: lat,
                lng: lng
            });
        }
        showDriver();
        var latlng = new google.maps.LatLng(lat, lng);
        var inputid = getInputId();
        setAddressFromCoordinates(inputid, latlng);
        rememberPoints(inputid, lat, lng);
        document.getElementById("taxi-config-panel").style.display = "block";
    });
    function geolocateMe() {
        GMaps.geolocate({
            success: function (position) {
                map.setCenter(position.coords.latitude, position.coords.longitude);
                map.addMarker(
                        {
                            lat: position.coords.latitude,
                            lng: position.coords.longitude
                        }
                );
                var latlng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
                setAddressFromCoordinates('start_point', latlng);
                rememberPoints('start_point', position.coords.latitude, position.coords.longitude);
                submitStartPoint();
            },
            error: function (error) {
                alert('Geolocation failed: ' + error.message);
            },
            not_supported: function () {
                alert("Your browser does not support geolocation");
            }
        });
    }
        function geolocateStart() {
        GMaps.geolocate({
            success: function (position) {
                map.setCenter(position.coords.latitude, position.coords.longitude);
                
            },
            error: function (error) {
                alert('Geolocation failed: ' + error.message);
            },
            not_supported: function () {
                alert("Your browser does not support geolocation");
            }
        });
    }
    
    
    function showDriver() {


    $.ajax({
        url: '/allDrivers',
        dataType: 'html',
        data: {
            ajax: true
        }
        ,
        type: 'GET',
        success: function (html) {
            $('#driverData').html(html);
     for (var i = 0; i < document.getElementById("drv_count").value; i++)
    {
        map.addMarker({
            icon: document.getElementById("taxiIco").value,
            lat: document.getElementById("drv_latitude" + i).value,
            lng: document.getElementById("drv_longitude" + i).value,
            animation: google.maps.Animation.BOUNCE,

        });
    }    
    }
     
           
        
    
    });


}
showDriver();

</script>

@endsection