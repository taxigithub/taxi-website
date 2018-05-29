@if (count($sosAlerts)>0)
@foreach($sosAlerts as $key => $sosAlert)
<input type="hidden" id="sosAlert{{$key}}" name="start_latitude" value="{{$sosAlert->Order->id}}" /> 
@endforeach
@endIf
@if (count($newOrders)>0)
@foreach($newOrders as $key => $value)
<a href="{{action('DriverController@ConfirmOrder',['Order'=>$value->id])}}" class="collection-item">{{$value->id}}. Date: {{$value->created_at}} Address: {{$value->start_address}} Price: {{$value->price}} </a>
@endforeach
@endIf
<input type="hidden" id="newOrdersCount" value="{{count($newOrders)}}">
<input type="hidden" id="sosAlertsCount" value="{{count($sosAlerts)}}">
