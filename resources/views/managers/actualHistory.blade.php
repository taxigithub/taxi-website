@foreach($newOrders as $key => $value)
<input type="hidden" id="start_latitude{{$key}}" name="start_latitude" value="{{$value->start_latitude}}" /> 
<input type="hidden" id="start_longitude{{$key}}" name="start_longitude" value="{{$value->start_longitude}}" /> 

 @if($value->status == 1)
                    <a style="background-color: burlywood" href="{{action('OrderController@Show',['Order'=>$value->id])}}" class="collection-item">{{$value->id}} Date: {{$value->created_at}} Address: {{$value->start_address}}   Price: {{$value->price}} </a>
                    @elseIf ($value->status == 5)
                    <a style="background-color: blueviolet" href="{{action('OrderController@Show',['Order'=>$value->id])}}" class="collection-item">{{$value->id}} Date: {{$value->created_at}} Address: {{$value->start_address}}   Price: {{$value->price}} </a>
                    @elseIf ($value->status == 6)
                    <a style="background-color: violet" href="{{action('OrderController@Show',['Order'=>$value->id])}}" class="collection-item">{{$value->id}} Date: {{$value->created_at}} Address: {{$value->start_address}}   Price: {{$value->price}} </a>
                    @else 
                    <a style="background-color: springgreen" href="{{action('OrderController@Show',['Order'=>$value->id])}}" class="collection-item">{{$value->id}} Date: {{$value->created_at}} Address: {{$value->start_address}}   Price: {{$value->price}} </a>
                    @endIf

@endforeach
<input type="hidden" id="newOrdersCount" value="{{count($newOrders)}}">


<script>
for (var i = 0; i < document.getElementById("newOrdersCount").value; i++){
    var latLngStart = new google.maps.LatLng(document.getElementById("start_latitude"+[i]).value, document.getElementById("start_longitude"+[i]).value);
setAddressFromCoordinates("show_start_point"+[i], latLngStart);
}
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
