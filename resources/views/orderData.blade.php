<b>User name:</b> <p>{{$Order->User->name}}</p>
@if($Order->id_driver != null)
<div id="driverName">
    <b>Driver name:</b> <p>{{$Order->Driver->name}}&nbsp;</p>
<b>Driver phone:</b> <p>{{$Order->Driver->phone}}</p>
</div>
@endIf
<b>Distance:</b> <p>{{$Order->distance}} km.</p>
<b>Price:</b> <p>{{$Order->price}} .</p>
@if($Order->real_distance != null)
<b>Real distance:</b> <p>{{$Order->real_distance}} km.</p>
<b>Real price:</b> <p>{{$Order->real_sum}} .</p>
@endIf
<b>Time to arrival:</b> <p>less than {{$time}} min.</p>
<div id="autochooseData">
<b>Autochoose:</b><p>{{$autochooseStatus}}</p>
</div>
<b>Status:</b><input type="text" id="status" value="{{$Order->Status->name}}"> 
<input type="hidden" id="autochoose" value="{{$Order->autochoose}}"> 
<input type="hidden" id="driverId" value="{{$Order->id_driver}}"> 



